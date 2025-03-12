<?php

namespace App\Http\Controllers\gloalsetting;

use App\Http\Controllers\Controller;
use App\Models\ConsultantModel;
use App\Repository\MasterAdmin\GlobalSetting\GlobalSettingRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ConsultantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultants=(new GlobalSettingRepo())->consultants();
        return view('admin_panel.global_setting.define-consultant',compact('consultants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        
        $validator = Validator::make($request->all(), [
            'consultant_name' => 'required|string',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'errors' => $validator->errors()
            ], 422); 
        }
        $newstatus=new ConsultantModel();
        $newstatus->fill($validator->validated());
      if($newstatus->save())
      {
        return back()->with(['success'=>'Consultant Created Successfully Done']);
      }
      else
      {
        return back()->with(['error'=>'Consultant is not Created Successfully Done']);

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
        $consultant=ConsultantModel::find($id);
        return view('admin_panel.global_setting.Edit.edit-consultant',compact('consultant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'consultant_name' => 'required|string',
            'status' => 'required',
        ]);
    
        if ($validator->fails()) {
            return back()->with([
                'errors' => $validator->errors()
            ], 422);
        }
    
        // Find the record first
        $updateStatus = ConsultantModel::find($id);
    
        if (!$updateStatus) {
            return back()->with([
                'error' => 'Consultant  not found'
            ], 404);  // Return a 404 if the record isn't found
        }
    
        // Update the status
        $updateStatus->fill($validator->validated());
    
        if ($updateStatus->save()) {  // Using save() instead of update() to handle new updates
            return back()->with(['success' => 'Consultant  updated successfully']);
        } else {
            return back()->with(['error' => 'Consultant  update failed']);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $consultant = ConsultantModel::find($id);

        if($consultant){
            if($consultant->delete()){  // Using save() instead of update() to handle new updates
                return back()->with(['success' => 'Consultant  deleted successfully']);
            } else {
                return back()->with(['error' => 'Consultant  not deleted successfully']);
            }
        }
        else{
            return back()->with(['error' => 'Consultant  not Find successfully']);
        }
    }
}
