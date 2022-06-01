<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(20)->create();

        User::create([
            'name' => 'mohamed alaa',
            'email' => 'mohamed@gmail.com',
            'password' => Hash::make('123456'),
            // 'password_confirm' => '123456',

        ]);
        $roles = Role::all();

        $users = User::all();
        foreach ($users as $user) {
            DB::table('user_roles')->insert([
                'user_id' => $user->id,
                'role_id' => $roles->random()->id
            ]);
        }
    }
}
