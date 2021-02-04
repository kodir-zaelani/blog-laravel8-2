<?php

namespace App\Http\Livewire\Frontend\Post;

use App\Models\Post;
use Livewire\Component;
use App\Models\Categorypost;

class Categorypostindex extends Component
{
    public function render()
    {
        $posts = Post::orderBy('id', 'asc')
                ->with('categorypost', 'author', 'subcategorypost', 'setarticle')
                ->get();
        $categoryposts = Categorypost::orderBy('id', 'asc')
                        ->with('post', 'author')
                        ->get();

        return view('livewire.frontend.post.categorypostindex', compact('categoryposts', 'posts'));
    }
}
