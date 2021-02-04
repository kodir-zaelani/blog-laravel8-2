<?php

namespace App\Http\Livewire\Admin\Categorypage;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Categorypage;

class Edit extends Component
{
    public $title;
    public $modelId;

    protected $listeners = [
        'getModelId',
        'forcedCloseEditModal'
    ];

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;

        $model = Categorypage::find($this->modelId);

        $this->title = $model->title;
    }

    public function update()
    {
        $validateData = [
            'title' => 'required|min:3',
        ];
        
        // Default data
        $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
        ];

        $this->validate($validateData);

        $categgorypage = Categorypage::find($this->modelId);
        
        $categgorypage->update($data);

        // even listener -> emit
        $this->emit('categorypageUpdated', $categgorypage);

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
        $this->title = null;
    }
    public function render()
    {
        return view('livewire.admin.categorypage.edit');
    }
}
