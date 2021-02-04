<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;


class Userprofile extends Component
{
    use WithFileUploads;
    public $userId;
    public $name;
    public $email;
    public $bio;
    public $password;
    public $photo;
    
    public $current_hashed_password;
    public $current_password_for_email;
    public $current_password_for_password;
    public $password_confirmation;

    public $prevName;
    public $prevEmail;
    public $prevBio;

    public function mount()
    {
        $this->userId = auth()->user()->id;
        $model = User::find($this->userId);
        $this->name = $model->name;
        $this->email = $model->email;
        $this->bio = $model->bio;

        $this->prevName = $model->name;
        $this->prevEmail = $model->email;
        $this->prevBio = $model->bio;
        $this->current_hashed_password = $model->password;
    }

    public function update()
    {
       // This is always the case
       $validateData = [
        'email' => 'email'
    ];

    // Just add validation if there are any changes in the fields
    if ($this->name !== $this->prevName) {
        if (empty($this->name)) {
            $validateData = array_merge($validateData, [
                'name' => 'required|min:2'
            ]);
        }
    }
    // Just add validation if there are any changes in the fields
    if ($this->bio !== $this->prevBio) {
        if (empty($this->bio)) {
            $validateData = array_merge($validateData, [
                'bio' => 'required|min:10'
            ]);
        }
    }

    if ($this->email !== $this->prevEmail) {
        if (empty($this->email)) {
            $validateData = array_merge($validateData, [
                'email' => 'required|email'
            ]);
        }

        $validateData = array_merge($validateData, [
            'current_password_for_email' => ['required', 'customPassCheckHashed:'.$this->current_hashed_password]
        ]);
    }

    if (!empty($this->password)) {
        $validateData = array_merge($validateData, [
            'current_password_for_password' => ['required', 'customPassCheckHashed:'.$this->current_hashed_password] ,
            'password' => 'confirmed|min:6',
            'password_confirmation' => 'required'
        ]);
    }

    // Validate photo
    if (!empty($this->photo)) {
        // Append to the validation if photo is not empty
        $validateData = array_merge($validateData, [
            'photo' => 'image|max:1024'
        ]);
    }

        // Just add validation if there are any changes in the fields
        $this->validate($validateData);

        $data = [];

        // We will check if there are any changes in the fields
        if ($this->name !== $this->prevName) {
            $data = array_merge($data, ['name' => $this->name]);
        }
        
        if ($this->bio !== $this->prevBio) {
            $data = array_merge($data, ['bio' => $this->bio]);
        }

        if ($this->email !== $this->prevEmail) {
            $data = array_merge($data, ['email' => $this->email]);
        }

        if (!empty($this->password)) {
            $data = array_merge($data, ['password' => Hash::make($this->password)]);
        }

        if (!empty($this->photo)) {
            $imageHashName = $this->photo->hashName();
    
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'photo' => $imageHashName
            ]);
            
            // Upload the main image
            $this->photo->store('photos/users/');
    
            // Create a thumbnail of the image using Intervention Image Library
            $manager = new ImageManager();
            $photo = $manager->make('uploads/photos/users/'.$imageHashName)->resize(120, 100); // Jangan lupa sesauikan nama folder dengan public folder image
            $photo->save(public_path('uploads/photos/users/photos_thumb/'.$imageHashName)); // Jangan lupa buat folder sesuai dengan rencana penyimpanan
            
        }

        if(count($data)) {
            User::find($this->userId)->update($data);
            session()->flash('success', 'Data updated successfully');
            return redirect()->to('/backend/users/profile');
        }
    }

    public function render()
    {
        return view('livewire.admin.user.userprofile')
        ->extends('admin.templates.default')
        ->section('content');
    }
}
