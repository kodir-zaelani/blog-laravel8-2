<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'superadmin']);
        Role::create(['name' => 'administitution']);
        Role::create(['name' => 'adminschool']);
        Role::create(['name' => 'operatorinstitution']);
        Role::create(['name' => 'operatorschool']);
        Role::create(['name' => 'userinstitution']);
        Role::create(['name' => 'userschool']);
        Role::create(['name' => 'author']);
        Role::create(['name' => 'editor']);
        Role::create(['name' => 'subscribe']);
        Role::create(['name' => 'general']);
    }
}
