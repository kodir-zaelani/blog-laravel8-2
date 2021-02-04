<?php

namespace App\Http\Livewire\Frontend\Download;

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
    public $paginate = 5;
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
    
   
    public function render()
    {
        $downloadfiles = $this->search === null ?
        Downloadfile::orderBy('title', 'asc')
               ->paginate($this->paginate) :
        Downloadfile::where('title', 'like', '%' .$this->search . '%')
               ->orderBy('title', 'asc')
               ->paginate($this->paginate);

        return view('livewire.frontend.download.index', compact('downloadfiles'))
        ->extends('layouts.appfrontend')
        ->section('content');
    }
    
}
