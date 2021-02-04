<?php

namespace App\Http\Livewire\Admin\Role;

use Livewire\Component;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Create extends Component
{
    public $name;
    public $permission = [];

    protected $listeners = [
        'forcedCloseCreateModal'
    ];

    
    public function store()
    {
        $validateData = [
            'name' => 'required|min:3|unique:roles,name',
        ];

         // Default data
         $data = [
            'name' => Str::lower($this->name),
        ];

        $this->validate($validateData);

        $role = Role::create($data);

        //assign permission to role
        $role->syncPermissions($this->permission);

        // even listener -> emit
        $this->emit('roleStored', $role);

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
        $this->name = null;
    }

    public function render()
    {
        $permissions = Permission::orderBy('name', 'asc')->get();
        return view('livewire.admin.role.create', compact('permissions'));
    }
}
