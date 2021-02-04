<?php

namespace App\Http\Livewire\Frontend\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Postsall extends Component
{

    use WithPagination;
    //view pagination menggunakan bootstrap
    //karena livewire versi 2 menggunakan tailwind
    protected $paginationTheme = 'bootstrap';
    
    public $statusShow = false;

    public $currentPage = 1;
    public $paginate = 6;
    public $search = '';

    protected $queryString = [
        // Keeping A Clean Query String https://laravel-livewire.com/docs/2.x/query-string#clean-query-string
        'search' => ['except' => ''],
        'currentPage' => ['except' => 1]
    ];

    public function mount()
    {
        // Keeping A Clean Query String https://laravel-livewire.com/docs/2.x/query-string#clean-query-string
        $this->fill(request()->only('search', 'currentPage'));
        $this->resetSearch();

    }

    public function resetSearch()
    {
        $this->search = '';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    } 

   

    public function render()
    {
        $posts = $this->search === null ?
        Post::with('author', 'tags', 'categorypost')
                ->latest()
                ->published()
                ->filter(request()->only(['term', 'year', 'month']))
                ->paginate($this->paginate) :
        Post::where('title', 'like', '%' .$this->search . '%')
               ->with('author', 'tags', 'categorypost')
               ->latest()
               ->published()
               ->filter(request()->only(['term', 'year', 'month']))
                ->paginate($this->paginate);

        return view('livewire.frontend.post.postsall', compact('posts'))
        ->extends('layouts.appfrontend')
        ->section('content');
    }
}
