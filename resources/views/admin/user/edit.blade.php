@extends('admin.templates.default')
@section("title")Users @endsection
@section("subtitle")Edit  @endsection

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
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">@yield('title')</a>
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
                        <h3 class="card-title"><i class="fas fa-unlock"></i>  Edit <i class="fas fa-user-alt-slash "></i></h3>
                    </div>
                    <div class="card-body">               
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>NAMA</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Masukkan Nama "
                                class="form-control @error('title') is-invalid @enderror">
                                
                                @error('name')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>EMAIL</label>
                                <input type="text" name="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan Nama "
                                class="form-control @error('title') is-invalid @enderror">
                                
                                @error('email')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">ROLE</label>
                               
                                @foreach ($roles as $role)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="role[]" value="{{ $role->name }}"
                                            id="check-{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="check-{{ $role->id }}">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label>PASSWORD</label>
                                <input type="password" name="password" placeholder="Masukkan Password"
                                class="form-control @error('title') is-invalid @enderror">
                                
                                @error('password')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>PASSWORD CONFIRMATION</label>
                                <input type="password" name="password_confirmation"
                                        value="{{ old('password_confirmation') }}"
                                        placeholder="Masukkan Konfirmasi Password" class="form-control">
                            </div>
                            
                           
                            
                            <button class="mr-1 btn btn-primary btn-submit btn-sm" type="submit"><i class="fa fa-paper-plane"></i>
                                UPDATE</button>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-info btn-sm" >BACK</a>
                                <button class="btn btn-warning btn-reset btn-sm" type="reset"><i class="fa fa-redo"></i> RESET</button>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </section> 
    @stop