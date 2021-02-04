<?php

namespace App\Http\Livewire\Frontend\Post;

use App\Models\Tag;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class Posttags extends Component
{
    use WithPagination;
    //view pagination menggunakan bootstrap
    //karena livewire versi 2 menggunakan tailwind
    protected $paginationTheme = 'bootstrap';
    /**
     * public variable
     */
    public $segment;
    public $perPage  = 6;

    /**
     * mount or construct function
     */
    public function mount(Request $request)
    {
        $this->segment = $request->segment(3);
    }

    public function render()
    {

        $tag = Tag::where('slug', $this->segment)->first();
        $posts =$tag->posts() 
        // Post::where('tag_id', $tag->id)
                ->with('categorypost', 'author')
                ->latest()
                ->published()
                ->paginate($this->perPage);
           
            return view('livewire.frontend.post.posttags', compact('posts','tag'))
            ->extends('layouts.appfrontend')
            ->section('content');
    }
    
}
