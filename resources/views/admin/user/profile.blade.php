@extends('admin.templates.default')
@section('title', 'My Profile') 
@section('subtitle', 'My Profile') 
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
                    <li class="breadcrumb-item active">@yield('subtitle')</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
       @livewire('admin.user.userprofile')
    </div>
</section>         
@endsection

@push('styles')
 <!-- Sweet Alert 2 -->
 <link rel="stylesheet" href="{{ asset('assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endpush
@push('scripts')
 <!-- Sweet Alert 2 -->
<script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>



<script>
    //flash message
    @if(session()-> has('success'))

    swal.fire({
        icon: "success",
        title: "BERHASIL!",
        text: "{{ session('success') }}",
        // timer: 1500,
        showConfirmButton: true,
        showCancelButton: false,
    });
    @elseif(session()-> has('error'))
    swal.fire({
        icon: "error",
        title: "GAGAL!",
        text: "{{ session('error') }}",
        // timer: 1500,
        showConfirmButton: true,
        showCancelButton: false,
    });
    @endif
</script>

@endpush