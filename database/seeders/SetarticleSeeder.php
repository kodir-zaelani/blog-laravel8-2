<?php

namespace Database\Seeders;

use App\Models\Setarticle;
use Illuminate\Database\Seeder;

class SetarticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setarticle::create([
            'title' => 'Belajar HTML',
            'slug' => 'belajar-html',
            
        ]);
        Setarticle::create([
            'title' => 'Design Frontend ',
            'slug' => 'design-frontend',
            
        ]);
        Setarticle::create([
            'title' => 'CMS Blog',
            'slug' => 'cms-blog',
            
        ]);
        Setarticle::create([
            'title' => 'Bootstrap',
            'slug' => 'bootstrap',
            
        ]);
    }
}
