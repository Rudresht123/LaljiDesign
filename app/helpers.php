<?php
use App\Repository\MasterAdmin\GlobalSetting\GlobalSettingRepo;

if(!function_exists('attorneys')){
    function attorneys()
    {
        return (new GlobalSettingRepo())->attorneys();
    }
}
if(!function_exists('categories')){
    function categories()
    {
        return (new GlobalSettingRepo())->maincategory();
    }
}
if(!function_exists('ipclasses')){
    function ipclasses()
    {
        return (new GlobalSettingRepo())->ipclasses();
    }
}
if(!function_exists('consultants')){
    function consultants()
    {
        return (new GlobalSettingRepo())->consultants();
    }
}
if(!function_exists('deallers')){
    function deallers()
    {
        return (new GlobalSettingRepo())->deallers();
    }
}
if(!function_exists('status')){
    function status()
    {
        return (new GlobalSettingRepo())->status();
    }
}




?>