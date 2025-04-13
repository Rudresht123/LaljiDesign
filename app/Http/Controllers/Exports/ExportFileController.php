<?php

namespace App\Http\Controllers\Exports;

use App\Exports\ExportExcelFile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportFileController extends Controller
{
    public function exportfile(Request $request)
    {
        libxml_use_internal_errors(true);
        return Excel::download(new ExportExcelFile($request->tabledata,$request->colspan), $request->filename.".".$request->fileformat);
    }
}
