<?php

namespace App\Http\Controllers\gloalsetting;

use App\Http\Controllers\Controller;
use App\Models\ExcelColumnNameModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ExcelColumnNameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tableColumns = Schema::getColumnListing('trademark_users'); 
        $columnName = ExcelColumnNameModel::pluck('column_name')->toArray();
        $columnNames = ExcelColumnNameModel::get();
        $newcolumnname = !empty($columnName) ? array_diff($tableColumns, $columnName) : $tableColumns;
        if($newcolumnname){
        return view('admin_panel.global_setting.define-excelcolumns', compact('newcolumnname','columnName','columnNames'));
    }
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
            'column_name' => 'required|string',
            'excelcolumn_name'=> 'required|string',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); 
        }
        $newstatus=new ExcelColumnNameModel();
        $newstatus->fill($validator->validated());
      if($newstatus->save())
      {
        return back()->with(['success'=>'ExcelColumn Created Successfully Done']);
      }
      else
      {
        return back()->with(['error'=>'ExcelColumn is not Created Successfully Done']);

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
        $tableColumns = Schema::getColumnListing('trademark_users'); 
        $columnName = ExcelColumnNameModel::pluck('column_name')->toArray();
        $columnNames = ExcelColumnNameModel::get();
        $newcolumnname = !empty($columnName) ? array_diff($tableColumns, $columnName) : $tableColumns;
        $excelcolumn=ExcelColumnNameModel::find($id);
      
        return view('admin_panel.global_setting.Edit.edit-excelcolumns-name', compact('tableColumns','newcolumnname','columnName','columnNames','excelcolumn'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'column_name' => 'required|string',
            'excelcolumn_name' => 'required|string',
            'status' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
    
        // Find the record first
        $updateStatus = ExcelColumnNameModel::find($id);
    
        if (!$updateStatus) {
            return response()->json([
                'error' => 'ExcelColumn  not found'
            ], 404);  // Return a 404 if the record isn't found
        }
    
        // Update the status
        $updateStatus->fill($validator->validated());
    
        if ($updateStatus->save()) {  // Using save() instead of update() to handle new updates
            return back()->with(['success' => 'ExcelColumn  updated successfully']);
        } else {
            return back()->with(['error' => 'ExcelColumn  update failed']);
        }
    }
    

  
}

