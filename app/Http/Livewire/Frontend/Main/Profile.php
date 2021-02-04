<?php

namespace App\Http\Livewire\Frontend\Main;

use App\Models\Principle;
use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        $principle = Principle::where('status', 1)->get();

        return view('livewire.frontend.main.profile', compact('principle'));
    }
}
