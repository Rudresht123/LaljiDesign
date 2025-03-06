<?php
namespace App\Repository;

use App\Models\AdminModel;
use App\Models\AttorneysModel;
use App\Models\MainCategoryModel;
use App\Models\UserPermissionModel;
use App\Repository\Interfaces\UserPermissionInterface;
use Illuminate\Support\Facades\Auth;

class UserPermissionRepo implements UserPermissionInterface{
    public function getAtteorneys(){
    
        if(Auth::user()->role=='superadmin'){
            $attorneysId=AttorneysModel::where('status','yes')->pluck('id')->toArray();
            return  $attorneysId;
        }
        else{  
            $attorneysId = AdminModel::select('admins.*', 'cms_permission_groups.permission_group_slug', 'cms_group_permissions.permission_route')
            ->join('user_permissions', 'admins.id', '=', 'user_permissions.user_id')
            ->join('cms_group_permissions', 'user_permissions.permission_id', '=', 'cms_group_permissions.id')
            ->join('cms_permission_groups', 'cms_group_permissions.permission_group', '=', 'cms_permission_groups.id')
            ->where('admins.id', Auth::user()->id)
            ->where('cms_permission_groups.permission_group_slug', 'attorney')
            ->get();
        
      return $attorneysId->pluck('permission_route')->flatten()->toArray();
        }
    }
    public function getCategorys(){
    
        if(Auth::user()->role=='superadmin'){
            $categoryId=MainCategoryModel::where('status','yes')->pluck('id')->toArray();
            return  $categoryId;
        }
        else{  
            $categoryId = AdminModel::select('admins.*', 'cms_permission_groups.permission_group_slug', 'cms_group_permissions.permission_route')
            ->join('user_permissions', 'admins.id', '=', 'user_permissions.user_id')
            ->join('cms_group_permissions', 'user_permissions.permission_id', '=', 'cms_group_permissions.id')
            ->join('cms_permission_groups', 'cms_group_permissions.permission_group', '=', 'cms_permission_groups.id')
            ->where('admins.id', Auth::user()->id)
            ->where('cms_permission_groups.permission_group_slug', 'category')
            ->get();
            return $categoryId->pluck('permission_route')->toArray();
        }
    }

}