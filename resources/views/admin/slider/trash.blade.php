@extends('admin.templates.default')
@section('title', 'Slide') 
@section('subtitle', 'List Slide') 
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">@yield('title')</h1>
            </div>
            <div class="col-sm-6 ">
                <ol class="breadcrumb float-sm-right">
                    
                </ol>
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.slides.index') }}">@yield('title')</a>
                        </li>
                    <li class="breadcrumb-item active">@yield('subtitle')</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">List Slide in Trash</h3>
                    </div>
                    <div class="card-body ">
                        
                        <a href="{{ route('admin.slides.index') }}" class="btn btn-primary mb-4">List Active</a>
                        <table id="dataTableTrash" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="8">No</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Slug</th> 
                                    <th>Author</th> 
                                    <th>Status</th> 
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div> 
    </div>
</section>         
@endsection

@push('styles')
 <!-- DataTables -->
 <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
 <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
 <link rel="stylesheet" href="{{ asset('assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endpush
@push('scripts')
<!-- DataTables -->
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<script>
    $(function() {
        $('#dataTableTrash').DataTable({
            "processing": true,
            "serverside": true,
            "responsive": true,
            "autoWidth": true,
            ajax: '{{ route('admin.slides.trash') }}',
            columns: [
                {data: 'DT_RowIndex', orderable: false, searchable: false}, // Tambahkan index untuk nomor urut
                {data: 'title'},
                {data: 'image'},
                {data: 'slug'},
                {data: 'author'},
                {data: 'status'},
                {data: 'action'},
            ]
        })
    });

    $('#dataTableTrash').on('click', 'button#delete', function(e){
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
                    url: "/admin/slides/" + id,
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
</script>

<script>
    //flash message
    @if(session()-> has('success'))

    swal.fire({
        icon: "success",
        title: "BERHASIL!",
        text: "{{ session('success') }}",
        // timer: 1500,
        showConfirmButton: true,
        showCancelButton: false,
    });
    @elseif(session()-> has('error'))
    swal.fire({
        icon: "error",
        title: "GAGAL!",
        text: "{{ session('error') }}",
        // timer: 1500,
        showConfirmButton: true,
        showCancelButton: false,
    });
    @endif
</script>

@endpush