@extends('admin.templates.default')
@section('title', 'Tags') 
@section('subtitle', 'List Tags') 
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@yield('title')</h1>
            </div>
            <div class="col-sm-6 ">
                <ol class="breadcrumb float-sm-right">
                    
                </ol>
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.tags.index') }}">@yield('title')</a>
                        </li>
                    <li class="breadcrumb-item active">@yield('subtitle')</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        @livewire('admin.tag.index')
    </div>
</section>         
@endsection

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

    //flash message
    @if(session()-> has('success'))

    swal.fire({
        icon: "success",
        title: "SUCCESS!",
        text: "{{ session('success') }}",
        // timer: 1500,
        showConfirmButton: true,
        showCancelButton: false,
    });
    @elseif(session()-> has('error'))
    swal.fire({
        icon: "error",
        title: "FAILED!",
        text: "{{ session('error') }}",
        // timer: 1500,
        showConfirmButton: true,
        showCancelButton: false,
    });
    @endif
</script>

@endpush