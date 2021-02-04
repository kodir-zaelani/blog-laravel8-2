<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'title' => 'Laman Kreasi',
            'tagline' => 'Belajar menulis dan berkreasi',
            'description' => 'Melalui website ini semoga dapat menjadi sarana upaya peningkatan kompetensi',
            ]);
    }
}
