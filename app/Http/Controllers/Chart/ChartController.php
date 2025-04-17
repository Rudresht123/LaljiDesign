<?php

namespace App\Http\Controllers\Chart;

use App\Http\Controllers\Controller;
use App\Models\AttorneysModel;
use App\Models\CopyRight\CopyRightUserModel;
use App\Models\StatusModel;
use Illuminate\Http\Request;
use App\Models\TrademarkUserModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class ChartController extends Controller
{
    public function categoryWiseClientChart(){

       $TrademarkuserCount=TrademarkUserModel::count();
       $CopyRightUserCount=CopyRightUserModel::count();
        $chartData = [
            'labels' => ['Trademark','Copyright','Design'],
            'userCount' => [$TrademarkuserCount,$CopyRightUserCount,0]
        ];

        if($chartData){
        return response()->json($chartData);
    }
    }
    public function statusWisewiseClientChart(){
        $statusCounts = StatusModel::withCount('trademarkUsers')
        ->get();


        $chartData = [
            'labels' => [],
            'count' => [],
        ];

        foreach ($statusCounts as $status) {
           
            $chartData['labels'][] = $status->status_name; 
            $chartData['count'][] = $status->trademark_users_count;  
        }

        if($chartData){
            return response()->json($chartData);
        }
    }
    public function attoernyWiseCLientChart()
    {
        $attorneyData = AttorneysModel::withCount(['trademarkUsers', 'copyRightUsers'])->get();
    
        $chartData = [
            'labels' => [],
            'userCount' => [],
        ];
    
        foreach ($attorneyData as $attorney) {
            $totalClients = $attorney->trademark_users_count + $attorney->copy_right_users_count;
            if ($totalClients > 0) {
                $chartData['labels'][] = $attorney->attorneys_name;
                $chartData['userCount'][] = $totalClients;
            }
        }
    
        return response()->json($chartData);
    }
    public function perticularattoernywiseChart($attoernyId)
    {
        $attorney = AttorneysModel::withCount(['trademarkUsers', 'copyRightUsers'])
            ->where('id', $attoernyId)
            ->first();
    
        $chartData = [
            'labels' => [],
            'userCount' => [],
        ];
    
        if ($attorney) {
            if ($attorney->trademark_users_count > 0) {
                $chartData['labels'][] = 'Trademark';
                $chartData['userCount'][] = $attorney->trademark_users_count;
            }
    
            if ($attorney->copy_right_users_count > 0) {
                $chartData['labels'][] = 'Copyright';
                $chartData['userCount'][] = $attorney->copy_right_users_count;
            }
        }
    
        return response()->json($chartData);
    }
    
    
    
}
