<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\gloalsetting\UsersRolesController;
use App\Http\Controllers\gloalsetting\PermissionGroupController;
use App\Http\Middleware\RolePermissionMiddleware;
// User ROles COntroller start here
Route::get("admin/user-roles/users", [UsersRolesController::class,'Users'])->name('admin.users-roles.users')->middleware(['auth','verified',RolePermissionMiddleware::class]);
Route::get("admin/user-roles/create-users", [UsersRolesController::class,'createUser'])->name('admin.users-roles.create-users')->middleware(['auth','verified',RolePermissionMiddleware::class]);
Route::post("admin/user-roles/create-users", [UsersRolesController::class,'createUserStore'])->name('admin.users-roles.store-create-users')->middleware(['auth','verified']);
Route::get("admin/user-roles/edit-users/{id}", [UsersRolesController::class,'editUser'])->name('admin.users-roles.edit-users')->middleware(['auth','verified',RolePermissionMiddleware::class]);
Route::post("admin/user-roles/edit-users-record/{id}", [UsersRolesController::class,'updateUserPermission'])->name('admin.users-roles.edit-users-permission')->middleware(['auth','verified']);



// permission group section start here
Route::get('admin/global_setting/user-roles/permission-group',[PermissionGroupController::class,'index'])->name('admin.user-roles.permission-group')->middleware(middleware: ['auth','verified',RolePermissionMiddleware::class]);
Route::post('admin/global_setting/permission-group',[PermissionGroupController::class,'store'])->name('admin.global-setting.create-permission-group')->middleware(['auth','verified',RolePermissionMiddleware::class]);
Route::get('admin/global_setting/permission-group/{id}',[PermissionGroupController::class,'edit'])->name('admin.global-setting.edit-permission-group')->middleware(['auth','verified',RolePermissionMiddleware::class]);
Route::put('admin/global_setting/permission-group/{id}',[PermissionGroupController::class,'update'])->name('admin.global-setting.update-permission-group')->middleware(['auth','verified']);

