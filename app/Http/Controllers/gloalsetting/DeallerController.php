<?php

namespace App\Http\Controllers\gloalsetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeallerModel;
use App\Repository\MasterAdmin\GlobalSetting\GlobalSettingRepo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class DeallerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dealers = (new GlobalSettingRepo())->deallers();
        return view('admin_panel.global_setting.define-dealer', compact('dealers'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'dealler_name' => 'required|string',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'errors' => $validator->errors()
            ], 422);
        }
        $newstatus = new DeallerModel();
        $newstatus->fill($validator->validated());
        if ($newstatus->save()) {
            return back()->with(['success' => 'Dealler Created Successfully Done']);
        } else {
            return back()->with(['error' => 'Dealler is not Created Successfully Done']);
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
        $dealer = DeallerModel::find($id);
        return view('admin_panel.global_setting.Edit.edit-dealer', compact('dealer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'dealler_name' => 'required|string',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'errors' => $validator->errors()
            ], 422);
        }

        // Find the record first
        $updateStatus = DeallerModel::find($id);

        if (!$updateStatus) {
            return back()->with([
                'error' => 'Dealler  not found'
            ], 404);
        }

        // Update the status
        $updateStatus->fill($validator->validated());

        if ($updateStatus->save()) {
            return back()->with(['success' => 'Dealler  updated successfully']);
        } else {
            return back()->with(['error' => 'Dealler  update failed']);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
   
}
