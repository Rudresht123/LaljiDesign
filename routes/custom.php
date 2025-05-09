<?php

use App\Http\Controllers\Chart\ChartController;
use App\Http\Controllers\reports\StatusHistoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Controllers\CustomFunctions;

// Session Update
Route::get('admin/global-setting/custom-functions/getSubstatus/{id}',[CustomFunctions::class,'getSubStatus'])->name('getsubstatus')->middleware(['auth','verified']);
Route::post('admin/global-setting/custom-functions/getFillterdata',[CustomFunctions::class,'getClients'])->name('admin.getFiellterClientsData')->middleware(['auth','verified']);
Route::post('admin/clients-reporst/custom-functions/getClientDetailsForUpdateStatus',[CustomFunctions::class,'getClientDetailsForUpdateStatus'])->name('admin.getClientDataForUpdate')->middleware(['auth','verified']);
Route::post('admin/clients-reporst/custom-functions/updateclient-status',[CustomFunctions::class,'UpdateClientStatus'])->name('admin.UpdateClientStatus')->middleware(['auth','verified']);
Route::post('admin/clients-reporst/custom-functions/getClients',[CustomFunctions::class,'getClients'])->name('admin.getFiellterClientsData')->middleware(['auth','verified']);




// chart controller routes start here
Route::get('/admin/chart/CategoryWiseUserCount',[ChartController::class,'categoryWiseClientChart'])->name('admin.chart.CategoryWiseUserCount')->middleware(['auth','verified']);
Route::get('/admin/chart/StatusWiseClientCount',[ChartController::class,'statusWisewiseClientChart'])->name('admin.chart.statusWiseClientChart')->middleware(['auth','verified']);
Route::get('/admin/chart/attoernyWiseCLientChart',[ChartController::class,'attoernyWiseCLientChart'])->name('admin.chart.attoernyWiseCLientChart')->middleware(['auth','verified']);
Route::get('/admin/chart/perticularattoernywiseChart/{id}',[ChartController::class,'perticularattoernywiseChart'])->name('admin.chart.perticularattoernywiseChart')->middleware(['auth','verified']);






// Route for the get search client on the dashboar
Route::post('/admin/get/search_cleint',[CustomFunctions::class,'searchCleint'])->name('get.searchClent')->middleware(['auth','verified']);
Route::post('/admin/get/search-cleint-details',[CustomFunctions::class,'searchClientDetails'])->name('get.searchClent-detail-dashboard')->middleware(['auth','verified']);


// Status History Column start here
Route::get('admin/client/status-history/{id}',[StatusHistoryController::class,'getStatusHistory'])->name('admin.status.client-status')->middleware(['auth','verified']);


// Update status Controller For The Main Status With Dynamic COnditional Fields
Route::get('admin/{slug}/client/update-status/{application_no}',[CustomFunctions::class,'getUpdateStatusConditionalFields'])->name('admin.status.UpdateStatusConditionalFields')->middleware(['auth','verified']);


// Update status Controller For The Main Status With Dynamic COnditional Fields
Route::post('admin/block-data',[CustomFunctions::class,'blockData'])->name('admin.block-data')->middleware(['auth','verified']);

// Add same data in second time for the second opposed number
Route::post('admin/save-data-form-other-opposed',[CustomFunctions::class,'SaveDataForAnotherOpposedNumber'])->name('admin.SaveDataForAnotherOpposedNumber')->middleware(['auth','verified']);




// Route for the Attoerny Chart on click Count Open Data
Route::get('admin/client-data/{attorney_id}/{category_slug}/{status_id}', [CustomFunctions::class, 'getAttoernyStatusWiseData'])
    ->name('admin.attorney.chart.status-data')
    ->middleware(['auth', 'verified']);
Route::post('admin/client-data/attoerny-chart-count',[CustomFunctions::class,'getAttoernyChartCountStatusWiseData'])->name('admin.getData-for-attoernychart-count')->middleware(['auth','verified']); 

