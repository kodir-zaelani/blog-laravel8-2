@extends('admin.templates.default')
@section('title', 'Edit a Slider') 
@section('subtitle', ' Slider') 
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
                    <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">@yield('subtitle')</a>
                    </li>
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <form id="post-form" enctype="multipart/form-data" action="{{ route('admin.sliders.update', $slider) }}"  method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create a Slider</h3>
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="text-center form-group">
                                        <label for="image">Current Slider Image </label><br/>
                                        <img src="{{ ($slider->imageUrl) ? $slider->imageUrl : '/assets/admin/dist/img/no_image.png' }}"  alt="..." class="img-thumbnail" style="max-width: 60%;">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row justify-content-center">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="text-center form-group">
                                        <label for="image">Slider Image </label><br/>
                                        <div class="fileinput fileinput-new " data-provides="fileinput">
                                            <div class="fileinput-new img-thumbnail" style="width: 200px;">
                                                <img src="{{ asset('/assets/admin/dist/img/no_image.png') }}"  alt="no_image">
                                                {{-- <img src="{{ ($slider->imageThumbUrl) ? $slider->imageThumbUrl : '/assets/admin/dist/img/no_image.png' }}"> --}}
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
                            
                            <div class="form-group">
                                <input type="text" name="status" id="status" hidden> 
                                <label for="status">
                                    Status : 
                                    @if ($slider->status == 1)
                                    <font style="color: rgb(18, 168, 13)">Publish</font>
                                    @else
                                    <font style="color: rgb(58, 40, 224)"> Draft</font>
                                    @endif
                                    
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="title">Title </label>
                                <input id="title" name="title" value="{{ old('title') ?? $slider->title }}" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{ old('title') }}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            {{-- <div class="form-group">
                                <label for="show_attribute">
                                    Show Atribute : 
                                    
                                </label><br/>
                                <div class="form-check d-inline">
                                    <input {{$slider->show_attribute == 1 ? "checked" : ""}} value= 1 class="form-check-input" type="radio" id="show_attribute" name="show_attribute">
                                    <label for="show_attribute" class="form-check-label">Active</label>
                                </div>
                                <div class="form-check d-inline">
                                    <input {{$slider->show_attribute == 0 ? "checked" : ""}} value= 0 class="form-check-input" type="radio" id="show_attribute" name="show_attribute">
                                    <label for="show_attribute" class="form-check-label">Inactive</label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="short_title">Short Title </label>
                                <input id="short_title" name="short_title" value="{{ old('short_title')?? $slider->short_title }}" type="text" class="form-control @error('short_title') is-invalid @enderror" placeholder="Short Title" value="{{ old('short_title') }}">
                                @error('short_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="link">Link </label>
                                <input id="link" name="link" value="{{ old('link')?? $slider->link }}" type="text" class="form-control @error('link') is-invalid @enderror" placeholder="Link" value="{{ old('link') }}">
                                @error('link')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="video">Video </label>
                                <input id="video" name="video" value="{{ old('video')?? $slider->video }}" type="text" class="form-control @error('video') is-invalid @enderror" placeholder="Link Video" value="{{ old('video') }}">
                                @error('video')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="excerpt">Excerpt </label>
                                <textarea name="excerpt" id="excerpt" class="form-control my-editor @error('excerpt') is-invalid @enderror" placeholder="Excerpt" >{{ old('excerpt') ?? $slider->excerpt }}</textarea>
                                @error('excerpt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div> 
                            <div class="form-group">
                                {!! $slider->excerpt  !!}
                            </div>
                            <div class="form-group">
                                <input type="text" name="status" id="status" hidden> 
                                <label for="status">
                                    Status : 
                                    @if ($slider->status == 1)
                                    <font style="color: rgb(18, 168, 13)">Publish</font>
                                    @else
                                    <font style="color: rgb(58, 40, 224)"> Draft</font>
                                    @endif
                                    
                                </label>
                            </div> --}}
                        </div>
                        
                        <div class="card-footer">
                            <input type="text" name="show_attribute" id="show_attribute" hidden> 
                            <button id="draft-btn"  class="btn btn-primary">Draft</button>
                            <button id="publish-btn" class="btn btn-success ">Publish</button>
                            <a href="{{ route('admin.sliders.index') }}" class="float-right btn btn-info" >Back</a>
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
{{-- <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.0/tinymce.min.js" integrity="sha512-e6EdqJ92oqMqtStGx+mkt4+HrtuyC1Y3FFoq8fHgh6kwWoI1Jz62esALsobk27iRI9tv3U0KkUnCAfJgi6HpZw==" crossorigin="anonymous"></script>


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
            $('#show_attribute').val(0);
            $('#status').val(0);
            $('#post-form').submit();
            console.log('#status');
            console.log('#show_attribute');
        });
        
        //Save Publish        
        $('#publish-btn').click(function(e) {
            e.preventDefault();
            $('#show_attribute').val(0);
            $('#status').val(1);
            $('#post-form').submit();
            console.log('#status');
            console.log('#show_attribute');
        });
        
        // TinyMCE
    //     var editor_config = {
    //         path_absolute : "/",
    //         selector: "textarea.my-editor",
    //         plugins: [
    //         "advlist autolink lists link image charmap print preview hr anchor pagebreak",
    //         "searchreplace wordcount visualblocks visualchars code fullscreen",
    //         "insertdatetime media nonbreaking save table contextmenu directionality",
    //         "emoticons template paste textcolor colorpicker textpattern"
    //         ],
    //         toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    //         relative_urls: false,
    //         file_browser_callback : function(field_name, url, type, win) {
    //             var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
    //             var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
                
    //             var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
    //             if (type == 'image') {
    //                 cmsURL = cmsURL + "&type=Images";
    //             } else {
    //                 cmsURL = cmsURL + "&type=Files";
    //             }
                
    //             tinyMCE.activeEditor.windowManager.open({
    //                 file : cmsURL,
    //                 title : 'Filemanager',
    //                 width : x * 0.8,
    //                 height : y * 0.8,
    //                 resizable : "yes",
    //                 close_previous : "no"
    //             });
    //         }
    //     };
        
    //     tinymce.init(editor_config);
        
        
    });
</script>
@endpush