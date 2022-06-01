<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            ['name' => 'view_users'],
            ['name' => 'edit_users'],
            ['name' => 'view_roles'],
            ['name' => 'edit_roles'],
            ['name' => 'view_payments'],
            ['name' => 'view_transactions'],
            ['name' => 'edit_transactions'],
            ['name' => 'view_categories'],
            ['name' => 'edit_categories'],
            ['name' => 'view_subcategories'],
            ['name' => 'edit_subcategories'],
            ['name' => 'view_reports'],
            // ['name' => 'edit_reports'],
        ]);
    }
}
