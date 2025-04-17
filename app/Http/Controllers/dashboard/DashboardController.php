<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\gloalsetting\TradeMarksClasses;
use App\Models\AttorneysModel;
use App\Models\TrademarkUserModel;
use App\Models\MainCategoryModel;
use App\Models\ConsultantModel;
use App\Models\SubcategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPermissionModel;
use App\Models\CmsGroupPermissionModel;
use App\Repository\MasterAdmin\DashboardsData;
use Carbon\Carbon;
use App\Repository\UserPermissionRepo;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mcategories = MainCategoryModel::where('status', 'yes')->get();
        $consultant = ConsultantModel::where('status', 'yes')->get();
        $subcategory = SubcategoryModel::get();
        $attoernyes = AttorneysModel::where('status', 'yes')->get();

        $groupedData = collect();
        $upcommingdates = [];
        
        $data = (new DashboardsData())->upcommingdates();
        $copyrightdatas = (new DashboardsData())->copyrightupcommingdates();
        $groupedData = $data['groupedData'];
        $datacount = $data['datacount'];
        $upcommingdates = $data['upcommingdates'];

        $copyrightgroupedData = $copyrightdatas['groupedData'];
        $copyrightdatacount = $copyrightdatas['datacount'];
        $copyrightupcommingdates = $copyrightdatas['upcommingdates'];


        return view('admin_panel.dashboard.dashboard', compact('attoernyes', 'groupedData', 'mcategories', 'consultant', 'subcategory', 'upcommingdates', 'datacount','copyrightgroupedData','copyrightdatacount','copyrightupcommingdates'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
