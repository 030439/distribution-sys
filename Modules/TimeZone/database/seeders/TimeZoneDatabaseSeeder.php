<?php

namespace Modules\TimeZone\Database\Seeders;

use Illuminate\Database\Seeder;

class TimeZoneDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $data =
        [
            [
                'zone_group' => "US & Canada",
                'timezone' => 'Pacific Time (PT)',
                'sdt' => 'UTC-08:00',
                'dst' => 'UTC-07:00',
                'php_timezone' => 'America/Los_Angeles',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'zone_group' => "US & Canada",
                'timezone' => 'Mountain Time (MT)',
                'sdt' => 'UTC-07:00',
                'dst' => 'UTC-06:00',
                'php_timezone' => 'America/Denver',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'zone_group' => "US & Canada",
                'timezone' => 'Central Time (CT)',
                'sdt' => 'UTC-06:00',
                'dst' => 'UTC-05:00',
                'php_timezone' => 'America/Chicago',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'zone_group' => "US & Canada",
                'timezone' => 'Eastern Time (ET)',
                'sdt' => 'UTC-05:00',
                'dst' => 'UTC-04:00',
                'php_timezone' => 'America/New_York',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'zone_group' => "US & Canada",
                'timezone' => 'Alaska Time (AKT)',
                'sdt' => 'UTC-09:00',
                'dst' => 'UTC-08:00',
                'php_timezone' => 'America/Anchorage',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'zone_group' => "US & Canada",
                'timezone' => 'Arizona Time (MT)',
                'sdt' => 'UTC-07:00',
                'dst' => 'UTC-07:00',
                'php_timezone' => 'America/Phoenix',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'zone_group' => "US & Canada",
                'timezone' => 'Newfoundland Time (NT)',
                'sdt' => 'UTC-03:30',
                'dst' => 'UTC-02:30',
                'php_timezone' => 'America/St_Johns',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'zone_group' => "US & Canada",
                'timezone' => 'Hawaii Time (HT)',
                'sdt' => 'UTC-10:00',
                'dst' => 'UTC-10:00',
                'php_timezone' => 'Pacific/Honolulu',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'zone_group' => "America",
                'timezone' => 'Buenos Aires Time (ART)',
                'sdt' => 'UTC-03:00',
                'dst' => 'UTC-03:00',
                'php_timezone' => 'America/Argentina/Buenos_Aires',
                'created_at' => date('Y-m-d H:i:s')
            ],
        ];
        DB::table('timezones')->insert($data);
    }
}
