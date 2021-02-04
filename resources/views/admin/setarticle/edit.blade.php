@extends('admin.templates.default')
@section('title', 'Edit a Setarticle') 
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
                    <li class="breadcrumb-item"><a href="{{ route('admin.setarticles.index') }}">@yield('title')</a>
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
                        <h3 class="card-title">Edit Set Article</h3>
                    </div>
                    <form action="{{ route('admin.setarticles.update', $setarticle->slug) }}" method="POST">
                    @csrf
                    @method('put')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" value="{{ old('title')?? $setarticle->title }}" class="form-control @error('title') is-invalid @enderror" placeholder="Enter a category title">
                            @error('title')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="text-center form-group">
                            <label for="image"> Feature Image </label><br/>
                            <div class="text-center fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="max-width: 190px;">
                                    {{-- <img src="{{ asset('/assets/admin/dist/img/no_image.png') }}"  alt="..."> --}}
                                    <img src="{{ ($setarticle->imageThumbUrl) ? $setarticle->imageThumbUrl : '/assets/admin/dist/img/no_image.png' }}"  alt="...">
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
                    <div class="card-footer">
                        <button class="btn btn-success">Update</button>
                        <button class="btn btn-primary" type="reset ">Reset</button>
                        <a href="{{ route('admin.setarticles.index') }}" class="btn btn-info" >Back</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
        
<!-- Jasny Bootstrap 4 -->
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css') }}"> 
@endpush
@push('scripts')
<!-- Jasny Bootstrap 4 -->
<script src="{{ asset('assets/admin/plugins/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js') }}"></script>
@endpush
@endsection