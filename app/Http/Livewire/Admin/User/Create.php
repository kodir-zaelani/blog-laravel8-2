<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class Create extends Component
{

    public $name;
    public $slug;
    public $email;
    public $role = [];
    public $image;
    public $password;
    public $password_confirmation;

    protected $listeners = [
        'forcedCloseModal'
    ];

    
    public function store()
    {
        $validateData = [
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email',
        ];

        $validateData = array_merge($validateData, [
            'password' => 'confirmed|min:8',
            'password_confirmation' => 'required'
        ]);

         // Default data
         $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ];

        $this->validate($validateData);

        $user = User::create($data);

        //assign permission to role
        $user->syncRoles($this->role);
        
        // even listener -> emit
        $this->emit('userStored', $user);
        $this->dispatchBrowserEvent('closeModal');
        // This is to reset our public variables
        $this->cleanVars();

    }

    public function forcedCloseModal()
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
        $roles = Role::orderBy('created_at', 'asc')->get();
        return view('livewire.admin.user.create', compact('roles'));
    }
}
