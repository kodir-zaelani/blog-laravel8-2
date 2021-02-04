<?php

namespace App\Http\Livewire\Frontend\Post;

use App\Models\Post;
use Livewire\Component;

class Headline extends Component
{
    public function render()
    {
        $headlines = Post::with('author', 'tags', 'categorypost')
        ->where('headline', 1)
        ->latest()
        ->published()
        ->filter(request()->only(['term', 'year', 'month']))
        ->take(4)
        ->get();
        return view('livewire.frontend.post.headline', compact('headlines'));
    }
}
