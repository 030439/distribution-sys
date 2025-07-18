<?php

namespace Modules\Currency\Database\Seeders;

use Illuminate\Database\Seeder;

class CurrencyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $data = [
            [
                'currency' => 'US Dollar',
                'code' => 'USD',
                'symbol' => '$',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Euro',
                'code' => 'EUR',
                'symbol' => '€',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'British Pound',
                'code' => 'GBP',
                'symbol' => '£',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Canadian Dollar',
                'code' => 'CAD',
                'symbol' => 'C$',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Australian Dollar',
                'code' => 'AUS',
                'symbol' => 'A$',
                'created_by' => 1,
                'updated_by' => 1,
            ],    
            [
                'currency' => 'Pakistani Rupee',
                'code' => 'PKR',
                'symbol' => 'Rs',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Indian Rupee',
                'code' => 'INR',
                'symbol' => '₹',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Japanese Yen',
                'code' => 'JPY',
                'symbol' => '¥',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Chinese Yuan',
                'code' => 'CNY',
                'symbol' => '¥',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Swiss Franc',
                'code' => 'CHF',
                'symbol' => 'Fr.',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Saudi Riyal',
                'code' => 'SAR',
                'symbol' => '﷼',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'UAE Dirham',
                'code' => 'AED',
                'symbol' => 'د.إ',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Russian Ruble',
                'code' => 'RUB',
                'symbol' => '₽',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Turkish Lira',
                'code' => 'TRY',
                'symbol' => '₺',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'South African Rand',
                'code' => 'ZAR',
                'symbol' => 'R',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Bangladeshi Taka',
                'code' => 'BDT',
                'symbol' => '৳',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Malaysian Ringgit',
                'code' => 'MYR',
                'symbol' => 'RM',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Singapore Dollar',
                'code' => 'SGD',
                'symbol' => 'S$',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'New Zealand Dollar',
                'code' => 'NZD',
                'symbol' => 'NZ$',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'South Korean Won',
                'code' => 'KRW',
                'symbol' => '₩',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Brazilian Real',
                'code' => 'BRL',
                'symbol' => 'R$',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Mexican Peso',
                'code' => 'MXN',
                'symbol' => '$',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Egyptian Pound',
                'code' => 'EGP',
                'symbol' => 'E£',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Thai Baht',
                'code' => 'THB',
                'symbol' => '฿',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Indonesian Rupiah',
                'code' => 'IDR',
                'symbol' => 'Rp',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Philippine Peso',
                'code' => 'PHP',
                'symbol' => '₱',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Kuwaiti Dinar',
                'code' => 'KWD',
                'symbol' => 'د.ك',
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'currency' => 'Qatari Riyal',
                'code' => 'QAR',
                'symbol' => '﷼',
                'created_by' => 1,
                'updated_by' => 1,
            ]
        ];
        DB::table('currencies')->insert($data);
    }
}
