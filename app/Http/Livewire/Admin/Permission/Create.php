<?php

namespace App\Http\Livewire\Admin\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Create extends Component
{
    public $name;

    protected $listeners = [
        'forcedCloseCreateModal'
    ];

    
    public function store()
    {
        $validateData = [
            'name' => 'required|min:5|unique:permissions,name',
        ];

         // Default data
         $data = [
            'name' => $this->name,
        ];

        $this->validate($validateData);

        $permission = Permission::create($data);

        // even listener -> emit
        $this->emit('permissionStored', $permission);

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
        return view('livewire.admin.permission.create');
    }
}
