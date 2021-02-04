<?php

namespace App\Http\Livewire\Admin\Downloadfile;

use Livewire\Component;
use App\Models\Downloadfile;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    //view pagination menggunakan bootstrap
    //karena livewire versi 2 menggunakan tailwind
    protected $paginationTheme = 'bootstrap';
    
    public $currentPage = 1;
    public $paginate = 15;
    public $search = '';
    public $action;
    public $selectedItem;
    public $modalFormvisibe = false;

    protected $queryString = [
        // Keeping A Clean Query String https://laravel-livewire.com/docs/2.x/query-string#clean-query-string
        'search' => ['except' => ''],
        'currentPage' => ['except' => 1]
    ];

    protected $listeners = [
        'downloadfileStored',
        'downloadfileUpdated',
    ];

    public function mount()
    {
        // Keeping A Clean Query String https://laravel-livewire.com/docs/2.x/query-string#clean-query-string
        $this->fill(request()->only('search', 'currentPage'));
        $this->resetSearch();

        // $this->headersTable = $this->headerConfig();
    }

    public function resetSearch()
    {
        $this->search = '';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    } 
    
   
    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;
        
        if ($action == 'delete') {
            // This will show the modal in the frontend
            $this->dispatchBrowserEvent('openDeleteModal');
        } else {
            $this->emit('getModelId', $this->selectedItem);
            // This will show the openUpdateModal in the frontend
            $this->dispatchBrowserEvent('openEditModal');
        }
    }



    public function downloadfileStored($downloadfile)
    {
        // dd($downloadfile);

        // if($downloadfile) {
        //     session()->flash('success', 'Downloadfile "' . $downloadfile['name'] . '" was stored');
        // } else {
        //     session()->flash('error', 'Downloadfile failed to save');
        // }

        // Sweet alert
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Downloadfile ' . $downloadfile['title'] . ' was Stored',
            'toast'=>true, // Jika mau menggunakan toas
            'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
            ]);
    }

    public function downloadfileUpdated($downloadfile)
    {
        // dd($downloadfile);

        // Sweet alert
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Downloadfile ' . $downloadfile['title'] . ' was Updated',
            'toast'=>true, // Jika mau menggunakan toas
            'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
            ]);
    }
    
    public function delete()
    {
        $downloadfile = Downloadfile::destroy($this->selectedItem);

        // Sweet alert
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Deleted Success!',
            'timer'=>4000,
            'icon'=>'success',
            'text'=>'Downloadfile  was deleted',
            'toast'=>true, // Jika mau menggunakan toas
            'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
            ]);

        // This will hide the modal in the frontend
        $this->dispatchBrowserEvent('closeDeleteModal');
    } 

    public function render()
    {
        $downloadfiles = $this->search === null ?
        Downloadfile::orderBy('title', 'asc')
               ->paginate($this->paginate) :
        Downloadfile::where('title', 'like', '%' .$this->search . '%')
               ->orderBy('title', 'asc')
               ->paginate($this->paginate);

        return view('livewire.admin.downloadfile.index', compact('downloadfiles'));
    }
    
}
