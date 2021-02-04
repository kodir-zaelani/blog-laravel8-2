<?php

namespace App\Http\Livewire\Frontend\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;
    //view pagination menggunakan bootstrap
    //karena livewire versi 2 menggunakan tailwind
    protected $paginationTheme = 'bootstrap';

    public $perPage = 6;
    public $term;

    

    protected $queryString = ['term'];


    public function mount()
    {
        $this->term = request()->query('term', '');
    }


    public function render()
    {
        $searchterm = $this->term;
        $posts = Post::with('author', 'categorypost', 'tags')
                        ->latest()
                        ->published()
                        ->filter(request()->only(['term', 'year', 'month']))
                        ->paginate($this->perPage);
        return view('livewire.frontend.post.search', compact('posts', 'searchterm'))
        ->extends('layouts.appfrontend')
        ->section('content');
    }
}
