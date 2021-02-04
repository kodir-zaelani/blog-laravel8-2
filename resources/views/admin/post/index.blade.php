@extends('admin.templates.default')
@section('title', 'Post') 
@section('subtitle', 'List Post') 
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
                    <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">@yield('title')</a>
                        </li>
                    <li class="breadcrumb-item active">@yield('subtitle')</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
       @livewire('admin.post.index')
    </div>
</section>         
@endsection

@push('styles')
 <!-- Sweetalert -->
 <link rel="stylesheet" href="{{ asset('assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endpush
@push('scripts')
<!-- Sweetalert -->
<script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>


<script>
     //  Hide backdrop modal
     window.addEventListener('closeModal', event => {
           $("#modalForm").modal('hide');
       })
       
       //  Open Modal Save/Edit
       window.addEventListener('openEditModal', event => {
           $("#modalEditForm").modal('show');
       })

       //  Close Modal Save/Edit
       window.addEventListener('closeEditModal', event => {
           $("#modalEditForm").modal('hide');
       })
       
       //  Open modal delete
       window.addEventListener('openDeleteModal', event => {
           $("#modalFormDelete").modal('show');
       })
       
       //  Close modal delete
       window.addEventListener('closeDeleteModal', event => {
           $("#modalFormDelete").modal('hide');
       })
       
       $(document).ready(function(){
           // This event js triger when the modal is hidden
           $("#modalForm").on('hidden.bs.modal', function(){
               // alert('The modal is now hidden.');
               livewire.emit('forcedCloseModal');
           });
           $("#modalEditForm").on('hidden.bs.modal', function(){
               // alert('The modal is now hidden.');
               livewire.emit('forcedCloseEditModal');
           });
       });

   $('#dataTable').on('click', 'button#delete', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        console.log(id);
        Swal.fire({
            title: 'Kamu yakin hapus data ini?',
            text: "Data yang dihapus tidak bisa kembali!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oke, Hapus!',
            cancelButtonText: 'Batalkan'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'DELETE',
                    url: "/backend/posts/" + id,
                    data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        Swal.fire(
                            'Dihapus!',
                            'data berhasil dihapus.',
                            'success'
                            )

                            location.reload(true);
                    }
                })
                
            }
        });

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