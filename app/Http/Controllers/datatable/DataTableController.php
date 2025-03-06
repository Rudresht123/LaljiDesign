<?php

namespace App\Http\Controllers\datatable;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class DataTableController extends Controller
{
    public function CommonTable(Request $request)
{
    $tbTable = $request->input('db_table');
    if ($tbTable) {
      
        $data = DB::table(table: $tbTable);

        // Check if the table has the columns 'is_active' and 'status'
        $hasIsActive = Schema::hasColumn($tbTable, 'is_active');
        $hasStatus = Schema::hasColumn($tbTable, 'status');

        // Apply search filter if provided
        if ($request->filled('search.value')) {
            $searchValue = trim($request->input('search.value'));
            $data->where(function ($q) use ($searchValue, $tbTable) {
                $columns = Schema::getColumnListing($tbTable); // Use the dynamic table name
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', '%' . $searchValue . '%');
                }
            });
        }

        // Apply order by
        if ($request->has('order')) {
            $order = $request->input('order')[0];
            $columnIndex = $order['column'];
            $sortDirection = $order['dir'];
            $columns = $request->input('columns');

            if (isset($columns[$columnIndex])) {
                $columnName = $columns[$columnIndex]['name'];
                if ($columnName !== 'DT_RowIndex') {
                    $data->orderBy($columnName, $sortDirection);
                }
            }
        } else {
            $data->orderBy('id', 'asc'); // Default ordering
        }

        // Pagination
        $length = $request->input('length', 10);
        $start = $request->input('start', 0);

        $filteredRecords = $data->count();
        if($tbTable=='admins'){
            $data = $data->skip($start)
            ->take($length)
            ->where('role', '!=', 'superadmin')
            ->get();
        }
        else{
        $data = $data->skip($start)->take($length)->get();
    }
        $totalRecords = DB::table($tbTable)->count();

        // Format data dynamically
       $formattedData = $data->transform(function ($item, $index) use ($start, $request, $hasIsActive, $hasStatus, $tbTable) {
            $columns = $request->input('columns');
            $formattedRow = [];

            foreach ($columns as $column) {
                $columnName = $column['data'];
                if ($columnName === 'is_active' && $hasIsActive) {
                    $formattedRow['is_active'] = $item->is_active == 'yes'
                        ? '<span class="badge text-bg-success">Active</span>'
                        : '<span class="badge text-bg-danger">De-Active</span>';
                } elseif ($columnName === 'status' && $hasStatus) {
                    $formattedRow['status'] = $item->status == 'yes'
                        ? '<span class="badge text-bg-success">Active</span>'
                        : '<span class="badge text-bg-danger">De-Active</span>';
                } else {
                    $formattedRow[$columnName] = $item->$columnName ?? '';
                }
            }

            // Add action buttons
            if($tbTable=='attorneys'){
                if(auth()->user()->hasPermission('admin.global-setting.edit.attorneys')){
                $formattedRow['actions'] = '
                <td class="d-flex justify-content-center">
                    <a href="' . route('admin.global-setting.edit.attorneys', $item->id) . '" 
                       class="text-primary p-1 rounded fw-bold" 
                       title="Edit Data" data-id="' . $item->id . '">
                       <i class="far fa-edit"></i>
                    </a>
                </td>';
            }
        }
        elseif($tbTable=='admins'){
            if(auth()->user()->hasPermission('admin.users-roles.edit-users')){
  $formattedRow['actions'] = '
                <td class="d-flex justify-content-center">
                    <a href="' . route('admin.users-roles.edit-users', $item->id) . '" 
                       class="text-primary p-1 rounded fw-bold" 
                       title="Edit Data" data-id="' . $item->id . '">
                       <i class="far fa-edit"></i>
                    </a>
                </td>';
        }
    }
            else{
               if(auth()->user()->hasPermission(  $this->selectTable($tbTable))){
                $formattedRow['actions'] = '
                <td class="d-flex justify-content-center">
                    <a href="" class="editButton" title="Edit Data" data-id="' . $item->id . '"
                       class="text-primary p-1 rounded fw-bold "><i class="far fa-edit"></i></a>';
               }
            }
            if(Auth::user()->role=='superadmin'){
            if (($hasIsActive && $item->is_active == 'yes') || ($hasStatus && $item->status == 'yes')) {
                $formattedRow['actions'] .= '
                    <a href="" title="Block Data" class="blockButton ms-1 text-danger" data-id="' . $item->id . '"
                       class="text-danger p-1 rounded fw-bold "><i class="fa fa-ban text-danger" aria-hidden="true"></i></a>';                
            } else {
                
                $formattedRow['actions'] .= '
                    <a href="" title="Un Block Data" class="blockButton ms-1 text-success" data-id="' . $item->id . '"
                       class="text-success p-1 rounded fw-bold "><i class="fa fa-unlock" aria-hidden="true"></i></a>';
        }
    }

            $formattedRow['actions'] .= '
                <a href="" style="display:none" data-id="' . $item->id . '"
                   class="deletebutton hidden text-danger p-1 rounded fw-bold "><i class="fa fa-trash"></i></a>
                </td>
            ';

            return $formattedRow;
        });

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $formattedData,
        ]);
    } else {
        return response()->json('Table is not Defined');
    }
}
public function selectTable($tbTable){
    switch ($tbTable) {
        case 'client_remarks':
            $route = 'admin.global-setting.edit-client-remarks'; 
            break;
        case 'client_status_history':
            $route = 'admin.attorneys.index'; 
            break;
        case 'consultant':
            $route = 'admin.global-setting.edit-consultant'; 
            break;
        case 'deal_with':
            $route = 'admin.global-setting.edit-dealler'; 
            break;
        case 'excelcolumn_name':
            $route = 'admin.global-setting.edit-excelcolumn'; 
            break;
        case 'financial_year':
            $route = 'admin.global-setting.edit.financialYear'; 
            break;
        case 'main_category':
            $route = 'admin.global-setting.edit-main-category'; 
            break;
        case 'offices':
            $route = 'admin.global_setting.edit-office'; 
            break;
        case 'pdf_templates':
            $route = 'admin.global-setting.edit-pdf-template'; 
            break;
        case 'remarks':
            $route = 'admin.global-setting.edit-remarks'; 
            break;
        case 'sessions':
            $route = 'admin.global-setting.edit.financialYear'; 
            break;
        case 'status':
            $route ='admin.global-setting.edit-status'; 
            break;
        case 'sub_category':
            $route = 'admin.global-setting.edit.sub-category'; 
            break;
        case 'sub_status':
            $route = 'admin.global-setting.edit-sub-status'; 
            break;
        case 'trademark_users':
            $route = 'admin.attorney.updatetrademarkformdata'; 
            break;
        case 'user_permissions':
            $route ='admin.users-roles.edit-users'; 
            break;
        default:
            $route = null; 
    }

    return $route;


    
}
}
