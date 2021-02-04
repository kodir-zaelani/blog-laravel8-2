<?php

namespace App\Http\Livewire\Frontend\Main;

use App\Models\Announcement;
use Livewire\Component;

class Sidebarannouncement extends Component
{
    public function render()
    {
        $announcements = Announcement::orderBy('created_at', 'asc')->get();
        return view('livewire.frontend.main.sidebarannouncement', compact('announcements'));
    }
}
