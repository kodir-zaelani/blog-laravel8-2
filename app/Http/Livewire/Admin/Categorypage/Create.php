<?php

namespace App\Http\Livewire\Admin\Categorypage;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Categorypage;

class Create extends Component
{
    public $title;

    protected $listeners = [
        'forcedCloseCreateModal'
    ];

    
    public function store()
    {
        $validateData = [
            'title' => 'required|min:3|unique:categorypages,title',
        ];

         // Default data
         $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
        ];

        $this->validate($validateData);

        $categorypage = Categorypage::create($data);

        // even listener -> emit
        $this->emit('categorypageStored', $categorypage);

        // $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        // This is to reset our public variables
        $this->cleanVars();
    }

    public function forcedCloseCreateModal()
    {
        // This is to reset our public variables
        $this->cleanVars();

        // These will reset our error bags
        $this->resetErrorBag();
        $this->resetValidation();
    }

    private function cleanVars()
    {
        // Kosongkan field input
        $this->title = null;
    }
    public function render()
    {
        return view('livewire.admin.categorypage.create');
    }
}
