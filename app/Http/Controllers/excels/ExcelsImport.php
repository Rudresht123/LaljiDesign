<?php

namespace App\Http\Controllers\excels;

use App\Http\Controllers\Controller;
use App\Imports\ClientsImport;
use App\Exports\ExportExcels;
use App\Exports\DPPExportExcels;
use App\Http\Requests\Imports\ClientImportRequest;
use App\Models\ExcelColumnNameModel;
use App\Models\StatusHistory;
use App\Models\TrademarkUserModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
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


public function ImportsClientData(ClientImportRequest $request)
{

   
    DB::beginTransaction();

    try {
        $status = false;
        foreach ($request->trademark_name as $key => $trademarkName) {
            $trademarkUser = TrademarkUserModel::create([
                'attorney_id' => $request->attorney_id[$key] ?? null,
                'category_id' => $request->category_id[$key] ?? null,
                'application_no' => $request->application_no[$key] ?? null,
                'file_name' => $request->file_name[$key] ?? null,
                'trademark_name' => $trademarkName,
                'trademark_class' => $request->trademark_class[$key] ?? '1',
                'filling_date' => formatDate($request->filling_date[$key] ?? '', 'Y-m-d'),
                'phone_no' => $request->phone_no[$key] ?? null,
                'email_id' => $request->email_id[$key] ?? null,
                'objected_hearing_date' => formatDate($request->objected_hearing_date[$key] ?? null, 'Y-m-d'),
                'opponenet_applicant_name' => $request->opponenet_applicant_name[$key] ?? null,
                'opponent_applicant_code' => $request->opponent_applicant_code[$key] ?? null,
                'opponent_applicant' => $request->opponent_applicant[$key] ?? null,
                'hearing_date' => formatDate($request->hearing_date[$key] ?? null, 'Y-m-d'),
                'examination_report' => $request->examination_report[$key] ?? null,
                'opposed_no' => $request->opposed_no[$key] ?? null,
                'rectification_no' => $request->rectification_no[$key] ?? null,
                'opposition_hearing_date' => formatDate($request->opposition_hearing_date[$key] ?? null, 'Y-m-d'),
                'status' => $request->status[$key] ?? null,
                'consultant' => $request->consultant[$key] ?? null,
                'deal_with' => $request->deal_with[$key] ?? null,
                'filed_by' => $request->filed_by[$key] ?? null,
                'client_remarks' => $request->client_remarks[$key] ?? null,
                'remarks' => $request->remarks[$key] ?? null,
                'sub_status' => $request->sub_status[$key] ?? null,
                'office_id' => $request->office_id[$key] ?? null,
                'sub_category' => $request->sub_category[$key] ?? null,
                'ip_field' => $request->ip_field[$key] ?? null,
                'email_remarks' => $request->email_remarks[$key] ?? null,
                'evidence_last_date' => formatDate($request->evidence_last_date[$key] ?? null, 'Y-m-d'),
                'client_communication' => $request->client_communication[$key] ?? null,
                'mail_recived_date' => formatDate($request->mail_recived_date[$key] ?? null, 'Y-m-d'),
                'mail_recived_date_2' => formatDate($request->mail_recived_date_2[$key] ?? null, 'Y-m-d'),
                'valid_up_to' => formatDate($request->valid_up_to[$key] ?? null, 'Y-m-d'),
                'financial_year' => $request->financial_year[$key] ?? null,
            ]);

          
            if($trademarkUser->save()){
            StatusHistory::create([
                'client_id' => $trademarkUser->id,
                'file_name' => $request->file_name[$key] ?? null,
                'status_history' => json_encode([
                    [
                        'status' => $request->status[$key] ?? null,
                        'sub_status' =>  $request->sub_status[$key] ?? null,
                        'date' => formatDate($request->filling_date[$key] ?? '', 'Y-m-d'),
                        'time' => now()->toDateString(),
                    ],
                ]),
            ]);
        }
    

            $status = true;
        }

        DB::commit(); 

        return redirect()->route('admin.reports.clients-reports')
            ->with(['success' => 'Client Record Import Successfully Done!']);

    } catch (\Exception $e) {
        DB::rollBack(); 

        Log::error('Client Import Error: ' . $e->getMessage());

        return redirect()->route('admin.reports.clients-reports')
            ->with(['error' => 'Client Record Import Failed!']);
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

