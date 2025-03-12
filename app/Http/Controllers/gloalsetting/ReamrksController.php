<?php

namespace App\Http\Controllers\gloalsetting;
use App\Http\Controllers\Controller;
use App\Models\RemarksModel;
use App\Repository\MasterAdmin\GlobalSetting\GlobalSettingRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReamrksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $remarks=(new GlobalSettingRepo())->remarks();
        return view('admin_panel.global_setting.define-remarks',compact('remarks'));
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
            'remarks' => 'required|string',
            'is_active' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'errors' => $validator->errors()
            ], 422); 
        }

        $newRemark=new RemarksModel();
        $newRemark->fill($validator->validated());

        if($newRemark->save())
        {
            return back()->with(['success'=>'Remarks Created Successfully Done']);
        }
        else{
            return back()->with(['success'=>'Remarks not Created Successfully Done']);
        }
    }

    /**
     * Display the specified resource.
     */
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $remark=RemarksModel::find($id);
        return view('admin_panel.global_setting.Edit.edit-remarks',compact('remark'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'remarks' => 'required|string',
            'is_active' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with([
                'errors' => $validator->errors()
            ], 422); 
        }

        $newRemark = RemarksModel::find($id);

        if ($newRemark) {
            $newRemark->fill($validator->validated());
        
            if ($newRemark->update()) {
                return back()->with(['success' => 'Remarks updated successfully.']);
            } else {
                return back()->with(['error' => 'Failed to update remarks.']);
            }
        } else {
            return back()->with(['error' => 'Remarks not found.']);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
}
