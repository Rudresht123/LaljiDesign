<?php

namespace App\Exports;

use App\Model\MasterAdmin\GlobalSetting\DynamicReportSetting;
use http\Env\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportExcelFile implements FromView
{
    protected $tabledata;
    protected $colspan;

    function __construct($tabledata,$colspan) {
        $this->tabledata = $tabledata;
        $this->colspan=$colspan;
    }
    public function view(): View
    {
        $schoolname="";
        $schooladdress="";
        return view('Print.export-excel',['data'=>$this->tabledata,'colspan'=>$this->colspan,'schoolname'=>$schoolname,'schooladdress'=>$schooladdress]);
    }
}
