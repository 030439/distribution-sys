<?php
namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;


class BusinessDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        DB::table('t01appdetail')->insert([
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
                'app_id' => 1,
                'instagram' => 'www.instagram.com',
                'twitter' => 'www.twitter.com',
                'facebook' => 'www.facebook.com',
            ],
            // ...additional rows if needed
        ]);
    }
}
