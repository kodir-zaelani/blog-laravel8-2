<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalForm">
                        Add New
                    </button>
                    <div class="card-tools">
                        
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

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="table-responsive">
                                <table class="table table-bordered " style="width=100%">
                                <thead class="text-center">
                                    <th width="4%" scope="col">#</th>
                                    <th scope="col" >Name</th>
                                    <th scope="col" width="10%">Action</th>
                                </thead>
                                <tbody>
                                    {{-- @if (count($permissions))  --}}
                                    @foreach ($permissions as $no => $item)
                                    <tr>
                                        <th class="text-right" scope="row">{{ $no + $permissions->firstItem() }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-center">
                                            <button wire:click="selectItem({{ $item->id }}, 'edit')" class="btn btn-sm btn-warning" itle="Edit"><i class="fa fa-edit"></i></button>
                                            <button wire:click="selectItem({{ $item->id }}, 'delete')"  class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    {{-- @else
                                    <h2 class="text-center" style="color: rgb(243, 60, 60)">Record not founds</h2>
                                    @endif --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="mt-3 row">
                        <div class="col">
                            {{ $permissions->links() }}
                        </div>
                        <div class="float-right">
                            Page : {{ $permissions->currentPage() }} | Show {{ $permissions->count() }} data of {{ $permissions->total() }}
                        </div>
                    </div>
                    {{-- Modal Add New--}}
                    <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalFormLabel">New Permission</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @livewire('admin.permission.create')
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
                                    <h5 class="modal-title" id="modalEditFormLabel">Edit Permission</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    {{-- Selected Item {{ $selectedItem }} --}}
                                    @livewire('admin.permission.edit')
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
                                <div class="text-center modal-body">
                                    <svg width="5.0625em"  viewBox="0 0 17 16" class="bi bi-exclamation-triangle-fill" fill="red" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 5zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                      </svg>
                                    {{-- Selected Item {{ $selectedItem }} --}}
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
    @push('styles')
    <!-- sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
   @endpush
   @push('scripts')
   <!-- sweetalert2 -->
   <script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
   
   <script>
       //  Hide backdrop modal
       window.addEventListener('closeModal', event => {
                $("#modalForm").modal('hide');
        })
       
       //  Hide backdrop modal
       window.addEventListener('closeEditModal', event => {
                $("#modalEditForm").modal('hide');
        })
        
        //  Open Modal Save/Edit
        window.addEventListener('openEditModal', event => {
            $("#modalEditForm").modal('show');
        })
        
        //  Open modal delete
        window.addEventListener('openDeleteModal', event => {
            $("#modalFormDelete").modal('show');
        })
        
        //  Close modal delete
        window.addEventListener('closeDeleteModal', event => {
            $("#modalFormDelete").modal('hide');
        })
        
        // Opens the show photos modal
        window.addEventListener('openModalShowPhotos', event => {
            $("#modalShowPhotos").modal('show');
        })
        
        $(document).ready(function(){
            // This event js triger when the modal is hidden
            $("#modalForm").on('hidden.bs.modal', function(){
                // alert('The modal is now hidden.');
                livewire.emit('forcedCloseCreateModal');
            });
        });
        
        $(document).ready(function(){
            // This event js triger when the modal is hidden
            $("#modalEditForm").on('hidden.bs.modal', function(){
                // alert('The modal is now hidden.');
                livewire.emit('forcedCloseEditModal');
            });
        });

        // Sweet Alert
        window.addEventListener('swal',function(e){
            Swal.fire(e.detail);
        });

   </script>
   
   @endpush
</div>
