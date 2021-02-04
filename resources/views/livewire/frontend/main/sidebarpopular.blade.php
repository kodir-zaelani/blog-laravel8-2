<div>
    <div class="row">
        <div class="col-12">
            <!-- Popular Post -->
            <div class="card mb-3">
                <div class="card-body">
                  <div class="single-sidebar post-tab">
                    <!-- Tab Nav -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#popular" role="tab">Populer</a></li>
                      <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#recent" role="tab">Terbaru</a></li>
                      <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#featured" role="tab">Pilihan</a></li>
                    </ul>
                    <!--/ End Tab Nav -->
                    <div class="tab-content" id="myTabContent">
                      <!-- Popular Posts -->
                      <div class="tab-pane fade show active" id="popular" role="tabpanel" >
                        <!-- Single Post -->
                        @foreach ($post_popular as $post)
                            <div class="single-post">
                                @if ($post->imageThumbUrl)
                                <div class="post-img">
                                    <a href="{{ route('post.show', $post) }}"><img src="{{ $post->imageThumburl }}" alt="{{ $post->title }}"></a>   
                                </div>
                                @else
                                <div class="post-img">
                                    <img src="{{ url('') }}/assets/help/img/edu5.jpeg" alt="post">
                                </div>
                                @endif
                                <div class="post-info">
                                    <h4><a href="{{ route('post.show', $post) }}">{{ $post->title }}</a></h4>
                                    <p><i class="fa fa-calendar"></i>{{ $post->CreatedAt }}</p>
                                </div>
                            </div>
                        @endforeach
                        <!--/ End Single Post -->
                      </div>
                      <!--/ End Popular Posts -->
                      <!-- Popular Posts -->
                      <div class="tab-pane fade" id="recent" role="tabpanel" >
                        
                        <!-- Single Post -->
                        @foreach ($posts_latest as $post)
                         <div class="single-post">
                             @if ($post->imageThumbUrl)
                             <div class="post-img">
                                 <a href="{{ route('post.show', $post) }}"><img src="{{ $post->imageThumburl }}" alt="{{ $post->title }}"></a>   
                             </div>
                             @else
                             <div class="post-img">
                                <img src="{{ url('') }}/assets/help/img/edu5.jpeg" alt="post">
                             </div>
                             @endif
                             <div class="post-info">
                                 <h4><a href="{{ route('post.show', $post) }}">{{ $post->title }}</a></h4>
                                 <p><i class="fa fa-calendar"></i>{{ $post->CreatedAt }}</p>
                             </div>
                         </div>
                         @endforeach
                        <!--/ End Single Post -->
                        
                      </div>
                      <!--/ End Popular Posts -->
                      <!-- Popular Posts -->
                      <div class="tab-pane fade" id="featured" role="tabpanel" >
                        
                        <!-- Single Post -->
                        @foreach ($posts_selection as $post)
                         <div class="single-post">
                             @if ($post->imageThumbUrl)
                             <div class="post-img">
                                 <a href="{{ route('post.show', $post) }}"><img src="{{ $post->imageThumburl }}" alt="{{ $post->title }}"></a>   
                             </div>
                             @else
                             <div class="post-img">
                                <img src="{{ url('') }}/assets/help/img/edu5.jpeg" alt="post">
                             </div>
                             @endif
                             <div class="post-info">
                                 <h4><a href="{{ route('post.show', $post) }}">{{ $post->title }}</a></h4>
                                 <p><i class="fa fa-calendar"></i>{{ $post->CreatedAt }}</p>
                             </div>
                         </div>
                         @endforeach
                        <!--/ End Single Post -->
                        
                      </div>
                      <!--/ End Popular Posts -->
                    </div>
                  </div>
                </div>
              </div>
              <!-- Popular Post -->
        </div>
    </div>
     <!-- Widgets-->
     @if (count($global_widget_sidebar_right_bottom))
        
     <div class="row">
         <div class="col-12">
             @foreach ($global_widget_sidebar_right_bottom as $item)
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
