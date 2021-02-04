<?php

namespace App\Http\Livewire\Admin\Role;

use Livewire\Component;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Edit extends Component
{
    public $name;
    public $role_id;
    public $model;
    public $modelId;
    public $permissions = [];
    public $permissionsr;

    protected $listeners = [
        'getModelId',
        'forcedCloseEditModal'
    ];

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;

        $model = Role::find($this->modelId);

        $this->role_id = $model->id;
        $this->name = $model->name;
        
    }

    public function update()
    {
        $validateData = [
            'name' => 'required|min:10|unique:permissions,name',
        ];
        
        // Default data
        $data = [
            'name' => Str::lower($this->name),
        ];

        $this->validate($validateData);

        $role = Role::find($this->modelId);
        
        $role->update($data);

        //assign permission to role
        $role->syncPermissions($this->permission);

        // even listener -> emit
        $this->emit('roleUpdated', $role);

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
        // $permissions = Permission::orderBy('name', 'asc')->get();
        $this->permissions = Permission::orderBy('name', 'asc')->latest()->get();
        // $this->roles = Role::latest()->get();
        return view('livewire.admin.role.edit');
    }
}
