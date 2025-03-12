<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CmsGroupPermissionModel;
use App\Models\Record;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionGroup extends Record
{
    use SoftDeletes;
    protected $table = "cms_permission_groups";
    protected $fillable = ["permission_group","permission_group_slug"];

    public function cmsPermissionGroups()
    {
        return $this->hasMany(CmsGroupPermissionModel::class, 'permission_group', 'id');
    }
    public function permissionGroup(){
        return $this->belongsToMany(CmsGroupPermissionModel::class);
    }
    

}
