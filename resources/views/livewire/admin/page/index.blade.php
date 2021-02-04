<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    {{-- <h3 class="card-title">List Category Post</h3> --}}
                    <a href="{{ route('admin.pages.create') }}" class="btn btn-sm btn-success">Add New</a>
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
                <div class="card-body ">
                      {{-- @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                        {{ session('success') }}
                    </div>
                    @endif --}}
                    <div class="mb-3 row">
                        <div class="col">
                            Show 
                            <select wire:model="paginate" name="" id="" class="w-auto form-control form-control-sm custom-select">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select> entries
                        </div>
                        {{-- <div class="col">
                            Sort Column: {{ $sortColumn }} | Sort Direction: {{ $sortDirection }}
                        </div> --}}
                        <div class="col">
                            <input 
                            wire:model="search" 
                            wire:keydown.escape="resetSearch"
                            wire:keydown.tab="resetSearch"
                            type="text" class="form-control " placeholder="Title Search...">
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-bordered table-hover" style="width=100%">
                                    <thead class="text-center">
                                    <th width="4%" scope="col">#</th>
                                    {{-- @foreach ($headersTable as $key => $value)
                                    <th scope="col" wire:click.prevent="sortBy('{{ $key }}')" style="cursor: pointer">
                                        @if ($sortColumn == $key)
                                        <span>{!! $sortDirection == 'asc' ? '&#8659':'&#8657' !!}</span>
                                        @endif
                                        {{ $value }}
                                    </th>
                                    @endforeach --}}
                                    <th scope="col">Title</th>
                                    <th scope="col" >Category</th>
                                    <th scope="col" >Author</th>
                                    <th scope="col" >Feature Image</th>
                                    <th scope="col" >Status</th>
                                    <th scope="col" width="10%">Action</th>
                                </thead>
                                <tbody>
                                    @if (count($pages)) 
                                    @foreach ($pages as $no => $item)
                                    <tr>
                                        <th class="text-right" scope="row">{{ $no + $pages->firstItem() }}</th>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->categorypage->title }}</td>
                                        <td>{{ $item->author->name }}</td>
                                        <td> @if (!empty($item->image))
                                            <img width="100px" src="{{ $item->imageThumbUrl }}" />
                                            @else
                                            No featured image available!
                                            @endif</td>
                                        <td>{!! $item->status_label !!}</td>
                                        <td class="text-center">
                                            <a title="Edit" class="btn btn-sm btn-warning edit-row" href="{{route('admin.pages.edit', $item->slug)}}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if($item->id == config('cms.default_categorypage_id'))
                                                <button onclick="return false" type="submit" class="btn btn-sm btn-danger disabled">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-danger btn-sm" type="submit" id="delete" data-id="{{ $item->slug }}" title="Move Trash"><i class="fas fa-trash-alt"></i></button>
                                            @endif 
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <h2 class="text-center" style="color: rgb(243, 60, 60)">Record not founds</h2>
                                    @endif
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3 row">
                        <div class="col">
                            {{ $pages->links() }}
                        </div>
                        <div class="text-right col">
                            Page : {{ $pages->currentPage() }} | Show {{ $pages->count() }} data of {{ $pages->total() }}
                        </div>
                    </div>
                    {{-- Modal Add New--}}
                    <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalFormLabel">New Post</h5>
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
                                    <h5 class="modal-title" id="modalEditFormLabel">Edit Post</h5>
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
    </div> 

</div>