<?php

namespace Modules\Department\Database\Seeders;

use Illuminate\Database\Seeder;

class DepartmentDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'department' => 'Management',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
            ],
            [
                'department' => 'Teaching',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
                'deleted_by' => null,
            ],
        ];
         DB::table('departments')->insert($data);
    }
}
