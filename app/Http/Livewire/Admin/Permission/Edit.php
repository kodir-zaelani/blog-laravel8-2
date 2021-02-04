<?php

namespace App\Http\Livewire\Admin\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Edit extends Component
{
    public $name;
    public $modelId;

    protected $listeners = [
        'getModelId',
        'forcedCloseEditModal'
    ];

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;

        $model = Permission::find($this->modelId);

        $this->name = $model->name;
    }

    public function update()
    {
        $validateData = [
            'name' => 'required|min:10|unique:permissions,name',
        ];
        
        // Default data
        $data = [
            'name' => $this->name,
        ];

        $this->validate($validateData);

        $permission = Permission::find($this->modelId);
        
        $permission->update($data);

        // even listener -> emit
        $this->emit('permissionUpdated', $permission);

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
        $this->name = null;
    }

    public function render()
    {
        return view('livewire.admin.permission.edit');
    }
}
