<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'role_name' => 'Admin',
                'description' => 'This is the administrator role',
                'status' => 'Active',
                'app_detail_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
            ],
            [
                'role_name' => 'Tutor',
                'description' => 'This is the tutor role',
                'status' => 'Active',
                'app_detail_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
            ],
            [
                'role_name' => 'Staff',
                'description' => 'This is the Staff role',
                'status' => 'Active',
                'app_detail_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
            ],
            [
                'role_name' => 'Family',
                'description' => 'This is the family member role',
                'status' => 'Active',
                'app_detail_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
            ],
            [
                'role_name' => 'Student',
                'description' => 'This is the student member role',
                'status' => 'Active',
                'app_detail_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
            ],
        ];
        DB::table('roles')->insert($data);
    }
}
