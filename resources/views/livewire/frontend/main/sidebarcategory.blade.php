<div>
    <!-- Widgets-->
    @if (count($global_widget_sidebar_top))
        
    <div class="row">
        <div class="col-12">
            @foreach ($global_widget_sidebar_top as $item)
            <div class="card card-primary mb-3" >
                <div class="card-body">
                <h4 class="font-weight-bold">{{ $item->title }}</h4>
                <hr>
                <div class="row">
                    <div class="col text-center">
                        {!! $item->source !!}
                    </div>
                </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    <!-- Widgets-->
    <!-- Blog Category -->
    <div class="row">
        <div class="col-12">
            <div class="card card-primary mb-3" >
                <div class="card-body">
                    <h4 class="font-weight-bold"><i class="fab fa-stack-overflow"></i> KATEGORI</h4>
                    <hr>
                  <div class="list-group my-3">
                    @foreach ($categoryposts as $item)
                        @if ($item->post->count()>0)
                         <a href="{{ route('categorypost.show', $item->slug) }}" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded">
                        <span class="pull-left ">
                            @if ($item->ImageThumbUrl)
                            <img src="{{ $item->imageThumbUrl }}" 
                            style="width: 50px;height: 50px" 
                            class="img-fluid rounded-circle mr-2" />
                            @endif
                        </span> 
                            {{ $item->title }}
                            
                        </a>
                        @endif
                    @endforeach
                  </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Blog Category -->
    <!-- Widgets-->
    @if (count($global_widget_sidebar_right_middle))
        
    <div class="row">
        <div class="col-12">
            @foreach ($global_widget_sidebar_right_middle as $item)
            <div class="card card-primary mb-3" >
                <div class="card-body">
                <h4 class="font-weight-bold">{{ $item->title }}</h4>
                <hr>
                <div class="row">
                    <div class="col text-center">
                        {!! $item->source !!}
                    </div>
                </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    <!-- Widgets-->
</div>
