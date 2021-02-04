<?php

namespace App\Http\Livewire\Frontend\Main;

use App\Models\Categorypost;
use Livewire\Component;

class Sidebarcategory extends Component
{
    public function render()
    {
        $categoryposts = Categorypost::with(['post'=> function($query){
                        $query->published();
                        }])->orderBy('title', 'asc')->get();

        return view('livewire.frontend.main.sidebarcategory', compact('categoryposts'));
    }
}
