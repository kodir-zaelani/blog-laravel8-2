@extends('admin.templates.default')
@section('title', 'Edit a Widget') 
@section('subtitle', ' Widget') 
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
                    <li class="breadcrumb-item"><a href="{{ route('admin.widgets.index') }}">@yield('subtitle')</a>
                    </li>
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <form id="post-form" enctype="multipart/form-data" action="{{ route('admin.widgets.update', $widget) }}"  method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit  <small> a Widget</small></h3>
                            
                            <div class="card-tools">
                                
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                                title="Remove">
                                <i class="fas fa-times"></i></button>
                            </div>
                            
                        </div>
                        
                        
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title <font style="color: red">*</font></label>
                                <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{ old('title') ?? $widget->title  }}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="fontawesome">Font Awesome </label>
                                <input id="fontawesome" name="fontawesome" type="text" class="form-control @error('fontawesome') is-invalid @enderror" placeholder="Url" value="{{ old('fontawesome') ?? $widget->fontawesome  }}" required id="fontawesome-type-styled-input">
                                @error('fontawesome')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="source">Source </label>
                                <textarea name="source" id="source" class="form-control @error('source') is-invalid @enderror" placeholder="Source" rows="5">{{ old('source') ?? $widget->source }}</textarea>
                                @error('source')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Save</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                                title="Remove">
                                <i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="text-center card-body">
                            <div class="form-group">
                                <input type="text" name="status" id="status" hidden> 
                                <label for="status">
                                    Status : 
                                    @if ($widget->status == 1)
                                    <font style="color: rgb(18, 168, 13)">Publish</font>
                                    @else
                                    <font style="color: rgb(58, 40, 224)"> Draft</font>
                                    @endif
                                </label>
                            </div> 
                            <button id="draft-btn" type="submit" class="btn btn-primary">Draft</button>
                            <button id="publish-btn" type="submit" class="btn btn-success ">Publish</button>
                        </div>
                    </div>
                        
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Position <font style="color: red">*</font></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                    <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                                    title="Remove">
                                    <i class="fas fa-times"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group ">
                                    <select class="form-control select2bs4 @error('position') is-invalid @enderror" name="position" id="position" required>
                                        <option disabled="" selected="">Select Position</option>
                                            <option value="sidebar-right-top"  
                                            @if($widget->position == "sidebar-right-top")
                                                selected
                                            @endif
                                            >Sidebar Rigt Top</option>
                                            <option value="sidebar-right-middle"
                                            @if($widget->position == "sidebar-right-middle")
                                                selected
                                            @endif
                                            >Sidebar Rigt Middle</option>
                                            <option value="sidebar-right-bottom" 
                                            @if($widget->position == "sidebar-right-bottom")
                                                selected
                                            @endif
                                            >Sidebar Rigt Bottom</option>
                                        </select>
                                        @error('position')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                            </div>
                        </div>  
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ $widget->title }}</h3>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col text-center">
                                        {!! $widget->source !!}
                                    </div>
                                </div>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.0/skins/lightgray/content.inline.min.css" integrity="sha512-k8zpu91d1x2N1b4BAu7SfWoAYWPvi0m0lDCGCmhezsCpZjnJ5iqT90Z7dQo+xF8X8nAcT4HXOqjH8TwobVgmEA==" crossorigin="anonymous" />
@endpush

@push('scripts')
<!-- Jasny Bootstrap 4 -->
<script src="{{ asset('assets/admin/plugins/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>

<!-- TinyMCE -->
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
            $('#status').val(0);
            $('#post-form').submit();
        });
        
        //Save Publish        
        $('#publish-btn').click(function(e) {
            e.preventDefault();
            $('#status').val(1);
            $('#post-form').submit();
        });
        
        // TinyMCE
        var editor_config = {
            path_absolute : "/",
            selector: "textarea.my-editor",
            plugins: [
                        "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "table contextmenu directionality emoticons template textcolor paste fullpage textcolor"
                ],
                toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
                toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | inserttime preview | forecolor backcolor",
                toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
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