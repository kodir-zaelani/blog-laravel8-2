<?php

namespace App\Http\Livewire\Admin\Role;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;
    //view pagination menggunakan bootstrap
    protected $paginationTheme = 'bootstrap';
    
    public $currentPage = 1;
    public $paginate = 10;
    public $search = '';
    public $action;
    public $selectedItem;

    protected $queryString = [
        // Keeping A Clean Query String https://laravel-livewire.com/docs/2.x/query-string#clean-query-string
        'search' => ['except' => ''],
        'currentPage' => ['except' => 1]
    ];

    protected $listeners = [
        'roleStored',
        'roleUpdated',
    ];

    public function mount()
    {
        // Keeping A Clean Query String https://laravel-livewire.com/docs/2.x/query-string#clean-query-string
        $this->fill(request()->only('search', 'currentPage'));
        $this->resetSearch();

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

    public function roleStored($role)
    {
        // dd($role);

        // Sweet alert
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Permission ' . $role['name'] . ' was Stored',
            'toast'=>true, // Jika mau menggunakan toas
            'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
            ]);
    }
    
    public function render()
    {
        $roles = $this->search === null ?
        Role::orderBy('created_at', 'asc')
               ->paginate($this->paginate) :
        Role::where('name', 'like', '%' .$this->search . '%')
               ->orderBy('created_at', 'asc')
               ->paginate($this->paginate);
                  
        return view('livewire.admin.role.index', compact('roles'));
    }
}
