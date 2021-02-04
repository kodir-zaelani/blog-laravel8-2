<div>
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark nav-custom">
    <div class="container">
      <a class="navbar-brand" href="/">{!! $global_settings->title !!}</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto mb-2 mb-md-0">
        @if ($public_menu)
        @foreach ($public_menu as $menu)
        <li class="nav-item @if ($menu['child']) dropdown @endif">
          @if ($menu['child'])
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            {{ strtoupper($menu['label']) }}
            @else
            <li class="nav-item">
              <a href="{{ $menu['link'] }}" class="nav-link">
                {{ strtoupper($menu['label']) }}
                @endif
                
              </a>
              @if ($menu['child'])
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                @foreach( $menu['child'] as $child )
                <li>
                  <a href="{{ $child['link'] }}" class="dropdown-item">{{ strtoupper($child['label']) }}</a></li>
                  @endforeach
                </ul>
                @endif
              </li>
              @endforeach
              @endif
            </ul>
            <div class="d-flex">
              
              <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#searchModal">
                <i class="fa fa-search" style="color: white"></i>
              </button>
              {{-- <a href="#" data-toggle="modal" data-target="#register_online" class="btn btn-sm btn-success">Register Online</a> --}}
            </div>
          </div>
        </div>
      </nav>

      @push('modals')
        <!-- Modal -->
      <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Post Search </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form class="form" action="{{ route('post.search') }}">
                        <input type="text" id="term" value="{{ request('term') }}" class="form-control mb-3" required   name="term" placeholder="Search something for Posts ..." aria-label="Search">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                  
                </div>
                
            </div>
          </div>
      </div>
      {{-- modal search --}}  
      @endpush
</div>
    