<?php

namespace Database\Seeders;

use App\Models\MenuFrontend;
use App\Models\MenuFrontendItem;
use Illuminate\Database\Seeder;

class MenuFrontendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuFrontend::create([
            'name' => 'TopMenu',
        ]);
        MenuFrontend::create([
            'name' => 'SideMenu',
        ]);
        MenuFrontend::create([
            'name' => 'FooterMenu',
        ]);
        MenuFrontend::create([
            'name' => 'LinkMenu',
        ]);

        // Menu Items
        MenuFrontendItem::create([
            'label' => 'Home',
            'link' => '/',
            'menu' => 1,
        ]);
        MenuFrontendItem::create([
            'label' => 'Artikel',
            'link' => '/post/postall',
            'menu' => 1,
        ]);
    }
}
