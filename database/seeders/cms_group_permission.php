<?php

namespace Database\Seeders;

use App\Models\MainCategoryModel;
use App\Models\PermissionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CmsGroupPermissionModel;
use App\Models\AttorneysModel;

class cms_group_permission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attorneys = AttorneysModel::all();
        $categories = MainCategoryModel::all();
        $permissionGroups = PermissionGroup::all();
        $staticPermissions = [
        
            [
               'permission_group'=>1,
                'permission_name' => 'SHUBHAM ATTORNEY',
                'permission_route' => '1',
            ],
            [
               'permission_group'=>1,
                'permission_name' => 'PURI & PURI',
                'permission_route' => '2',
            ],
            [
               'permission_group'=>1,
                'permission_name' => 'DIRECT ATTORNEY',
                'permission_route' => '3',
            ],
            [
               'permission_group'=>1,
                'permission_name' => 'VANI ATTORNEY',
                'permission_route' => '4',
            ],
            [
               'permission_group'=>1,
               'permission_name' => 'LALJI ADVOCATES',
               'permission_route' => '5',
           ],
           [
            'permission_group'=>1,
               'permission_name' => 'MISC',
               'permission_route' => '6',
           ],
         
             [
               'permission_group'=>2,
                 'permission_name' => 'Copyright',
                 'permission_route' => 'copyright',
             ],
             [
               'permission_group'=>2,
                 'permission_name' => 'Trademark',
                 'permission_route' => 'trademark',
             ],
             [
               'permission_group'=>2,
                 'permission_name' => 'Design',
                 'permission_route' => 'design',
             ],
         
         
             [
               'permission_group'=>3,
                 'permission_name' => 'Attorney Show',
                 'permission_route' => 'admin.global-setting.attorneys',
             ],
             [
               'permission_group'=>3,
                 'permission_name' => 'Attorney Create',
                 'permission_route' => 'admin.global-setting.create.attorneys',
             ],
             [
               'permission_group'=>3,
                 'permission_name' => 'Attorney Edit',
                 'permission_route' => 'admin.global-setting.edit.attorneys',
             ],
             [
               'permission_group'=>3,
                 'permission_name' => 'Attorney Delete',
                 'permission_route' => 'RecordDelete.attoerney',
             ],
        
             [
               'permission_group'=>4,
                 'permission_name' => 'Show Create',
                 'permission_route' => 'admin.global-setting.main-category',
             ],
             [
               'permission_group'=>4,
                 'permission_name' => 'Create Category',
                 'permission_route' => 'admin.global-setting.create-main-category',
             ],
             [
               'permission_group'=>4,
                 'permission_name' => 'Edit Category',
                 'permission_route' => 'admin.global-setting.edit-main-category',
             ],
             [
               'permission_group'=>4,
                 'permission_name' => 'Delete Category',
                 'permission_route' => 'RecordDelete.MainCategory',
             ],
         
             [
               'permission_group'=>5,
                 'permission_name' => 'Show Financial Year',
                 'permission_route' => 'admin.global-setting.financialYear',
             ],
             [
               'permission_group'=>5,
                 'permission_name' => 'Create Financial Year',
                 'permission_route' => 'admin.global-setting.financialYear',
             ],
             [
               'permission_group'=>5,
                 'permission_name' => 'Edit Financial Year',
                 'permission_route' => 'admin.global-setting.edit.financialYear',
             ],
             [
               'permission_group'=>5,
                 'permission_name' => 'Delete Financial Year',
                 'permission_route' => 'RecordDelete.FinancialYear',
             ],
        
             [
               'permission_group'=>6,
                 'permission_name' => 'Show Sub Category',
                 'permission_route' => 'admin.global-setting.sub-category',
             ],
             [
               'permission_group'=>6,
                 'permission_name' => 'Create Sub Category',
                 'permission_route' => 'admin.global-setting.show-sub-category',
             ],
             [
               'permission_group'=>6,
                 'permission_name' => 'Edit Sub Category',
                 'permission_route' => 'admin.global-setting.edit.sub-category',
             ],
             [
               'permission_group'=>6,
                 'permission_name' => 'Delete Sub Category',
                 'permission_route' => 'RecordDelete.SubCategory',
             ],
         
             [
               'permission_group'=>7,
                 'permission_name' => 'Show Status',
                 'permission_route' => 'admin.global-setting.status',
             ],
             [
               'permission_group'=>7,
                 'permission_name' => 'Create Status',
                 'permission_route' => 'admin.global-setting.create-status',
             ],
             [
               'permission_group'=>7,
                 'permission_name' => 'Edit Status',
                 'permission_route' => 'admin.global-setting.edit-status',
             ],
             [
               'permission_group'=>7,
                 'permission_name' => 'Delete Status',
                 'permission_route' => 'RecordDelete.status',
             ],
        
             [
               'permission_group'=>8,
                 'permission_name' => 'Show Remarks',
                 'permission_route' => 'admin.global-setting.remarks',
             ],
             [
               'permission_group'=>8,
                 'permission_name' => 'Create Remarks',
                 'permission_route' => 'admin.global-setting.create-remarks',
             ],
             [
               'permission_group'=>8,
                 'permission_name' => 'Edit Remarks',
                 'permission_route' => 'admin.global-setting.edit-remarks',
             ],
             [
               'permission_group'=>8,
                 'permission_name' => 'Delete Remarks',
                 'permission_route' => 'RecordDelete.Remarks',
             ],
        
             [
               'permission_group'=>9,
                 'permission_name' => 'Show Dealer',
                 'permission_route' => 'admin.global-setting.dealer',
             ],
             [
               'permission_group'=>9,
                 'permission_name' => 'Create Dealer',
                 'permission_route' => 'admin.global-setting.create-dealer',
             ],
             [
               'permission_group'=>9,
                 'permission_name' => 'Edit Dealer',
                 'permission_route' => 'admin.global-setting.edit-dealer',
             ],
             [
               'permission_group'=>9,
                 'permission_name' => 'Delete Dealer',
                 'permission_route' => 'RecordDelete.Dealers',
             ],
       
             [
               'permission_group'=>10,
                 'permission_name' => 'Show Consultant',
                 'permission_route' => 'admin.global-setting.consultant',
             ],
             [
               'permission_group'=>10,
                 'permission_name' => 'Create Consultant',
                 'permission_route' => 'admin.global-setting.create-consultant',
             ],
             [
               'permission_group'=>10,
                 'permission_name' => 'Edit Consultant',
                 'permission_route' => 'admin.global-setting.edit-consultant',
             ],
             [
               'permission_group'=>10,
                 'permission_name' => 'Delete Consultant',
                 'permission_route' => 'RecordDelete.Consultant',
             ],
       
             [
               'permission_group'=>11,
                 'permission_name' => 'Show Excel Column',
                 'permission_route' => 'admin.global-setting.excelcolumn',
             ],
             [
               'permission_group'=>11,
                 'permission_name' => 'Create Excel Column',
                 'permission_route' => 'admin.global-setting.create-excelcolumn',
             ],
             [
               'permission_group'=>11,
                 'permission_name' => 'Edit Excel Column',
                 'permission_route' => 'admin.global-setting.edit-excelcolumn',
             ],
             [
               'permission_group'=>11,
                 'permission_name' => 'Delete Excel Column',
                 'permission_route' => 'RecordDelete.Excelcolumns',
             ],
       
             [
               'permission_group'=>12,
                 'permission_name' => 'Show Offices',
                 'permission_route' => 'admin.global_setting.office',
             ],
             [
               'permission_group'=>12,
                 'permission_name' => 'Create Office',
                 'permission_route' => 'admin.global_setting.create-office',
             ],
             [
               'permission_group'=>12,
                 'permission_name' => 'Edit Office',
                 'permission_route' => 'admin.global_setting.edit-office',
             ],
             [
               'permission_group'=>12,
                 'permission_name' => 'Delete Office',
                 'permission_route' => 'RecordDelete.office',
             ],
       
             [
               'permission_group'=>13,
                 'permission_name' => 'Show Pdf Template',
                 'permission_route' => 'admin.global-setting.pdf-template',
             ],
             [
               'permission_group'=>13,
                 'permission_name' => 'Create Pdf Template',
                 'permission_route' => 'admin.global-setting.create-pdf-template',
             ],
             [
               'permission_group'=>13,
                 'permission_name' => 'Edit Pdf Template',
                 'permission_route' => 'admin.global-setting.edit-pdf-template',
             ],
             [
               'permission_group'=>13,
                 'permission_name' => 'Delete Template',
                 'permission_route' => 'RecordDelete.PDFTemplate',
             ],
        
             [
               'permission_group'=>14,
                 'permission_name' => 'Show Category For Registration',
                 'permission_route' => 'admin.attorney.show-category',
             ],
             [
               'permission_group'=>14,
                 'permission_name' => 'User Registration',
                 'permission_route' => 'admin.attorney.user-registration',
             ],
         
             [
               'permission_group'=>15,
                 'permission_name' => 'Clients Reports',
                 'permission_route' => 'admin.reports.clients-reports',
             ],
             [
               'permission_group'=>15,
                 'permission_name' => 'Import Data',
                 'permission_route' => 'admin.excels-import.clients-import',
             ],
             [
               'permission_group'=>15,
                 'permission_name' => 'Export Data',
                 'permission_route' => 'admin.excels-import.clients-export',
             ],
             [
              'permission_group'=>20,
                'permission_name' => 'Show DPP Report Form',
                'permission_route' => 'admin.client-dpp-reports',
            ],
            [
              'permission_group'=>20,
                'permission_name' => 'Get DPP Report Data',
                'permission_route' => 'admin.client-get-dpp-reports',
            ],
            [
              'permission_group'=>20,
                'permission_name' => 'Download DPP Report',
                'permission_route' => 'admin.dpp-repots.export',
            ],
             [
               'permission_group'=>15,
                 'permission_name' => 'Print PDF',
                 'permission_route' => 'admin.client-details.print-pdf',
             ],
       
             [
               'permission_group'=>16,
                 'permission_name' => 'Show Email Template',
                 'permission_route' => 'admin.systemsetting.all-email-template',
             ],
             [
               'permission_group'=>16,
                 'permission_name' => 'Create Email Template',
                 'permission_route' => 'admin.systemsetting.create-template',
             ],
             [
               'permission_group'=>16,
                 'permission_name' => 'Edit Email Template',
                 'permission_route' => 'admin.systemsetting.edit-template',
             ],
             [
               'permission_group'=>16,
                 'permission_name' => 'Delete Email Template',
                 'permission_route' => 'admin.block-data',
             ],
             [
              'permission_group'=>17,
                'permission_name' => 'Show Client Status History',
                'permission_route' => 'admin.status.client-status',
            ],
             [
              'permission_group'=>18,
                'permission_name' => 'Show User Roles',
                'permission_route' => 'admin.users-roles.users',
            ],
            [
              'permission_group'=>18,
                'permission_name' => 'Create Users',
                'permission_route' => 'admin.users-roles.create-users',
            ],
            [
              'permission_group'=>18,
                'permission_name' => 'Edit Users',
                'permission_route' => 'admin.users-roles.edit-users',
            ],
            [
              'permission_group'=>18,
                'permission_name' => 'Delete Users',
                'permission_route' => 'RecordDelete.deleteSoftwareUsers',
            ],
            [
              'permission_group'=>19,
                'permission_name' => 'Show Permission Group',
                'permission_route' => 'admin.user-roles.permission-group',
            ],
            [
              'permission_group'=>19,
                'permission_name' => 'Create Permission Group',
                'permission_route' => 'admin.global-setting.create-permission-group',
            ],
            [
              'permission_group'=>19,
                'permission_name' => 'Edit Permission Group',
                'permission_route' => 'admin.global-setting.edit-permission-group',
            ],
            [
              'permission_group'=>19,
                'permission_name' => 'Delete Permission Group',
                'permission_route' => 'RecordDelete.PermissionGroup',
            ],
            ];

     
    
                
                  // Insert Permissions in Bulk with Transaction
DB::transaction(function () use ($staticPermissions) {
  // Fetch existing permission routes
  $existingRoutes = CmsGroupPermissionModel::whereIn('permission_route', collect($staticPermissions)->pluck('permission_route'))->pluck('permission_route')->toArray();

  // Filter out permissions that already exist
  $filteredPermissions = collect($staticPermissions)->reject(function ($permission) use ($existingRoutes) {
      return in_array($permission['permission_route'], $existingRoutes);
  })->toArray();

  // Insert only non-duplicate permissions
  if (!empty($filteredPermissions)) {
      CmsGroupPermissionModel::insert($filteredPermissions);
  }
});

                }
    }
   
