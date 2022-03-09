<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Setup Roles>>>

        $roles = ['superAdmin','admin','user'];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }

        // create Super Admin acount
        $superAdminRoleId = Role::where('name', 'superAdmin')->first()->id;
        $superAdmin = User::create([
            'firstName' => 'Super',
            'lastName' => 'Admin',
            'email' => 'abdo.salah2910@gmail.com',
            'phone' => '01112530548',
            'roleId' => $superAdminRoleId,
            'password' => Hash::make('12345678'),

        ]);
    }
}
