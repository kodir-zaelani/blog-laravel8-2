<?php

namespace App\Http\Livewire\Frontend\Main;

use Livewire\Component;
use Harimayco\Menu\Facades\Menu;

class Sidemenu extends Component
{
    public function render()
    {
        $side_menu = Menu::getByName('SideMenu');
        return view('livewire.frontend.main.sidemenu', compact('side_menu'));
    }
}
