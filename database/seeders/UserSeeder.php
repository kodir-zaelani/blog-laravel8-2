<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        // $userCreate = User::create([
        //     'name'      => 'Super Admin',
        //     // 'slug'      => 'super-admin',
        //     'email'     => 'super@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('Super!123'),
        //     'remember_token' => Str::random(30),
        // ]);
        $userCreate = User::create([
            'name'      => 'Kodir Zaelani',
            'slug'      => 'kodir-zaelani',
            'email'     => 'kodir.zaelani78@gmail.com',
            'bio'     => 'Saya merupakan pemilik website www.lamankreasi.com dan mesih jauh dari kemampuan penguasaan teknologi, oleh karena itu maka dibuatlah website ini untuk peningkatan kemampuan secara personal.',
            'email_verified_at' => now(),
            'password' => bcrypt('secret12'),
            'remember_token' => Str::random(30),
        ]);

        //assign permission to role
        $role = Role::find(1);
        $permissions = Permission::all();

        $role->syncPermissions($permissions);

        //assign role with permission to user
        $user = User::find(1);
        $user->assignRole($role->name);
    }
}
