<?php

namespace App\Http\Livewire\Frontend\Main;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.frontend.main.home')->extends('layouts.appfrontend');
    }
}
