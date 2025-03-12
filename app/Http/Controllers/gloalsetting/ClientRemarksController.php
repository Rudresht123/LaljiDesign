<?php

namespace App\Http\Controllers\gloalsetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClientRemarksModel;
use App\Repository\MasterAdmin\GlobalSetting\GlobalSettingRepo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
class ClientRemarksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $whatsappremarks=(new GlobalSettingRepo())->whatsappremarks();
        return view('admin_panel.global_setting.define-whatsapp-remarks',compact('whatsappremarks'));
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
            'client_remarks' => 'required|string',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'errors' => $validator->errors()
            ], 422); 
        }

        $newRemark=new ClientRemarksModel();
        $newRemark->fill($validator->validated());

        if($newRemark->save())
        {
            return back()->with(['success'=>'Client Remarks Created Successfully Done']);
        }
        else{
            return back()->with(['success'=>'Client Remarks not Created Successfully Done']);
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
        $whatsappremarks=ClientRemarksModel::find($id);
        return view('admin_panel.global_setting.Edit.edit-whatsapp-remarks',compact('whatsappremarks'));

       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        $validator = Validator::make($request->all(), [
            'client_remarks' => 'required|string',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'errors' => $validator->errors()
            ], 422); 
        }

        $updatedRemarks = ClientRemarksModel::find($id);

        if ($updatedRemarks) {
            $updatedRemarks->fill($validator->validated());
        
            if ($updatedRemarks->update()) {
                return back()->with(['success' => 'Client Remarks updated successfully.']);
            } else {
                return back()->with(['error' => 'Failed to update Client remarks.']);
            }
        } else {
            return back()->with(['error' => 'Client Remarks not found.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
   
}
