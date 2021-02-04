<?php

namespace App\Http\Livewire\Frontend\Post;

use App\Models\Post;
use Livewire\Component;

class Show extends Component
{
    public  $post;

    public function mount(Post $post)
    {
        $post->increment('view_count');

        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.frontend.post.show')
        ->extends('layouts.appfrontend')
        ->section('content');
    }
}
