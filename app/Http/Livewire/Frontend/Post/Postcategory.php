<?php

namespace App\Http\Livewire\Frontend\Post;

use Livewire\Component;
use App\Models\Categorypost;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class Postcategory extends Component
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

        $categorypost = Categorypost::where('slug', $this->segment)->first();

            $posts = $categorypost->post()
                    ->with('author', 'tags')
                    ->latest()
                    ->published()
                    ->paginate($this->perPage);
            
            return view('livewire.frontend.post.postcategory', compact('posts', 'categorypost'))
            ->extends('layouts.appfrontend')
            ->section('content');
    }
    
}
