<?php

namespace App\Http\Livewire\Admin\Categorypage;

use App\Models\Categorypage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    //view pagination menggunakan bootstrap
    //karena livewire versi 2 menggunakan tailwind
    protected $paginationTheme = 'bootstrap';
    
    public $currentPage = 1;
    public $paginate = 5;
    public $search = '';
    public $selectedItem;

    public $sortDirection = 'asc';
    public $sortColumn = 'created_at';
    public $headersTable;

    protected $listeners = [
        'categorypageStored',
        'categorypageUpdated',
    ];

    private function headerConfig()
    {
        return [
            'title' => 'Title',
            'slug' => 'Slug',
            'author_id' => 'Author',
            'created_at' => 'Created At',
        ];
    }

    public function sortBy($column)
    {
        $this->sortColumn = $column;

        $this->sortDirection = $this->reverseSort();
      
    }

    public function reverseSort()
    {
        return $this->sortDirection === 'asc'
            ? 'desc'
            : 'asc';
    }

    protected $queryString = [
        // Keeping A Clean Query String https://laravel-livewire.com/docs/2.x/query-string#clean-query-string
        'search' => ['except' => ''],
        'currentPage' => ['except' => 1]
    ];


    public function mount()
    {
        // Keeping A Clean Query String https://laravel-livewire.com/docs/2.x/query-string#clean-query-string
        $this->fill(request()->only('search', 'currentPage'));
        $this->resetSearch();

        $this->headersTable = $this->headerConfig();
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

    public function categorypageStored($categorypage)
    {
        // dd($categorypage);

        if($categorypage) {
            session()->flash('success', 'Categorypage "' . $categorypage['title'] . '" was stored');
        } else {
            session()->flash('error', 'Categorypage failed to save');
        }

        // Sweet alert
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Categorypage ' . $categorypage['title'] . ' was Stored',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
            ]);
    }

    public function categorypageUpdated($categorypage)
    {
        // dd($categorypage);
        if($categorypage) {
            session()->flash('success', 'Categorypage "' . $categorypage['title'] . '" was updated');
        } else {
            session()->flash('error', 'Categorypage failed to updated');
        }
        // Sweet alert
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Success!',
            'timer'=>5000,
            'icon'=>'success',
            'text'=>'Categorypage ' . $categorypage['title'] . ' was Updated',
            // 'toast'=>true, // Jika mau menggunakan toas
            // 'position'=>'top-right', // Jika mau menggunakan toas
            'showConfirmButton'=>true,
            'showCancelButton'=>false,
            ]);
    }
    
    public function delete()
    {
        $categorypage = Categorypage::destroy($this->selectedItem);

        // Sweet alert
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Deleted Success!',
            'timer'=>4000,
            'icon'=>'success',
            'text'=>'Categorypage  was deleted',
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
        $categorypages = $this->search === null ?
        Categorypage::orderBy($this->sortColumn, $this->sortDirection)
               ->paginate($this->paginate) :
        Categorypage::where('title', 'like', '%' .$this->search . '%')
               ->orderBy($this->sortColumn, $this->sortDirection)
               ->paginate($this->paginate);
               
        return view('livewire.admin.categorypage.index', compact('categorypages'));
    }
}
