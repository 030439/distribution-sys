<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $data = [
            [
                'user_name' => 'admin@saas.com',
                'password' => sha1(md5('info@1234')),
                'user_type' => 'company',
                'status' => 'Active',
                'app_id' => 1,
                'verified' => 1,
            ]
        ];
        DB::table('t17users')->insert($data);
    }
}
