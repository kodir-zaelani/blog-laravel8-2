<?php

namespace App\Http\Livewire\Admin\Permission;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

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
        'permissionStored',
        'permissionUpdated',
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



    public function permissionStored($permission)
    {
        // dd($permission);

        // if($permission) {
        //     session()->flash('success', 'Permission "' . $permission['name'] . '" was stored');
        // } else {
        //     session()->flash('error', 'Permission failed to save');
        // }

        // Sweet alert
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Permission ' . $permission['name'] . ' was Stored',
            'toast'=>true, // Jika mau menggunakan toas
            'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
            ]);
    }

    public function permissionUpdated($permission)
    {
        // dd($permission);

        // Sweet alert
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Permission ' . $permission['name'] . ' was Updated',
            'toast'=>true, // Jika mau menggunakan toas
            'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
            ]);
    }
    
    public function delete()
    {
        $permission = Permission::destroy($this->selectedItem);

        // Sweet alert
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Deleted Success!',
            'timer'=>4000,
            'icon'=>'success',
            'text'=>'Permission  was deleted',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
            ]);

        // This will hide the modal in the frontend
        $this->dispatchBrowserEvent('closeDeleteModal');
    } 

    public function render()
    {
        $permissions = $this->search === null ?
        Permission::orderBy('name', 'asc')
               ->paginate($this->paginate) :
        Permission::where('name', 'like', '%' .$this->search . '%')
               ->orderBy('name', 'asc')
               ->paginate($this->paginate);

        return view('livewire.admin.permission.index', compact('permissions'));
    }
}
