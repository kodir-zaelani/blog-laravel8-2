<?php

namespace Database\Seeders;

use App\Models\Categorypost;
use Illuminate\Database\Seeder;

class CategorypostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categorypost::create([
            'title' => 'Uncategory',
            'slug' => 'uncategory',
            'author_id'     => 1,
        ]);
        Categorypost::create([
            'title' => 'HTML',
            'slug' => 'html',
            'author_id'     => 1,
        ]);
        Categorypost::create([
            'title' => 'CSS',
            'slug' => 'css',
            'author_id'     => 1,
        ]);
        Categorypost::create([
            'title' => 'Bootstrap',
            'slug' => 'bootstrap',
            'author_id'     => 1,
        ]);
        Categorypost::create([
            'title' => 'Laravel',
            'slug' => 'laravel',
            'author_id'     => 1,
        ]);
    }
}
