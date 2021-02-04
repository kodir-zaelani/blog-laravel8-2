<?php

namespace App\Http\Livewire\Frontend\Main;

use App\Models\Post;
use Livewire\Component;

class Sidebararchive extends Component
{
    public function render()
    {
        $postyear = Post::groupBy('year');
        return view('livewire.frontend.main.sidebararchive', compact('postyear'));
    }
}
