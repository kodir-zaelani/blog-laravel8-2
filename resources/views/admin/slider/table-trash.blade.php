<table id="dataTable" class="table table-bordered table-hover">
    <thead>
        <tr>
            {{-- <th width="8"><input type="checkbox" id="cb-header"></th> --}}
            <th width="8">No</th>
            <th>Title</th>
            <th>Image</th>
            <th>Slug</th> 
            <th>Author</th> 
            <th>Aksi</th>
        </tr>
    </thead>
</table>

@push('styles')
 <!-- DataTables -->
 <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
 <link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

 <link rel="stylesheet" href="{{ asset('assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endpush
@push('scripts')
<!-- DataTables -->
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<!-- Select2 -->
<script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<script>
    //Initialize Select2 Elements
    $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

    $(function() {
        $('#dataTable').DataTable({
            "processing": true,
            "serverside": true,
            "responsive": true,
            "autoWidth": true,
            ajax: '{{ route('admin.slides.trash') }}',
            columns: [
                // {data: '<input type="checkbox" id="cb-child">', orderable: false, searchable: false}, // Tambahkan index untuk nomor urut
                {data: 'DT_RowIndex', orderable: false, searchable: false}, // Tambahkan index untuk nomor urut
                {data: 'title'},
                {data: 'image'},
                {data: 'slug'},
                {data: 'author'},
                {data: 'action'},
            ]
        })
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
     $(function() {

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
    });

</script>

@endpush