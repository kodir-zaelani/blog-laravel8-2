@extends('admin.templates.default')
@section("title")Roles @endsection
@section("subtitle")Edit Role @endsection

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
                    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">@yield('title')</a>
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
                        <h3 class="card-title"><i class="fas fa-unlock"></i>  Edit Roles</h3>
                    </div>
                    <div class="card-body">               
                        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>NAMA ROLE</label>
                                <input type="text" name="name" value="{{ old('name', $role->name) }}" placeholder="Masukkan Nama Role"
                                class="form-control @error('title') is-invalid @enderror">
                                
                                @error('name')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label class="font-weight-bold">PERMISSIONS:</label><br/>
                                
                                @foreach ($permissions as $permission)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" 
                                    name="permissions[]" 
                                    value="{{ $permission->name }}" 
                                    id="check-{{ $permission->id }}" 
                                    @if($role->permissions->contains($permission)) checked @endif>
                                    <label class="form-check-label" for="check-{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            
                            <button class="mr-1 btn btn-primary btn-submit btn-sm" type="submit"><i class="fa fa-paper-plane"></i>
                                UPDATE</button>
                                <a href="{{ route('admin.roles.index') }}" class="btn btn-info btn-sm" >BACK</a>
                                <button class="btn btn-warning btn-reset btn-sm" type="reset"><i class="fa fa-redo"></i> RESET</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </section> 
    @stop