<?php

use App\Http\Controllers\excels\ExcelsImport;
use App\Http\Controllers\pdf\PrintPdfController;
use App\Http\Controllers\reports\ClientsReports;
use App\Http\Controllers\reports\DppReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RolePermissionMiddleware;
use App\Http\Controllers\excels\DownloadExcels;

// reports controller start here
Route::get('admin_panel/reports/client-reports',[ClientsReports::class,'Clients'])->name('admin.reports.clients-reports')->middleware(['auth','verified',RolePermissionMiddleware::class]);


// Excels Import Controller
Route::post('admin/excels-import/clients-import',[ExcelsImport::class,'ClientsImport'])->name('admin.excels-import.clients-import')->middleware(['auth','verified']);
Route::post('admin/excels-export/clients-export',[ExcelsImport::class,'ClientsExcelExport'])->name('admin.excels-import.clients-export')->middleware(['auth','verified']);
Route::post('admin/excels-export/clients-dpp-export',[ExcelsImport::class,'DPPReport'])->name('admin.dpp-repots.export')->middleware(['auth','verified']);
Route::post('admin/excels-export/clients-data-import',[ExcelsImport::class,'ImportsClientData'])->name('admin.data-import')->middleware(['auth','verified']);

// Pdf Print
Route::get('admin/print-client-details/category_slug/{category_slug}/id/{id}',[PrintPdfController::class,'printClientPdf'])->name('admin.client-details.print-pdf')->middleware(['auth','verified',RolePermissionMiddleware::class]);


// Dpp Report Section Start here 
Route::prefix('admin/reports/dpp-reports')->group(function(){
    Route::get('index',[DppReportController::class,'ddpreport'])->name('admin.client-dpp-reports')->middleware([RolePermissionMiddleware::class]);
    Route::post('get-data',[DppReportController::class,'ddpreportdata'])->name('admin.client-get-dpp-reports');
})->middleware(['auth','verified']);




// Upcoming dates excel download here
Route::get('/get-upcomingdates-excel-data/{category}/client/{ids}',[DownloadExcels::class,'upcomingdatesExcel'])->name('upcomingdatesexcel');