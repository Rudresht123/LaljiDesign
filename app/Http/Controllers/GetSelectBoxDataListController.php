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
        $data=[];
             if($datawith=='status'){
                $data=(new GlobalSettingRepo())->status(['category_id'=>])
             }
        return response()->json($data);
    }
}
