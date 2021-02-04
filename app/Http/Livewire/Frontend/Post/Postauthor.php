<?php

namespace App\Http\Livewire\Frontend\Post;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class Postauthor extends Component
{
    use WithPagination;
    //view pagination menggunakan bootstrap
    //karena livewire versi 2 menggunakan tailwind
    protected $paginationTheme = 'bootstrap';
    /**
    * public variable
    */
    public $segment;
    public $author_name;
    // public $author;
    public $perPage  = 6;
    
    /**
    * mount or construct function
    */
    public function mount(Request $request)
    {
        $this->segment  = $request->segment(3);
    }
    
    public function render()
    {
        $author  = User::where('slug', $this->segment)->first();
            $posts    = $author->posts()
            // Post::where('author_id', $author->id)
            ->with('categorypost', 'tags')
            ->latest()
            ->published()
            ->paginate($this->perPage);
            return view('livewire.frontend.post.postauthor', compact('posts','author'))
            ->extends('layouts.appfrontend')
            ->section('content');
    }
   
}
