<div>
    @section("title")Detail Download @endsection
    {{-- <div class="cta-header pt-5">
        <div class="container-fluid">
            <div class="row justify-content-center pt-5">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="cta-header-title text-center">
                        <h2 class="py-4 text-uppercase font-weight-bold">Detail Download</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    
    <div class="row pt-5">
        <div class="col-12">
            <iframe src="{{ url('uploads/downloadfiles', $downloadfile->file) }}" width="100%" height="600"></iframe>
            {{-- <iframe src="{{ url('') }}/downloadfiles/1611321194-02. Daftar Isi s.d. Daftar Lampiran.pdf" width="100%" height="600"></iframe> --}}
            {{-- <embed type="application/pdf" src="{{ url('') }}/downloadfiles/1611321194-02. Daftar Isi s.d. Daftar Lampiran.pdf" width="100%" height="600px"></embed> --}}
        </div>
    </div>
</div>
