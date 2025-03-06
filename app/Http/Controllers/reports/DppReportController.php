<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FinancialYearModel;
use App\Repository\MasterAdmin\CommanRepository;

class DppReportController extends Controller
{
    public function ddpreport(){
        $maincategory=(new CommanRepository())->getCategory();
        $financial_year=(new CommanRepository())->getFinancialyear();
        $clients=(new CommanRepository())->getDppClientData();
        return view('admin_panel.reports.dpp_report.index',compact('maincategory','financial_year','clients'));
    }
    public function ddpreportdata(Request $reuqest){
        $searchdata=$reuqest->all();
        $maincategory=(new CommanRepository())->getCategory();
        $financial_year=(new CommanRepository())->getFinancialyear();
        $clients=(new CommanRepository())->getDppClientData();
        $searchclients=(new CommanRepository())->getDppClientDataSearch($reuqest->all());
        return view('admin_panel.reports.dpp_report.index',compact('searchdata','searchclients','maincategory','financial_year','clients'));
    }
}
