<?php

namespace App\Http\Livewire\Admin\Setarticle;

use Livewire\Component;
use App\Models\Setarticle;
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

    public $sortDirection = 'asc';
    public $sortColumn = 'title';
    public $headersTable;


    private function headerConfig()
    {
        return [
            'title' => 'Title',
            'slug' => 'Slug',
            'image' => 'Faeture Image',
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
        $setarticles = $this->search === null ?
        Setarticle::orderBy($this->sortColumn, $this->sortDirection)
               ->paginate($this->paginate) :
        Setarticle::where('title', 'like', '%' .$this->search . '%')
               ->orderBy($this->sortColumn, $this->sortDirection)
               ->paginate($this->paginate);
        return view('livewire.admin.setarticle.index', compact('setarticles'));
    }
}
