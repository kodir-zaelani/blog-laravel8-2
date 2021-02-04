<?php

namespace App\Http\Livewire\Frontend\Categorypost;

use Livewire\Component;
use App\Models\Categorypost;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    //view pagination menggunakan bootstrap
    //karena livewire versi 2 menggunakan tailwind
    protected $paginationTheme = 'bootstrap';
    
    public $perPage = 5;
    public $search;
    public $page = 1;

    protected $queryString = [
        'page' => ['except' => 1],
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'categorypostAdded',
    ];

    public function categorypostAdded()
    {
        # code...
    }


    public function render()
    {
        $categoryposts = Categorypost::latest()->paginate($this->perPage);

        if ($this->search !== null) {
            $categoryposts = Categorypost::where('title', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate($this->perPage);
        }

        return view('livewire.frontend.categorypost.index', compact('categoryposts'))
        ->extends('frontend.templates.default')
        ->section('content');
    }
}
