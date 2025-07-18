<?php

namespace Modules\UserRole\Database\Seeders;

use Illuminate\Database\Seeder;

class UserRoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $data = [
            [
                'user_id' => 1,
                'role_id' => 1,
                'app_id' => 1,
            ],
            [
                'user_id' => 1,
                'role_id' => 2,
                'app_id' => 1,
            ],
            [
                'user_id' => 1,
                'role_id' => 3,
                'app_id' => 1,
            ],
        ];
        DB::table('userroles')->insert($data);
    }
}
