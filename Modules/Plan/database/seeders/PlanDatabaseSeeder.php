<?php

namespace Modules\Plan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PlanDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
    [
        'plan' => 'Free Trial',
        'description' => 'Free Plan',
        'currency_id' => 1,
        'price' => 0.00,
        'additional_criteria' => '{"additional_per_user_price":"0","add_more_users_limit":"0"}',
        'discount' => '',
        'features' => null,
        'billing_cycle' => 'Weekly',
        'status' => 'Active',
        'sort_order' => 1,
        'show' => 'No',
        'role_id' => 1,
        'created_by' => 1,
        'updated_by' => 1,
    ],
    [
        'plan' => 'Basic Plan',
        'description' => <<<DESC
Ideal for individual tutors looking to streamline scheduling and payments.
- Lesson scheduling & calendar management
- Secure online payments
- Student progress & attendance tracking
- Basic Integrations
- Prospect Management
DESC,
        'currency_id' => 1,
        'price' => 10,
        'additional_criteria' => '{"additional_per_user_price":"0","add_more_users_limit":"0"}',
        'discount' => '',
        'features' => '',
        'billing_cycle' => 'Monthly',
        'status' => 'Inactive',
        'sort_order' => 2,
        'show' => 'No',
        'role_id' => 2,
        'created_by' => 1,
        'updated_by' => 1,
    ],
    [
        'plan' => 'Startup Plan',
        'description' => <<<DESC
Designed for growing tutoring businesses with advanced automation and engagement tools.
- Everything in Basic Plan
- Team and Payroll Management
- Parents, Students & Team portal accounts
- Automated Communication (lesson reminders, bulk emails, etc.)
- Advanced Integrations
- Business Reports & Insights
- Priority Support
DESC,
        'currency_id' => 1,
        'price' => 50,
        'additional_criteria' => '{"additional_per_user_price":"5","add_more_users_limit":"100"}',
        'discount' => '',
        'features' => '',
        'billing_cycle' => 'Monthly',
        'status' => 'Active',
        'sort_order' => 3,
        'show' => 'No',
        'role_id' => 3,
        'created_by' => 1,
        'updated_by' => 1,
    ],
    [
        'plan' => 'Scaleup Plan',
        'description' => <<<DESC
Perfect for large tutoring centers needing scalability, integrations, and dedicated support.
- Everything in Startup Plan
- 24/7 Dedicated Support
- Enterprise-level Integrations
- Enterprise-level white label (custom domain, custom email server, etc.)
- Advanced Business Reports & Insights
DESC,
        'currency_id' => 1,
        'price' => 500.00,
        'additional_criteria' => '{"additional_per_user_price":"10","add_more_users_limit":"Unlimited"}',
        'discount' => '',
        'features' => '',
        'billing_cycle' => 'Monthly',
        'status' => 'Inactive',
        'sort_order' => 4,
        'show' => 'No',
        'role_id' => 1,
        'created_by' => 1,
        'updated_by' => 1,
    ],
];

        DB::table('plans')->insert($data);
    }
}
