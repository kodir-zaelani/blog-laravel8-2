<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

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
        'userStored',
        'userUpdated',
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

    public function userStored($user)
    {
        // dd($user);

        // Sweet alert
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'User ' . $user['name'] . ' was Stored',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right' // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
            ]);
    }

    public function userUpdated($user)
    {
        // Sweet alert
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'User ' . $user['name'] . ' was Updated',
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
            ]);
    }

    public function delete()
    {
        $user = User::destroy($this->selectedItem);

        // Sweet alert
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Deleted Success!',
            'timer'=>4000,
            'icon'=>'success',
            'text'=>'User  was deleted',
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
            ]);

        // This will hide the modal in the frontend
        $this->dispatchBrowserEvent('closeDeleteModal');
    } 
    
    public function render()
    {
        $users = $this->search === null ?
        User::orderBy('name', 'asc')
               ->paginate($this->paginate) :
        User::where('name', 'like', '%' .$this->search . '%')
               ->orderBy('name', 'asc')
               ->paginate($this->paginate);
               
        return view('livewire.admin.user.index', compact('users'));
    }
}
