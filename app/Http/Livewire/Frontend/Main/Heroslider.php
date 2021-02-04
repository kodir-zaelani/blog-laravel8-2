<?php

namespace App\Http\Livewire\Frontend\Main;

use App\Models\Slider;
use Livewire\Component;

class Heroslider extends Component
{
    
    public function render()
    {
        $herosliders = Slider::where('status', 1)
        ->latest()
        ->take(4)
        ->get();
        // dd($heroslider);
        return view('livewire.frontend.main.heroslider', compact('herosliders'));
    }
}
