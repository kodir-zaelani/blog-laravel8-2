<?php

namespace App\Http\Livewire\Frontend\Main;

use App\Models\Photo;
use Livewire\Component;

class Sidebarphoto extends Component
{
    public function render()
    {
        // Photos
        $photos = Photo::latest()->take(12)->get();
        return view('livewire.frontend.main.sidebarphoto', compact('photos'));
    }
}
