<?php

namespace App\Http\Livewire\Frontend\Main;

use App\Models\Post;
use Livewire\Component;

class Sidebarpopular extends Component
{
    public function render()
    {
        $post_popular = Post::published()
                        ->with('author', 'tags', 'categorypost')
                        ->popular()
                        ->take(4)
                        ->get();
        $posts_latest = Post::published()
                        ->with('author', 'tags', 'categorypost')
                        ->latest()
                        ->take(4)
                        ->get();
        $posts_selection = Post::published()
                        ->with('author', 'tags', 'categorypost')
                        ->featured()
                        ->take(4)
                        ->get();

        return view('livewire.frontend.main.sidebarpopular', compact('post_popular', 'posts_latest','posts_selection'));
    }
}
