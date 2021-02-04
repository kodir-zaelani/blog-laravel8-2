<?php

namespace App\Http\Livewire\Admin\Tag;

use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $title;
    public $iclass;

    protected $listeners = [
        'forcedCloseCreateModal'
    ];

    
    public function store()
    {
        $validateData = [
            'title' => 'required|min:3|unique:tags,title',
        ];

         // Default data
         $data = [
            'title' => $this->title,
            'iclass' => $this->iclass,
            'slug' => Str::slug($this->title),
        ];

        $this->validate($validateData);

        $tag = Tag::create($data);

        // even listener -> emit
        $this->emit('tagStored', $tag);

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
        $this->title = '';
        $this->iclass = '';
    }
    public function render()
    {
        return view('livewire.admin.tag.create');
    }
}
