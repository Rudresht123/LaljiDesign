<?php

namespace App\Repository\MasterAdmin\GlobalSetting;

use App\Models\AttorneysModel;
use App\Models\ClientRemarksModel;
use App\Models\ConsultantModel;
use App\Models\DeallerModel;
use App\Repository\AbstractMethod\RepositoryContract;
use App\Models\Record;
use App\Models\FinancialYearModel;
use App\Models\MainCategoryModel;
use App\Models\OfficesModel;
use App\Models\PermissionGroup;
use App\Models\RemarksModel;
use App\Models\StatusModel;
use App\Models\SubcategoryModel;
use App\Models\SubStatusModel;
use App\Models\TradeMarkClassModel;

class GlobalSettingRepo extends RepositoryContract
{
    public function finanacialyear($search=null){
        return FinancialYearModel::query()->where($search)->record()->get();
    }
    public function maincategory($search = null){
        return MainCategoryModel::query()->where($search)->record()->get();
    }
    public function ipclasses($search = null){
        return TradeMarkClassModel::query()->where($search)->record()->get();
    }
    public function attorneys($search = null)
    {
        return AttorneysModel::query()->where($search)->record()->get();
    }
    public function consultants($search = null){
        return ConsultantModel::query()->where($search)->record()->get();
    }
    public function deallers($search = null){
        return DeallerModel::query()->where($search)->record()->get();
    }
    public function status($search=null){
        return StatusModel::query()->where($search)->record()->get();
    }
    public function substatus($search=null){
        return SubStatusModel::query()->where($search)->record()->get();
    }
    public function offices($search = null)
    {
        return OfficesModel::query()->where($search)->record()->get();
    }
    public function subcategory($search=null){
        return SubcategoryModel::query()->where($search)->record()->get();
    }
    public function financialyears()
    {
        return FinancialYearModel::query()->record()->get();
    }
    public function remarks($search=null)
    {
        return RemarksModel::query()->where($search)->record()->get();
    }
    public function whatsappremarks()
    {
        return ClientRemarksModel::query()->record()->get();
    }
    public function permissionGroups($search = null){
        return PermissionGroup::query()->where($search)->record()->get();
    }
}