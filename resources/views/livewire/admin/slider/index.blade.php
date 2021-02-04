<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary table-responsive">
                <div class="card-header">
                    {{-- <h3 class="card-title">List Category Post</h3> --}}
                    <a href="{{ route('admin.sliders.create') }}" class="btn btn-sm btn-success">Add New</a>
                    <div class="card-tools">
                        {{-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalForm">
                            Add New
                        </button> --}}
                        
                        <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                    </div>
                </div>
                
                {{-- @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                    {{ session('success') }}
                </div>
                @endif --}}
                
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="mb-3 row">
                        <div class="col">
                            Show 
                            <select wire:model="paginate" name="" id="" class="w-auto form-control form-control-sm custom-select">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select> <span class="d-none d-sm-none d-md-inline-block d-lg-inline-block">entries</span>
                        </div>
                        {{-- <div class="col">
                            Sort Column: {{ $sortColumn }} | Sort Direction: {{ $sortDirection }}
                        </div> --}}
                        <div class="float-right">
                            <div class="input-group" style="width: 180px;">
                                <input type="text" wire:model="search" 
                                wire:keydown.escape="resetSearch"
                                wire:keydown.tab="resetSearch" class="form-control float-right" placeholder="Title Search...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered " style="width=100%">
                            <thead class="text-center">               
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th >Title</th>
                                    <th >Status</th>
                                    <th class="">Author</th>
                                    <th class="">Feature Image</th>
                                    <th class="">Created At</th>
                                    <th width="110px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($sliders)) 
                                @foreach ($sliders as $no => $item)
                                <tr>
                                    <th class="text-right" scope="row">{{ $no + $sliders->firstItem() }}</th>
                                    <td>{{ $item->title }}</td>
                                    <td>{!! $item->status_label !!}</td>
                                    {{-- <td>{{ $item->getStatusLabel }}</td> --}}
                                    <td class="">{{ $item->author->name }}</td>
                                    <td class=""> @if (!empty($item->image))
                                        <img width="100px" src="{{ $item->imageThumbUrl }}" />
                                        @else
                                        No featured image available!
                                        @endif</td>
                                        <td class="">{{ $item->created_at }}</td>
                                        <td class="text-center">
                                            <a title="Edit" class="btn btn-sm btn-warning edit-row " href="{{route('admin.sliders.edit', $item->slug)}}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm" type="submit" id="delete" data-id="{{ $item->slug }}" title="Move Trash"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <h2 class="text-center" style="color: rgb(243, 60, 60)">Record not founds</h2>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3 row">
                            <div class="col">
                                {{ $sliders->links() }}
                            </div>
                            <div class="float-right">
                                Page : {{ $sliders->currentPage() }} | Show {{ $sliders->count() }} data of {{ $sliders->total() }}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    
                </div>
                
                {{-- Modal Add New--}}
                <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalFormLabel">New Slider</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{-- @livewire('admin.postcategory.create') --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Modal Add New--}}
                {{-- Modal Update--}}
                <div class="modal fade" id="modalEditForm" tabindex="-1" aria-labelledby="modalEditFormLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEditFormLabel">Edit Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{-- @livewire('admin.postcategory.edit') --}}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Modal Update--}}
                
                {{-- Modal Delete--}}
                <div class="modal fade" id="modalFormDelete" tabindex="-1" aria-labelledby="modalFormDeleteLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalFormDeleteLabel">Delete Item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h3>Do you wish to continue?</h3>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button wire:click="delete" class="btn btn-primary">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Modal Delete--}}
            </div>
        </div> 
        
    </div>
    