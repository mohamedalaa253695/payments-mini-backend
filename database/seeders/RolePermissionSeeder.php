<?php

namespace Database\Seeders;


use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();
        $admin = Role::whereName('Admin')->first();

        foreach ($permissions as $permission) {
            DB::table('role_permission')->insert([
                'role_id' => $admin->id,
                'permission_id' => $permission->id
            ]);
        }

        $customer = Role::whereName('customer')->first();

        foreach ($permissions as $permission) {
            if (!in_array($permission->name, ['view_transaction'])) {
                DB::table('role_permission')->insert([
                    'role_id' => $customer->id,
                    'permission_id' => $permission->id
                ]);
            }
        }
    }
}
