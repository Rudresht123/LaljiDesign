<?php

namespace App\Http\Controllers\excels;

use App\Http\Controllers\Controller;
use App\Imports\ClientsImport;
use App\Exports\ExportExcels;
use App\Exports\DPPExportExcels;
use App\Models\ExcelColumnNameModel;
use App\Models\TrademarkUserModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class ExcelsImport extends Controller
{

public function ClientsImport(Request $request){
    if ($request->hasFile('excel_file')) {
        $file = $request->file('excel_file');
    
        // Sirf CSV file allow karein
        if ($file->getClientOriginalExtension() != 'csv') {
            return back()->with('error', 'Please upload a valid CSV file.');
        }
    
        $importdata = [];
        if (($handle = fopen($file, "r")) !== FALSE) {
            $row = 0;
            $tablehead = [];
            
            while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
                if ($row == 0) {
                    $tablehead = $data; // Pehli row headings ke liye
                } else {
                    $importdata[] = array_combine($tablehead, $data); // Tablehead ko keys banakar row ko associative array banao
                }
                $row++;
            }
            fclose($handle);
        }
        return view('admin_panel.reports.Add.importusers-preview',compact('tablehead','importdata'));
    }
}
public function ClientsExcelExport(Request $request){
        
          $query=TrademarkUserModel::with(
            'attorney:id,attorneys_name',
            'mainCategory:id,category_name,category_slug',
            'office:id,office_name',
            'statusMain:id,status_name',
            'subStatus:id,substatus_name',
            'clientRemark:id,client_remarks',
            'remarksMain:id,remarks as remarks_name',
            'Clientonsultant:id,consultant_name',
            'dealWith:id,dealler_name',
            'subCategory:id,subcategory',
            'financialYear:id,financial_session'
            );

    // Apply filters like in your form
    if (!empty($request->attorney_id)) {
        $query->whereIn('trademark_users.attorney_id', (array)$request->attorney_id);
    }

    if (!empty($request->maincategory)) {
        $query->whereIn('trademark_users.category_id', (array)$request->maincategory);
    }

    if (!empty($request->status)) {
        $query->whereIn('trademark_users.status', (array)$request->status);
    }

    if (!empty($request->start) && !empty($request->from)) {
        $query->whereBetween('trademark_users.created_at', [$request->start, $request->from]);
    }

    $excelColumn=ExcelColumnNameModel::where('status','yes')->get();
    $columns = $request->input('column');
    return Excel::download(new ExportExcels($query,$columns,$excelColumn), 'trademark_clients.xlsx');
}
public function DPPReport(Request $request)
{
    $query = TrademarkUserModel::with(
        'attorney:id,attorneys_name',
        'mainCategory:id,category_name,category_slug',
        'office:id,office_name',
        'statusMain:id,status_name',
        'subStatus:id,substatus_name',
        'clientRemark:id,client_remarks',
        'remarksMain:id,remarks as remarks_name',
        'Clientonsultant:id,consultant_name',
        'dealWith:id,dealler_name',
        'subCategory:id,subcategory',
        'financialYear:id,financial_session'
    );

    // Initiate the Excel download and return the response
    return Excel::download(new DPPExportExcels($query, $request), 'trademark_clients_dpp_report.xlsx');
}
}

