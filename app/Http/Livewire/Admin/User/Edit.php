<?php

namespace App\Http\Livewire\Admin\User;

use App\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public $user;
    public $name;
    public $slug;
    public $email;
    public $modelId;
    public $role = [];
    public $image;
    public $password;
    public $password_confirmation;

   
    
    protected $listeners = [
        'getModelId',
        'forcedCloseEditModal',
    ];

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;

        $user = User::find($this->modelId);

        $this->role_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role->id;

        
    }

    public function update()
    {
        $validateData = [
            'name' => 'required|min:2',
        ];
        
        // Default data
        $data = [
            'name' => Str::lower($this->name),
        ];

        $this->validate($validateData);

        $user = User::find($this->modelId);
        
        $user->update($data);

        //assign permission to user
        // $user->syncRoles($this->permission);
        $user->syncRoles($this->role);

        // even listener -> emit
        $this->emit('userUpdated', $user);

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
        $this->email = null;
        $this->password = null;
        $this->password_confirmation = null;
    }
    
    public function render()
    {
        $roles = Role::latest()->get();
        return view('livewire.admin.user.edit', compact('roles'));
    }
}
