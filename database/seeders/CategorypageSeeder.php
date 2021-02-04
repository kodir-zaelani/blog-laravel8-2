<?php

namespace Database\Seeders;

use App\Models\Categorypage;
use Illuminate\Database\Seeder;

class CategorypageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categorypage::create([
            'title' => 'Abouts',
            'slug' => 'abouts',
        ]);
    }
}
