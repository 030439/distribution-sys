<?php

namespace Modules\Designation\Database\Seeders;

use Illuminate\Database\Seeder;

class DesignationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'department_id' => 1,
                'designation' => 'SuperAdmin',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
            ],
            [
                'department_id' => 2,
                'designation' => 'Admin',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
            ],
            [
                'department_id' => 2,
                'designation' => 'Tutor',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
            ],
        ];
        DB::table('designations')->insert($data);
    }
}
