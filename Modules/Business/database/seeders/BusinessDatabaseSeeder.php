<?php
namespace Modules\Business\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        $data=[
            [
                'logo' => 'companyLogo.png',
                'first_name' => 'Kp',
                'last_name' => 'Chand',
                'phone' => '1234567890',
                'fax' => '0987654321',
                'email' => 'admin@mybq.com',
                'address' => '123 Main St',
                'business_name' => 'Hyper Banqut',
                'business_size' => 'Single Section',
                'time_zone_id' => 1,
                'status' => 'Active',
                'currency_id' => 1,
                // 'application_id' => 1,
                'instagram' => 'www.instagram.com',
                'twitter' => 'www.twitter.com',
                'facebook' => 'www.facebook.com',
            ],
        ];
        DB::table('busineses')->insert($data);
    }
}
