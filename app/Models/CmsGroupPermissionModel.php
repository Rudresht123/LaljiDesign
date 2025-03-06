<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PermissionGroup;

class CmsGroupPermissionModel extends Model
{
    protected $table = "cms_group_permissions";
    protected $fillable = [
        'permission_group',
        'permission_name'
    ];
    // AdminModel.php
    public function permissionGroup()
    {
        return $this->belongsTo(PermissionGroup::class, 'permission_group');
    }

    // Relationship with UserPermissionModel (users who have this permission)
    public function userPermissions()
    {
        return $this->hasMany(UserPermissionModel::class, 'permission_id');
    }

 

}
