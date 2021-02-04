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
            ajax: '{{ route('admin.slides.data') }}',
            columns: [
                // {data: '<input type="checkbox" id="cb-child">', orderable: false, searchable: false}, // Tambahkan index untuk nomor urut
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