<?php

namespace App\Http\Livewire\Frontend\Main;

use App\Models\Tag;
use Livewire\Component;

class Sidebartags extends Component
{
    public function render()
    {
        $tags = Tag::orderBy('title', 'asc')->get();

        return view('livewire.frontend.main.sidebartags', compact('tags'));
    }
}
