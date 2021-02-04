 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('root') }}" class="nav-link" target="_blank">View Site</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    {{-- <form class="ml-3 form-inline">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}

    <!-- Right navbar links -->
    <ul class="ml-auto navbar-nav">
      <!-- Messages Dropdown Menu -->
      
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            @if (auth()->user()->photo)
                <img class="user-image img-circle elevation-2"
                src="{{ url('') }}/uploads/photos/users/photos_thumb/{{ auth()->user()->photo }}"
                alt="{{ auth()->user()->name }}">
            @else
                <img src="{{ url('') }}/assets/admin/dist/img/avatar.png" class="user-image img-circle elevation-2" alt="{{ auth()->user()->name }}">
            @endif
          <span class="d-none d-md-inline">{{ Auth::user()->name }} <i class="fas fa-angle-down"></i></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-primary">
            @if (auth()->user()->photo)
                <img class="img-circle elevation-2"
                src="{{ url('') }}/uploads/photos/users/photos_thumb/{{ auth()->user()->photo }}"
                alt="{{ auth()->user()->name }}">
            @else
                <img src="{{ url('') }}/assets/admin/dist/img/avatar.png" class="img-circle elevation-2" alt="{{ auth()->user()->name }}">
            @endif
            <p>
              {{ Auth::user()->name }}
              <small>Member since {{ Auth::user()->created_at->diffForHumans() }}</small>
            </p>
          </li>
          <!-- Menu Body -->
          {{-- <li class="user-body">
            <div class="row">
              <div class="text-center col-4">
                <a href="#">Followers</a>
              </div>
              <div class="text-center col-4">
                <a href="#">Sales</a>
              </div>
              <div class="text-center col-4">
                <a href="#">Friends</a>
              </div>
            </div>
            <!-- /.row -->
          </li> --}}
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="{{ route('admin.users.profile') }}" class="btn btn-default btn-flat">My Profile</a>
            <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();" class="float-right btn btn-default btn-flat">Sign out</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
          </li>
        </ul>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->