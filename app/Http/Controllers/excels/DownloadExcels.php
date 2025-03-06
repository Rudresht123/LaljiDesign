<?php

namespace App\Http\Controllers\excels;

use App\Exports\UpcomigDateExcel;
use App\Http\Controllers\Controller;
use App\Repository\MasterAdmin\CommanRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class DownloadExcels extends Controller
{
    public function upcomingdatesExcel($category, $ids)
    {
        $idArray = explode(',', $ids);

        // Fetch data filtered by category and IDs
        $query = (new CommanRepository())->getAllData($category)
            ->whereIn('id', $idArray)
            ->get();
            return Excel::download(new UpcomigDateExcel($query), 'trademark_clients.xlsx');
    }
}
