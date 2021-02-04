<div>
  @if ($announcements->count())
  <div class="row">
    <div class="col-12">
      <!-- Announment -->
      <div class="card card-primary mb-3" >
        <div class="card-header" >
          <h4><i class="fas fa-bullhorn"></i> Pengumuman</h4>
        </div>
        <div class="card-body">
          <div class="list-group mb-4">
            @foreach ($announcements as $item)
            <a href="{{ route('announcement.show', $item->slug) }}" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded"> 
              <i class="fas fa-bullhorn"></i> {{ $item->title }}
            </a>
            @endforeach
          </div>
          {{-- <a href="" class="btn btn-primary mb-2 "><i class="fas fa-bullhorn"></i> Lainnya...</a> --}}
        </div>
      </div>
      <!-- Announment -->
    </div>
  </div>
  @endif
  
</div>
