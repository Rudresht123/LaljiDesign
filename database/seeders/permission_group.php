<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PermissionGroup;

class permission_group extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Array of new data to insert
        $data = [
            ['permission_group' => 'Attorneyes', 'permission_group_slug' => 'attorney'],
            ['permission_group' => 'Category', 'permission_group_slug' => 'category'],
            ['permission_group' => 'Define Attorneyes', 'permission_group_slug' => 'define_attorney'],
            ['permission_group' => 'Define Main Category', 'permission_group_slug' => 'define_category'],
            ['permission_group' => 'FinancialYear', 'permission_group_slug' => 'financialyear'],
            ['permission_group' => 'Sub Category', 'permission_group_slug' => 'sub_category'],
            ['permission_group' => 'Status', 'permission_group_slug' => 'Status'],
            ['permission_group' => 'Sub Status Remarks', 'permission_group_slug' => 'sub_status'],
            ['permission_group' => 'Dealler', 'permission_group_slug' => 'dealler'],
            ['permission_group' => 'Consultant', 'permission_group_slug' => 'consultant'],
            ['permission_group' => 'Excel Column', 'permission_group_slug' => 'excel_column'],
            ['permission_group' => 'Trademark Offices', 'permission_group_slug' => 'offices'],
            ['permission_group' => 'User PDF', 'permission_group_slug' => 'user_pdf'],
            ['permission_group' => 'User Registration', 'permission_group_slug' => 'user_registration'],
            ['permission_group' => 'Clients Reports', 'permission_group_slug' => 'clents_reports'],
            ['permission_group' => 'Pdf Setting', 'permission_group_slug' => 'print_pdf'],
            ['permission_group' => 'Email Template', 'permission_group_slug' => 'print_pdf'],
            ['permission_group' => 'Client Status History', 'permission_group_slug' => 'client_status_history'],
            ['permission_group' => 'Client DPP Report', 'permission_group_slug' => 'client_dpp_report'],
        ];

        foreach ($data as $item) {
            $exists = PermissionGroup::where('permission_group_slug', $item['permission_group_slug'])->exists();

            if (!$exists) {
                PermissionGroup::insert($item);
            }
        }
    }
}
