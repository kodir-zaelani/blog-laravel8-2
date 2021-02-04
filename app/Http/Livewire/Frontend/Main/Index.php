<?php

namespace App\Http\Livewire\Frontend\Main;

use App\Models\Post;
use Livewire\Component;

class Index extends Component
{
    public $statusShow = false;

    public function getShowPost($slug)
    {
        $this->statusShow = true;

        $post = Post::find($slug);
        
        $this->emit('getShowPost', $post);
        # code...
    }
    public function render()
    {
        return view('livewire.frontend.main.index');
    }
}
