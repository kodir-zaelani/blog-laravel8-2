<div>
    <!-- Blog Category -->
    <div class="row">
        <div class="col-12">
            <div class="card card-primary mb-3" >
                <div class="card-body">
                    <h4 class="font-weight-bold"><i class="fab fa-stack-overflow"></i> ARTIKEL TERKAIT</h4>
                    <hr>
                  <div class="list-group my-3">
                    @foreach ($categoryposts as $item)
                        @if ($item->post->count()>0)
                         <a href="{{ route('categorypost.show', $item->slug) }}" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded">
                        <span class="pull-left ">
                            <img src="{{ $item->imageThumbUrl }}" 
                            style="width: 50px;height: 50px" 
                            class="img-fluid rounded-circle mr-2" />
                        </span> 
                            {{ $item->title }}
                            <span class="badge bg-secondary float-end">
                                {{ $item->post->count() }}
                            </span>
                        </a>
                        @endif
                    @endforeach
                  </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Blog Category -->
</div>
