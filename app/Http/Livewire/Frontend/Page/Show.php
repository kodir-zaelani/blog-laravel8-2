<?php

namespace App\Http\Livewire\Frontend\Page;

use App\Models\Page;
use Livewire\Component;
use Illuminate\Http\Request;

class Show extends Component
{
    public $segment;

    public function mount(Request $request, Page $page)
    {
        $page->increment('view_count');

        $this->segment = $request->segment(2);
    }

    public function render()
    {
        $page = Page::where('slug', $this->segment)->first();
        return view('livewire.frontend.page.show', compact('page'))
        ->extends('layouts.appfrontend')
        ->section('content');
    }
}
