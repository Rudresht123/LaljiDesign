<?php

namespace App\Http\Controllers\gloalsetting;

use App\Http\Controllers\Controller;
use App\Models\StatusModel;
use App\Repository\MasterAdmin\GlobalSetting\GlobalSettingRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status=(new GlobalSettingRepo())->status();
        return view('admin_panel.global_setting.definestatus',compact('status'));
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
          'category_id'=>'required',
            'status_name' => 'required|string',
            'slug' => 'required|string',
            'remark' => 'nullable|string',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); 
        }
        $newstatus=new StatusModel();
        $newstatus->fill($validator->validated());
      if($newstatus->save())
      {
        return back()->with(['success'=>'Status Created Successfully Done']);
      }
      else
      {
        return back()->with(['error'=>'Status is not Created Successfully Done']);

      }

    }

  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $status=StatusModel::find($id);
        return view('admin_panel.global_setting.Edit.edit-status',compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
          'category_id'=>'required',
            'status_name' => 'required|string',
            'slug'=>'required|string',  
            'remark' => 'required|string',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); 
        }
        $newstatus=StatusModel::find($id);
        $newstatus->fill($validator->validated());
      if($newstatus->save())
      {
        return back()->with(['success'=>'Status updated Successfully Done']);
      }
      else
      {
        return back()->with(['error'=>'Status is not updated Successfully Done']);

      }

    }


}
