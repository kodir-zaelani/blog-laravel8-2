@extends('admin.templates.default')
@section('title', 'Edit a Album') 
@section('subtitle', ' Album') 
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
                    <li class="breadcrumb-item"><a href="{{ route('admin.albums.index') }}">@yield('subtitle')</a>
                    </li>
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <form id="post-form" enctype="multipart/form-data" action="{{ route('admin.albums.update', $album) }}"  method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create a Album</h3>
                        </div>
                        
                        <div class="card-body">
                            
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group text-center">
                                            <label for="image">Cover Album </label><br/>
                                            <div class="fileinput fileinput-new " data-provides="fileinput">
                                                <div class="fileinput-new img-thumbnail" style="width: 200px;">
                                                        <img src="{{ ($album->imageThumbUrl) ? $album->imageThumbUrl : '/assets/admin/dist/img/no_image.png' }}"  alt="...">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px;"></div>
                                                <div>
                                                    <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                                    <input type="file" class="@error('image') is-invalid @enderror" name="image" value="{{ old('image') }}"></span>
                                                    <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </div>
                                                
                                                @error('image')
                                                <div class="invalid-feedback" style="display: block">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="title">Title <font style="color: red">*</font></label>
                                                <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{ old('title') ?? $album->title }}">
                                                @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description <font style="color: red">*</font></label>
                                                <textarea name="description" id="description" class="form-control my-editor @error('description') is-invalid @enderror" placeholder="Content" rows="10">{{ old('description') ?? $album->description}}</textarea>
                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div> 
                                        </div>
                                        
                                    </div>
                                       
                                </div>
                                
                                <div class="card-footer">
                                    <button id="publish-btn" type="submit" class="btn btn-success ">Update</button>
                                    <a href="{{ route('admin.albums.index') }}" class="btn btn-info float-right" >Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        
        
        
        @endsection
        
        @push('styles')
        
        <!-- Jasny Bootstrap 4 -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css') }}"> 
        <!-- Select2 -->
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
        @endpush
        @push('scripts')
        <!-- Jasny Bootstrap 4 -->
        <script src="{{ asset('assets/admin/plugins/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js') }}"></script>
        <!-- Select2 -->
        <script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>
        
        <!-- TinyMCE -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.0/tinymce.min.js" integrity="sha512-e6EdqJ92oqMqtStGx+mkt4+HrtuyC1Y3FFoq8fHgh6kwWoI1Jz62esALsobk27iRI9tv3U0KkUnCAfJgi6HpZw==" crossorigin="anonymous"></script>
    <script src="{{ url('') }}/vendor/laravel-filemanager/js/lfm.js"></script>   
        <script>
            $(function () {
                //Initialize Select2 Elements
                $('.select2').select2()
                
                //Initialize Select2 Elements
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })
                
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
                
                // Editor Tiny MCE
                var editor_config = {
                    path_absolute : "/",
                    selector: "textarea.my-editor",
                    plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                    relative_urls: false,
                    file_browser_callback : function(field_name, url, type, win) {
                        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
                        
                        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                        if (type == 'image') {
                            cmsURL = cmsURL + "&type=Images";
                        } else {
                            cmsURL = cmsURL + "&type=Files";
                        }
                        
                        tinyMCE.activeEditor.windowManager.open({
                            file : cmsURL,
                            title : 'Filemanager',
                            width : x * 0.8,
                            height : y * 0.8,
                            resizable : "yes",
                            close_previous : "no"
                        });
                    }
                };
                
                tinymce.init(editor_config);
                
            });
        </script>
    
        @endpush