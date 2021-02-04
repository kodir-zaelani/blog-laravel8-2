<?php

namespace App\Http\Livewire\Frontend\Download;

use App\Models\Downloadfile;
use Illuminate\Http\Request;
use Livewire\Component;

class Detail extends Component
{
    public  $downloadfile;

    public $segment;


    public function mount(Request $request)
    {
        $this->segment = $request->segment(3);

        // $downloadfile->increment('download_count');

        // $this->downloadfile = $downloadfile;
    }

    public function render()
    {
        $downloadfile = Downloadfile::where('slug', $this->segment)->first();


        return view('livewire.frontend.download.detail', compact('downloadfile'))
        ->extends('layouts.appfrontendfile')
        ->section('content');
    }
}
