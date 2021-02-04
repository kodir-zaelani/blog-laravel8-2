<?php

namespace App\Http\Livewire\Frontend\Main;

use Livewire\Component;
use Harimayco\Menu\Facades\Menu;

class Header extends Component
{
    public $term;
    
    protected $listeners = [
        'forcedClosesearchModal'
    ]; 

    public function forcedClosesearchModal()
    {
        // This is to reset our public variables
        $this->cleanVars();

        // These will reset our error bags
        $this->resetErrorBag();
        $this->resetValidation();
    }
    private function cleanVars()
    {
        // Kosongkan field input
        $this->term = null;

    }

    public function render()
    {
        $public_menu = Menu::getByName('TopMenu');
        return view('livewire.frontend.main.header', compact('public_menu'));
    }
}
