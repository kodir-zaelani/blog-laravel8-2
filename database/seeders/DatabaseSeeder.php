<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(RoleSeeder::class);
        // $this->call(PermissionsSeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(MenuFrontendSeeder::class);
        // $this->call(CategorypageSeeder::class);
        // $this->call(CategorypostSeeder::class);
        $this->call(CategorylearningresourceSeeder::class);
        // $this->call(TagSeeder::class);
        // $this->call(SettingSeeder::class);
        // $this->call(SetarticleSeeder::class);
        // $this->call(SocialSeeder::class);
        // $this->call(EmployeSeeder::class);
        // $this->call(PostSeeder::class);
    }
}
