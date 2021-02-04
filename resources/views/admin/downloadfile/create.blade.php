@extends('admin.templates.default')
@section('title', 'Download') 
@section('subtitle', 'Create a Download') 
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
                    <li class="breadcrumb-item"><a href="{{ route('admin.downloadfiles.index') }}">@yield('title')</a>
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
            <div class="col-md-12 col-lg-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <form enctype="multipart/form-data" action="{{ route('admin.downloadfiles.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input 
                                        name="title"
                                        type="text"
                                        required
                                        value="{{ old('title') }}" 
                                        class="form-control @error('title') is-invalid @enderror" placeholder="Enter a contact title">
                                        @error('title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group ">
                                        <label for="title">Category Download</label>
                                        <select class="form-control select2bs4 @error('categorydownload_id') is-invalid @enderror" name="categorydownload_id" id="categorydownload_id">
                                            <option disabled="" selected="">Select Category</option>
                                            {{-- <option value="" holder>Select Category <option> --}}
                                                @foreach ($categorydownloads as $item)
                                                <option value="{{ $item->id}}">{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('categorydownload_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="file">
                                             File : 
                                        </label><br/>
                                        <div class="mr-2 form-check d-inline">
                                            <input class="form-check-input" type="radio" checked="checked" name="r1" onchange="show(this.value)" />
                                            <label for="file" class="form-check-label">Upload File</label>
                                        </div>
                                        <div class="form-check d-inline">
                                            <input class="form-check-input" type="radio" name="r1" id="e1" onchange="show2()" />
                                            <label for="file" class="form-check-label">Link Embed</label>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group" id="sh1">
                                        <label for="file">File Upload</label><br>
                                        <input id="file" name="file" type="file"   class=" @error('file') is-invalid @enderror" >
                                        @error('file')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group" id="sh2" style="display:none;">
                                        <label for="linkfile">Link File </label>
                                        <input id="linkfile" name="linkfile" type="linkfile"   class="form-control @error('linkfile') is-invalid @enderror" ><br>
                                        <span>example : https://drive.google.com/file/d/11aULn0IWM-X0GxhIjqBYa0GntnDDjYxO/view </span>
                                        {{-- <textarea name="linkfile" id="linkfile" class="form-control @error('linkfile') is-invalid @enderror"  rows="5" placeholder="Enter a contact link file">{{ old('linkfile') }}</textarea> --}}
                                        @error('linkfile')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-12"> 
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                
        </div>
    </section>
    @endsection
    
    @push('styles')
    <!-- Jasny Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css') }}"> 
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.0/skins/lightgray/content.inline.min.css" integrity="sha512-k8zpu91d1x2N1b4BAu7SfWoAYWPvi0m0lDCGCmhezsCpZjnJ5iqT90Z7dQo+xF8X8nAcT4HXOqjH8TwobVgmEA==" crossorigin="anonymous" />
    @endpush
    @push('scripts')
    <!-- Jasny Bootstrap 4 -->
    <script src="{{ asset('assets/admin/plugins/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>
    
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
            
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
            
            //Save Draft        
            $('#draft-btn').click(function(e) {
                e.preventDefault();
                $('#status').val(0);
                $('#post-form').submit();
            });
            //Save Publish        
            $('#publish-btn').click(function(e) {
                e.preventDefault();
                $('#status').val(1);
                $('#post-form').submit();
            });
            
        });
    </script>
    <script type="text/javascript">
        function show(str){
            document.getElementById('sh2').style.display = 'none';
            document.getElementById('file').required = true;
            document.getElementById('linkfile').required = false;
            document.getElementById('sh1').style.display = 'block';
        }
        function show2(sign){
            document.getElementById('sh2').style.display = 'block';
            document.getElementById('linkfile').required = true;
            document.getElementById('file').required = false;
            document.getElementById('sh1').style.display = 'none';
        }
    </script>
    @endpush
