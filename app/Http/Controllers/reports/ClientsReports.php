<?php

namespace App\Http\Controllers\reports;

use App\Http\Controllers\Controller;
use App\Models\AttorneysModel;
use App\Models\ExcelColumnNameModel;
use App\Models\MainCategoryModel;
use App\Models\ConsultantModel;
use App\Models\StatusModel;
use App\Models\SubcategoryModel;
use Illuminate\Http\Request;
use App\Models\UserPermissionModel;
use App\Repository\Interfaces\UserPermissionInterface;
use App\Repository\UserPermissionRepo;
use Schema;
use Auth;

class ClientsReports extends Controller
{
    public function Clients()
    {

        $userPermissionRepository = new UserPermissionRepo();
        $attorneys = AttorneysModel::whereIn('id', $userPermissionRepository->getAtteorneys())
            ->where('status', 'yes')
            ->get();

        $statuss = StatusModel::where('status', 'yes')->get();
        $mcategories = MainCategoryModel::whereIn('id', $userPermissionRepository->getCategorys())->where('status', 'yes')->get();

        $subcategory = SubcategoryModel::where('status', 'yes')->get();

        $columns = ExcelColumnNameModel::where('status', 'yes')->get();

        return view('admin_panel.reports.client_reports', compact('attorneys', 'statuss', 'mcategories', 'subcategory', 'columns'));
    }
}
