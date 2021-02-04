<?php

namespace App\Http\Livewire\Frontend\Main;

use Livewire\Component;
use Harimayco\Menu\Facades\Menu;

class Footermenu extends Component
{
    public function render()
    {
        $footer_menu = Menu::getByName('FooterMenu');
        return view('livewire.frontend.main.footermenu', compact('footer_menu'));
    }
}
