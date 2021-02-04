<?php

namespace App\Http\Livewire\Admin\Tag;

use App\Models\Tag;
use Livewire\Component;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $title;
    public $iclass;
    public $modelId;

    protected $listeners = [
        'getModelId',
        'forcedCloseEditModal'
    ];

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;

        $model = Tag::find($this->modelId);

        $this->title = $model->title;
        $this->iclass = $model->iclass;
        $this->slug = $model->slug;

    }

    public function update()
    {
        $validateData = [
            'title' => 'required|min:3',
        ];
        
        // Default data
        $data = [
            'title' => $this->title,
            'iclass' => $this->iclass,
            'slug' => Str::slug($this->title),
        ];

        $this->validate($validateData);

        $tag = Tag::find($this->modelId);
        
        $tag->update($data);

        // even listener -> emit
        $this->emit('tagUpdated', $tag);

        // This will hide the openUpdateModal in the frontend
        $this->dispatchBrowserEvent('closeEditModal');
        

         // This is to reset our public variables
         $this->cleanVars();

    }

    public function forcedCloseEditModal()
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
        return view('livewire.admin.tag.edit');
    }
}
