<?php

namespace App\Http\Livewire\Frontend\Categorypost;

use Livewire\Component;

class Single extends Component
{
    public $categorypost;

    public function mount($categorypost)
    {
        $this->categorypost = $categorypost;
    }
    
    public function render()
    {
        return view('livewire.frontend.categorypost.single');
    }
}
