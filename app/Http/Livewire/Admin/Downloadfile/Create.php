<?php

namespace App\Http\Livewire\Admin\Downloadfile;

use App\Models\Downloadfile;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $title;
    public $file;
    public $linkfile;
    public $filesize;
    
    protected $listeners = [
        'forcedCloseCreateModal'
    ];

    
    public function store()
    {
        $validateData = [
            'title' => 'required|min:5|unique:downloadfiles,title',
        ];

         // Default data
         $data = [
            'title' => $this->title,
        ];

        // Validate file
        if (!empty($this->file)) {
            // Append to the validation if file is not empty
            $validateData = array_merge($validateData, [
                'file' => 'mimes:pdf,xlx,xlsx,doc,docx,ppt,pptx,wps,dps,et'
            ]);
        }

        if (!empty($this->file)) {
            $fileName = $this->file->hashName();

            // This is to save the file of the file in the database
            $data = array_merge($data, [
                'file' => $fileName
            ]);

            // Upload the main file
            $this->file->store('downloadfiles/');

        }

         // Validate file
         if (!empty($this->linkfile)) {
            // Append to the validation if linkfile is not empty
            $data = array_merge($data, [
                'linkfile' => $this->linkfile
            ]);
        } 
        $this->validate($validateData);

        $downloadfile = Downloadfile::create($data);

        // even listener -> emit
        $this->emit('downloadfileStored', $downloadfile);

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
        $this->title = null;
        $this->filename = null;
    } 
    public function render()
    {
        return view('livewire.admin.downloadfile.create');
    }
}
