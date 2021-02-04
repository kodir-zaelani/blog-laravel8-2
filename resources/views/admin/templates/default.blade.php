<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="crst-token" content="{{ csrf_token() }}">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  
  <title>@yield('title', 'Laman Kreasi')</title>
  @include('admin.templates.partials.styles')
  @trixassets
  @livewireStyles
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    @include('admin.templates.partials.navbar')
    @include('admin.templates.partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  @include('admin.templates.partials.footer')

</div>
<!-- ./wrapper -->

@include('admin.templates.partials.scripts')
@livewireScripts
</body>
</html>
