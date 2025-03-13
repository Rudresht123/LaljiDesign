<?php

namespace App\Http\Controllers\gloalsetting;

use App\Http\Controllers\Controller;
use App\Models\PermissionGroup;
use App\Repository\MasterAdmin\GlobalSetting\GlobalSettingRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class PermissionGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups=(new GlobalSettingRepo())->permissionGroups();
        return view("admin_panel.global_setting.define-permission-group",compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'permission_group' => 'required|string|unique:cms_permission_groups,permission_group',
            'permission_group_slug' => 'required|string|unique:cms_permission_groups,permission_group_slug',
            'status'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); 
        }
        $newstatus=new PermissionGroup();
        $newstatus->fill($validator->validated());
      if($newstatus->save())
      {
        return back()->with(['success'=>'Permission Group Created Successfully Done']);
      }
      else
      {
        return back()->with(['error'=>'Permission Group is not Created Successfully Done']);

      }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permissiongroup=PermissionGroup::find($id);
        return view("admin_panel.global_setting.Edit.edit-permission-group",compact('permissiongroup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'permission_group' => 'required|string',
            'permission_group_slug' => 'required|string',
            'status'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); 
        }
        // Find the record first
        $updateStatus = PermissionGroup::find($id);
    
        if (!$updateStatus) {
            return back()->with([
                'error' => 'Permission Group  not found'
            ], 404);  // Return a 404 if the record isn't found
        }
    
        // Update the status
        $updateStatus->fill($validator->validated());
    
        if ($updateStatus->save()) {  // Using save() instead of update() to handle new updates
            return back()->with(['success' => 'Permission Group  updated successfully']);
        } else {
            return back()->with(['error' => 'Permission Group  update failed']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
  
    }

