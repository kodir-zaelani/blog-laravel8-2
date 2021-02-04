<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'title' => 'HTML',
            'slug' => 'html',
            'iclass' => 'primary'
        ]);
        Tag::create([
            'title' => 'CSS',
            'slug' => 'css',
            'iclass' => 'secondary'
        ]);
        Tag::create([
            'title' => 'Javascript',
            'slug' => 'javascript',
            'iclass' => 'success'
        ]);
        Tag::create([
            'title' => 'Bootstrap',
            'slug' => 'bootstrap',
            'iclass' => 'warning'
        ]);
        Tag::create([
            'title' => 'PHP',
            'slug' => 'php',
            'iclass' => 'info'
        ]);
        Tag::create([
            'title' => 'Laravel',
            'slug' => 'laravel',
            'iclass' => 'danger'
        ]);
        Tag::create([
            'title' => 'Livewire',
            'slug' => 'livewire',
            'iclass' => 'primary'
        ]);
        Tag::create([
            'title' => 'Edukasi',
            'slug' => 'edukasi',
            'iclass' => 'primary'
        ]);
    }
}
