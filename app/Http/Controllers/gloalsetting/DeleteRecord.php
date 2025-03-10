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
