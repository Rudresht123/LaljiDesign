<?php

namespace App\Http\Controllers;

use App\Model\MasterAdmin\MarksManager\ExamType;
use App\Repository\MasterAdmin\GlobalSetting\GlobalSettingRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GetSelectBoxDataListController extends Controller
{
    public function datalist($datawith,Request $request)
    {
        Log::info($request->all());
        $data=[];
             if($datawith=='status'){
                $status=(new GlobalSettingRepo())->status(['category_id'=>$request->category_id]);
                if($status)
                {
                    $data=$status->pluck('status_name','id');
                }
             }
             if($datawith=='substatus'){
                $status=(new GlobalSettingRepo())->substatus(['main_status_id'=>$request->status]);
                if($status)
                {
                    $data=$status->pluck('substatus_name','id');
                }
             }
        return response()->json($data);
    }
}
