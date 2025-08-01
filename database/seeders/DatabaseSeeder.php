<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(\Modules\Menu\Database\Seeders\MenuDatabaseSeeder::class);
        $this->call(\Modules\Role\Database\Seeders\RoleDatabaseSeeder::class);
        $this->call(\Modules\Permission\Database\Seeders\PermissionDatabaseSeeder::class);
        $this->call(\Modules\Department\Database\Seeders\DepartmentDatabaseSeeder::class);
        $this->call(\Modules\Designation\Database\Seeders\DesignationDatabaseSeeder::class);
        $this->call(\Modules\Currency\Database\Seeders\CurrencyDatabaseSeeder::class);
        $this->call(\Modules\TimeZone\Database\Seeders\TimeZoneDatabaseSeeder::class);
        $this->call(\Modules\Plan\Database\Seeders\PlanDatabaseSeeder::class);
        $this->call(\Modules\Business\Database\Seeders\BusinessDatabaseSeeder::class);
        $this->call(\Modules\User\Database\Seeders\UserDatabaseSeeder::class);
        $this->call(\Modules\UserRole\Database\Seeders\UserRoleDatabaseSeeder::class);




        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
