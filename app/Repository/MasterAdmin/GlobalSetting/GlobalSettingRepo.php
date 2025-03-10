<?php

namespace App\Repository\MasterAdmin\GlobalSetting;

use App\Models\AttorneysModel;
use App\Models\ConsultantModel;
use App\Models\DeallerModel;
use App\Repository\AbstractMethod\RepositoryContract;
use App\Models\Record;
use App\Models\FinancialYearModel;
use App\Models\MainCategoryModel;
use App\Models\StatusModel;
use App\Models\TradeMarkClassModel;

class GlobalSettingRepo extends RepositoryContract
{
    public function finanacialyear(){
        return FinancialYearModel::query()->record()->get();
    }
    public function maincategory(){
        return MainCategoryModel::query()->record()->get();
    }
    public function ipclasses(){
        return TradeMarkClassModel::query()->record()->get();
    }
    public function attorneys()
    {
        return AttorneysModel::query()->record()->get();
    }
    public function consultants(){
        return ConsultantModel::query()->record()->get();
    }
    public function deallers(){
        return DeallerModel::query()->record()->get();
    }
    public function status($search=null){
        return StatusModel::query()->where($search)->record()->get();
    }
}