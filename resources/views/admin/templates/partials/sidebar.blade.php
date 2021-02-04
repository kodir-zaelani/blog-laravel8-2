 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    {{-- @if ($global_settings->logo)
    <img src="{{ $global_settings->ImageUrl }}" 
    style="opacity: .8; max-width: 15%">
    @endif --}}
    <img src="{{ url('') }}/assets/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
    style="opacity: .8">
    <span class="brand-text font-weight-light">{{ config('app.name', 'Laman Kreasi') }}</span>
  </a>
  
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    {{-- <div class="pb-3 mt-3 mb-3 user-panel d-flex">
      <div class="image">
        @if (Auth::user()->photo )
        <img src="{{ Auth::user()->photo }}" class="img-circle elevation-2">
        @else
        <img src="{{ url('') }}/assets/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
        @endif
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
      </div>
    </div> --}}
    
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link {{ setActive('backend/dashboard')}}">
            <i class="fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        
        
         <li class="nav-item has-treeview {{ setOpen('backend/categoryposts'). setOpen('backend/subcategoryposts'). setOpen('backend/tags'). setOpen('backend/posts'). setOpen('backend/setarticles') }}">
          @if(auth()->user()->can('categoryposts.index') || auth()->user()->can('subcategoryposts.index') || auth()->user()->can('setarticles.index') || auth()->user()->can('tags.index') || auth()->user()->can('posts.index'))
          <a href="#" class="nav-link {{ setActive('backend/categoryposts'). setActive('backend/subcategoryposts'). setActive('backend/setarticles'). setActive('backend/tags'). setActive('backend/posts') }}">
            <i class="far fa-newspaper"></i>
            <p>
              Posts Management
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          @endif
          <ul class="nav nav-treeview">
            @can('posts.index')
            <li class="nav-item">
              <a href="{{ route('admin.posts.index') }}" class="nav-link {{ setActive('backend/posts') }}">
                <i class="fas fa-blog nav-icon"></i>
                <p>
                  Posts
                </p>
              </a>
            </li>
            @endcan
            @can('categoryposts.index')
            <li class="nav-item">
              <a href="{{ route('admin.categoryposts.index') }}" class="nav-link {{ setActive('backend/categoryposts') }}">
                <i class="fas fa-folder nav-icon"></i>
                <p>
                  Category
                </p>
              </a>
            </li>
            @endcan
            @can('subcategoryposts.index')
            <li class="nav-item">
              <a href="{{ route('admin.subcategoryposts.index') }}" class="nav-link {{ setActive('backend/subcategoryposts') }}">
                <i class="fas fa-folder nav-icon"></i>
                <p>
                  Sub Category
                </p>
              </a>
            </li>
            @endcan
            @can('tags.index')
            <li class="nav-item">
              <a href="{{ route('admin.tags.index') }}" class="nav-link {{  setActive('backend/tags') }}">
                <i class="fas fa-tags nav-icon"></i>
                <p>
                  Tags
                </p>
              </a>
            </li>
            @endcan
            @can('setarticles.index')
            <li class="nav-item">
              <a href="{{ route('admin.setarticles.index') }}" class="nav-link {{ setActive('backend/setarticles') }}">
                <i class="fas fa-blog nav-icon"></i>
                <p>
                  Set Article
                </p>
              </a>
            </li>
            @endcan
            
          </ul>
        </li>
        
        <li class="nav-item has-treeview {{ setOpen('backend/categorypages'). setOpen('backend/pages') }} ">
          @if(auth()->user()->can('categorypages.index') || auth()->user()->can('pages.index'))
          <a href="#" class="nav-link {{ setActive('backend/categorypages'). setActive('backend/pages') }}">
            <i class="fas fa-copy"></i>
            <p>
              Pages Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          @endif
          <ul class="nav nav-treeview">
            @can('categorypages.index')
            <li class="nav-item">
              <a href="{{ route('admin.categorypages.index') }}" class="nav-link {{  setActive('backend/categorypages') }}">
                <i class="fas fa-folder nav-icon"></i>
                <p>Category Pages</p>
              </a>
            </li>
            @endcan
            @can('pages.index')
            <li class="nav-item">
              <a href="{{ route('admin.pages.index') }}" class="nav-link {{ setActive('backend/pages') }}">
                <i class="fas fa-file nav-icon"></i>
                <p>Pages</p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
      
        
        
        <li class="nav-item has-treeview {{ setOpen('backend/categorydownloads'). setOpen('backend/downloadfiles') }} ">
          @if(auth()->user()->can('categorydownloads.index') || auth()->user()->can('downloadfiles.index'))
          <a href="#" class="nav-link {{ setActive('backend/categorydownloads'). setActive('backend/downloadfiles') }}">
            <i class="fas fa-copy"></i>
            <p>
              Download Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          @endif
          <ul class="nav nav-treeview">
            @can('categorydownloads.index')
            <li class="nav-item">
              <a href="{{ route('admin.categorydownloads.index') }}" class="nav-link {{  setActive('backend/categorydownloads') }}">
                <i class="fas fa-folder nav-icon"></i>
                <p>Category Download</p>
              </a>
            </li>
            @endcan
            @can('downloadfiles.index')
            <li class="nav-item">
              <a href="{{ route('admin.downloadfiles.index') }}" class="nav-link {{ setActive('backend/downloadfiles') }}">
                <i class="fas fa-file-download nav-icon"></i> 
                <p>
                  Download File
                </p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
       
        <li class="nav-item has-treeview {{setOpen('backend/sliders'). setOpen('backend/albums'). setOpen('backend/photos') }} ">
          @if(auth()->user()->can('photos.index') || auth()->user()->can('sliders.index') || auth()->user()->can('albums.index'))
          <a href="#" class="nav-link {{ setActive('backend/sliders'). setActive('backend/photos'). setActive('backend/albums') }}">
            <i class="fas fa-swatchbook"></i>
            <p>
              Galeries 
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          @endif
          <ul class="nav nav-treeview">
            @can('sliders.index')
            <li class="nav-item">
              <a href="{{ route('admin.sliders.index') }}" class="nav-link {{ setActive('backend/sliders')}}">
                <i class="fab fa-slideshare nav-icon"></i>
                <p>
                  Sliders
                </p>
              </a>
            </li>
            @endcan
            @can('albums.index')
            <li class="nav-item">
              <a href="{{ route('admin.albums.index') }}" class="nav-link {{ setActive('backend/albums')}}">
                <i class="fas fa-images nav-icon"></i>
                <p>
                  Albums Portfolio
                </p>
              </a>
            </li>
            @endcan
            @can('photos.index')
            <li class="nav-item">
              <a href="{{ route('admin.photos.index') }}" class="nav-link {{ setActive('backend/photos')}}">
                <i class="fas fa-images nav-icon"></i>
                <p>
                  Portfolio
                </p>
              </a>
            </li>
            @endcan
          </ul>
        </li>
       
        @can('advertisements.index')
        <li class="nav-item">
          <a href="{{ route('admin.advertisements.index') }}" class="nav-link {{ setActive('backend/advertisements') }}">
            <i class="fas fa-file-download"></i> 
            <p>
              Advertisement
            </p>
          </a>
        </li>
        @endcan
        <li class="nav-item has-treeview {{setOpen('backend/settings'). setOpen('backend/widgets'). setOpen('backend/socialmedia'). setOpen('backend/principles'). setOpen('backend/menus') }} ">
          @if(auth()->user()->can('settings.index') || auth()->user()->can('menus.index') || auth()->user()->can('widgets.index') || auth()->user()->can('socialmedia.index'))
          <a href="#" class="nav-link {{ setActive('backend/settings'). setActive('backend/menus'). setActive('backend/widgets'). setActive('backend/socialmedia') }}">
            <i class="fas fa-tools"></i>
            <p>
              Configuration
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          @endif
          <ul class="nav nav-treeview">
            @can('settings.index')
            <li class="nav-item ">
              <a href="{{ route('admin.settings.index') }}" class="nav-link {{ setActive('backend/settings') }}">
                <i class="fas fa-blog nav-icon"></i>
                <p>
                  Web Setting
                </p>
              </a>
            </li>
            @endcan
            @can('socialmedia.index')
            <li class="nav-item">
              <a href="{{ route('admin.socialmedia.index') }}" class="nav-link {{ setActive('backend/socialmedia')}}">
                <i class="far fa-thumbs-up nav-icon"></i>
                <p>
                  Social Media
                </p>
              </a>
            </li>
            @endcan
            @can('widgets.index')
            <li class="nav-item">
              <a href="{{ route('admin.widgets.index') }}" class="nav-link {{ setActive('backend/widgets')}}">
                <i class="far fa-thumbs-up nav-icon"></i>
                <p>
                  Widget
                </p>
              </a>
            </li>
            @endcan
            @can('menus.index')
            <li class="nav-item">
              <a href="{{ route('admin.menus.index') }}" class="nav-link {{ setActive('backend/menus') }}"><i class="fas fa-bars nav-icon"></i>
                <p>Menu Frontend</p>
              </a>
            </li>
            @endcan
          </ul>
        </li> 
       
        <li class="nav-item has-treeview {{ setOpen('backend/roles'). setOpen('backend/permissions'). setOpen('backend/users') }} ">
          @if(auth()->user()->can('roles.index') || auth()->user()->can('permissions.index') || auth()->user()->can('users.index'))
          <a href="#" class="nav-link {{ setActive('backend/roles'). setActive('backend/permissions'). setActive('backend/users') }}">
            <i class="fas fa-user-tag"></i>
            <p>
              Users Management
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          @endif
          <ul class="nav nav-treeview">
            @can('roles.index')
            <li class="nav-item">
              <a href="{{ route('admin.roles.index') }}" class="nav-link {{ setActive('backend/roles') }}">
                <i class="fas fa-shield-alt nav-icon"></i>
                <p>Roles</p>
              </a>
            </li>
            @endcan
            @can('permissions.index')
            <li class="nav-item">
              <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ setActive('backend/permissions') }}">
                <i class="fas fa-lock nav-icon"></i>
                <p>Permission</p>
              </a>
            </li>
            @endcan
            @can('users.index')
            <li class="nav-item">
              <a href="{{ route('admin.users.index') }}" class="nav-link {{ setActive('backend/users') }}">
                <i class="fas fa-users nav-icon"></i>
                <p>Users</p>
              </a>
            </li>
            @endcan
          </ul>
        </li> 
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>