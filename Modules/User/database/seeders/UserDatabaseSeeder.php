<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $data = [
            [
                'user_name' => 'masteradmin@mytutorpod.com',
                'password' => sha1(md5('Mtp@1234')),
                'user_type' => 'company',
                'status' => 'Active',
                'app_detail_id' => 1,
                'verified' => 1,
            ]
        ];
        DB::table('users')->insert($data);
    }
}
