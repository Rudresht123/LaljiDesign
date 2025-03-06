<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PermissionGroup;
use App\Models\AdminModel;

class UserPermissionModel extends Model
{
  
    protected $table = 'user_permissions'; // Make sure to define the table name if it's not following Laravel's naming conventions.

    protected $fillable = [
        'user_id',
        'permission_id',
        'created_at',
        'updated_at'
    ];
    public function admin()
    {
        return $this->belongsTo(AdminModel::class, 'user_id');
    }

    // Relationship with CmsPermissionGroup (permissions assigned to the user)
    public function cmsPermissionGroup()
    {
        return $this->belongsTo(PermissionGroup::class, 'permission_id','id');
    }
  
   
}
