<?php

namespace App\Http\Livewire\Frontend\Main;

use App\Models\Page;
use Livewire\Component;

class Sidebarpage extends Component
{
    public function render()
    {
        $pageprofile = Page::with('categorypage')
                ->where('categorypage_id', 1)
                ->orderBy('id', 'asc')->get();
        $pagesarpras = Page::with('categorypage')
                ->where('categorypage_id', 2)
                ->orderBy('id', 'asc')->get();

        return view('livewire.frontend.main.sidebarpage', compact('pageprofile', 'pagesarpras'));
    }
}
