<?php

namespace App\Http\Livewire\Frontend\Main;

use Livewire\Component;
use Harimayco\Menu\Facades\Menu;

class Headeronline extends Component
{
    public $term;
    
    public function render()
    {
        $public_menu = Menu::getByName('TopMenu');
        return view('livewire.frontend.main.headeronline', compact('public_menu'));
    }
}
