<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Laman Kreasi') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
    @livewireStyles

</head>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">
    
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
          <a href="/" class="navbar-brand">
           
            <img src="{{ asset('assets/help/img/logospansa.png') }}" alt="{{ config('app.name', 'Laman Kreasi') }}" class="brand-image elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name', 'Laman Kreasi') }}</span>
          </a>
          
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="/" class="nav-link">Home</a>
            </li>
           
           
              </ul>
            </li>
          </ul>
          <!-- Left navbar links -->
          <!-- Right navbar links -->
          <ul class="order-1 ml-auto order-md-3 navbar-nav navbar-no-expand">
            @if (Route::has('login'))
                 @auth
                    <li class="nav-item">
                        {{-- <a href="{{ url('/admin/dashboard') }}" class="nav-link" data-toggle="dropdown">Dashboard</a> --}}
                    </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">Register</a>
                            </li>
                        @endif
                @endauth
            @endif
          </ul>
      </nav>
      <!-- /.navbar -->


    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="mb-2 row">
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
   
        @yield('content')

    </div>

     <!-- Main Footer -->
     {{-- @include('admin.templates.partials.footer') --}}
</div>
    <!-- jQuery -->
    <script src="{{ asset('assets/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
    
    @livewireScripts
    
</body>
</html>