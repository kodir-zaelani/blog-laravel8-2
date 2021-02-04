<div>
  
  <!-- Tags -->
  <div class="row mb-3">
    <div class="col-12">
      <div class="card card-primary " >
        <div class="card-body">
          <h4 class="font-weight-bold"><i class="fa fa-tags" aria-hidden="true"></i> TAGS</h4>
          <hr>
          <div class="tags">
            @foreach ($tags as $tag)
            <a href="{{ route('tag.show', $tag->slug) }}">
              <span class="badge bg-{{ $tag->iclass }}">{{ $tag->title }}</span>
            </a>
            @endforeach	
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Tags -->
  
</div> 

