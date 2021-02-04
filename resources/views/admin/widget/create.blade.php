@extends('admin.templates.default')
@section('title', 'Create a Widget') 
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
        <form id="post-form" enctype="multipart/form-data" action="{{ route('admin.widgets.store') }}"  method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create  <small> a Widget</small></h3>
                            
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
                                <input id="title" name="title" type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{ old('title') }}">
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="fontawesome">Font Awesome  </label>
                                
                                <input id="fontawesome" name="fontawesome" type="text" class="form-control @error('fontawesome') is-invalid @enderror" placeholder="Font Awesome" value="{{ old('fontawesome') }}" required id="fontawesome">
                                <span class=""><a href="https://fontawesome.com/" target="_blank">show font awesome</a></span>
                                @error('fontawesome')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="source">Source </label>
                                <textarea name="source" id="source" class="form-control @error('source') is-invalid @enderror" placeholder="Source" rows="10">{{ old('source') }}</textarea>
                                @error('source')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="text-center form-group">
                                <div class=" fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new img-thumbnail" style="width: 200px;">
                                        <img src="{{ asset('/assets/admin/dist/img/no_image.png') }}"  alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px;"></div>
                                    <div>
                                        <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                        <input type="file" class="@error('image') is-invalid @enderror" name="image" value="{{ old('image') }}"></span>
                                        <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
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
                            <input type="text" name="status" id="status" hidden> 
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
                                        <option value="sidebar-right-top">Sidebar Rigt Top</option>
                                        <option value="sidebar-right-middle">Sidebar Rigt Middle</option>
                                        <option value="sidebar-right-bottom">Sidebar Rigt Bottom</option>
                                    </select>
                                    @error('position')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
@endpush
@push('scripts')
<!-- Jasny Bootstrap 4 -->
<script src="{{ asset('assets/admin/plugins/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"></script>

<!-- TinyMCE -->
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
        
        
    });
</script>

@endpush