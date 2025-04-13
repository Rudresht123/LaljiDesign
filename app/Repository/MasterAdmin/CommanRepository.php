<?php

namespace App\Repository\MasterAdmin;

use App\Repository\AbstractMethod\RepositoryContract;
use App\Models\Record;
use App\Models\FinancialYearModel;
use App\Models\MainCategoryModel;
use App\Models\TrademarkUserModel;
class CommanRepository extends RepositoryContract
{
    /**
     * Create a new class instance.
     */
public function getDppClientData($search=null){
return TrademarkUserModel::query()->record()->get();
  }
  public function getFinancialyear($search=null){
    return FinancialYearModel::where('is_active','yes')->get();
  }
  public function getCategory($search=null){
    return MainCategoryModel::query()->record()->get();
  }
  public function getDppClientDataSearch($search = null)
  {
      $query = TrademarkUserModel::query();
  
      if (isset($search['client_name'])) {
          $query->where('file_name', $search['client_name']);
      }
      if (isset($search['session_year'])) {
          $query->where('session_year', $search['session_year']);
      }
      if (isset($search['category'])) {
          $query->where('category_id', $search['category']);
      }
  
      // Subquery to get the latest entry for each trademark_name
      return $query->whereNotNull('trademark_name')
                   ->whereIn('id', function ($subquery) {
                       $subquery->selectRaw('MAX(id)')
                                ->from('trademark_users')
                                ->groupBy('application_no');
                   })
                   ->with('statusMain')
                   ->orderBy('id', 'desc')
                   ->get();
  }
   public function getAllData($category)
  {
    if ($category == 'trademark') {
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
    }
    return $query;
  }
  
  
}
