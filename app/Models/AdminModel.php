<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomResetPassword;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionGroup;
use Illuminate\Support\Facades\Log;

class AdminModel extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table="admins";
    protected $fillable = [
        'name',
        'email',
        'password',
        'plain_password',
        'contact_no',
        'ip_address',
        'role',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }

    public function permissionGroup(){
        return $this->hasMany(PermissionGroup::class);
    }

    public function permissions()
    {
        return $this->hasMany(UserPermissionModel::class, 'user_id');
    }
    
    public function userPermissions()
    {
        return $this->hasMany(UserPermissionModel::class, 'user_id');
    }

    public function hasPermission($permissionName)
    {
     
        if ($this->isSuperAdmin()) {
            return true;
        }
        $permissions = $this->userPermissions()
                            ->join('cms_group_permissions', 'user_permissions.permission_id', '=', 'cms_group_permissions.id')
                            ->pluck('cms_group_permissions.permission_route')
                            ->toArray();

                            Log::info($permissionName);              
        return in_array($permissionName, $permissions);
    }
  
    public function isSuperAdmin()
    {
        return $this->role === 'superadmin';
    }
    public function permissionsinsert()
{
    return $this->hasMany(PermissionModel::class, 'user_id'); // Adjust table/foreign key
}
    

}
