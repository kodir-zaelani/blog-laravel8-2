<?php

namespace App\Http\Livewire\Admin\Advertisement;

use App\Models\Advertisement;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    //view pagination menggunakan bootstrap
    //karena livewire versi 2 menggunakan tailwind
    protected $paginationTheme = 'bootstrap';
    
    public $currentPage = 1;
    public $paginate = 10;
    public $search = '';

    public $sortDirection = 'desc';
    public $sortColumn = 'created_at';
    public $headersTable;


    private function headerConfig()
    {
        return [
            'title' => 'Title',
            'slug' => 'Slug',
            'author_id' => 'Author',
            'status' => 'Status',
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

    public function render()
    {
        $advertisements = $this->search === null ?
        Advertisement::orderBy($this->sortColumn, $this->sortDirection)
               ->paginate($this->paginate) :
        Advertisement::where('title', 'like', '%' .$this->search . '%')
               ->orderBy($this->sortColumn, $this->sortDirection)
               ->paginate($this->paginate);
               
        return view('livewire.admin.advertisement.index', compact('advertisements'));
    }
}
