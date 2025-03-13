<?php

namespace App\Http\Controllers\gloalsetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Exception;

class DeleteRecord extends Controller
{

    public function deleteFinancialYear($id)
    {
        return $this->deleteRecord('financial_year', $id);
    }
    public function deleteMainCategory($id)
    {
        return $this->deleteRecord('main_category', $id);
    }
    public function deleteStatus($id){
        return $this->deleteRecord('status', $id); 
    }
    public function deleteOffice($id){
        return $this->deleteRecord('offices', $id);  
    }
    public function deleteRemarks($id){
        return $this->deleteRecord('remarks', $id);
    }
    public function deleteWhatsapRemarks($id)
    {
        return $this->deleteRecord('client_remarks', $id);
    }
    public function deleteConsultant($id)
    {
        return $this->deleteRecord('consultant', $id);
    }
    public function deleteDealers($id)
    {
        return $this->deleteRecord('deal_with', $id);
    }
    public function deleteExcelcolumns($id){
        return $this->deleteRecord('excelcolumn_name', $id); 
    }
    public function deletePermissionGroup($id)
    {
        return $this->deleteRecord('cms_permission_groups', $id); 
    }
    public function deleteSoftwareUsers($id){
        return $this->deleteRecord('admins', $id); 
    }
    private function deleteRecord($table_name, $id)
    {
        try {
            if (!Schema::hasTable($table_name)) {
                return back()->with(['error' => 'Table not found']);
            }

            $record = DB::table($table_name)->where('id', $id)->first();
            if (!$record) {
                return back()->with(['error' => 'No record found']);
            }

            $deleted = DB::table($table_name)->where('id', $id)->update(['deleted_at' => now()]);

            if ($deleted) {
                return back()->with(['success' => 'Record Deleted Successfully']);
            } else {
                return back()->with(['error' => 'Failed to delete record']);
            }
        } catch (Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }
}
