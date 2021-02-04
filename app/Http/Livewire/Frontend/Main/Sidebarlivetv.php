<?php

namespace App\Http\Livewire\Frontend\Main;

use App\Models\Livetv;
use Livewire\Component;

class Sidebarlivetv extends Component
{
    public function render()
    {
        $livetvs = Livetv::orderBy('created_at', 'asc')
                    ->where('headline', 1)
                    ->take(5)
                    ->get();
        return view('livewire.frontend.main.sidebarlivetv', compact('livetvs'));
    }
}
