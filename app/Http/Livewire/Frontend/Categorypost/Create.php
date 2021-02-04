<?php

namespace App\Http\Livewire\Frontend\Categorypost;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Categorypost;

class Create extends Component
{
    public $title;

    public function addCategorypost()
    {
        $this->validate([
            'title' => 'required|min:3',
        ]);

       $categorypost = Categorypost::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title)
        ]);

        // triger emit to listeners
        $this->emit('categorypostAdded');

        $this->title="";

    }

    public function render()
    {
        return view('livewire.frontend.categorypost.create');
    }
}
