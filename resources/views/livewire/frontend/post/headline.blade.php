<div>
    <!-- headline section -->
    <div class="row mb-3">
        <div class="col-md-12 ">
            <div class="title p-2 " >
                <h4><i class="fas fa-newspaper"></i> HEADLINE</h4>
            </div>
        </div>
    </div>
    <!-- Carousel headline -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-12 ">
                <div id="postmyCarousel" class="carousel slide " data-ride="carousel">
                   <ol class="carousel-indicators">
                    <li data-target="#postmyCarousel" data-slide-to="0" class="active"></li>
                  </ol> 
                  <div class="carousel-inner">

                    @foreach ($headlines as $key => $post)

                    <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                      
                      <div class="card mb-3">
                        @if ($post->ImageUrl)
                            <a href="{{ route('post.show', $post) }}"><img src="{{ $post->ImageUrl }}" alt="{{ $post->title }}" class="card-img-top"></a>   
                        @else
                            <a href="{{ route('post.show', $post) }}"><img src="{{ url('') }}/assets/help/img/edu5.jpeg" class="card-img-top" alt="{{ $post->title }}"></a>
                        @endif
                        <div class="card-img-overlay text-white">
                          <p class="card-text mb-0" style="color: rgb(247, 244, 244)!important;">
                            <span class="badge bg-danger py-2 px-2"><i class="fas fa-check-circle"></i> Headline</span>
                          </p>
                        </div>
                        <div class="card-body blog-bottom">
                          <h4><a href="{{ route('post.show', $post) }}">{{ $post->title }}</a></h4>

                            <ul class="blog-meta">
                              <li class="author">
                                @if ($post->author->photo)
                                  <img src="{{ url('') }}/uploads/photos/users/photos_thumb/{{ $post->author->photo }}" ><span>By: <a href="{{ route('author.show',$post->author->slug) }}">{{ $post->author->name  }}</a></span></li>
                                @else
                                <i class="fa fa-user"></i> <span>By: <a href="{{ route('author.show',$post->author->slug) }}">{{ $post->author->name  }}</a></span>
                                @endif
                              </li>
                              <li><a href="#"><i class="fas fa-calendar-alt"></i> {{ $post->CreatedAt }}</a></li>
                              {{-- <li><a href="#"><i class="fa fa-comments"></i>264 Comments</a></li> --}}
                              {{-- <li><i class="fa fa-share-alt"></i>599 Share</li> --}}
                            </ul>
                        </div>
                      </div>
                      
                     </div>
                    @endforeach
                  </div>
                  <a class="carousel-control-prev" href="#postmyCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#postmyCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($headlines as $post)

            <div class="col-md-3 col-lg-3 col-12 mb-4 items-headline">
                <div class="card h-100 shadow-sm border-0 rounded-lg">
                  <div class="card-img">
                    @if ($post->ImageUrl)
                        <a href="{{ route('post.show', $post) }}"><img src="{{ $post->ImageUrl }}" alt="{{ $post->title }}" class="img-fluid"></a>   
                    @else
                        <a href="{{ route('post.show', $post) }}"><img src="{{ url('') }}/assets/help/img/edu5.jpeg" alt="{{ $post->title }}"></a>
                    @endif
                  </div>
                  <div class="card-body blog-headline">
                    <h4><a href="{{ route('post.show', $post) }}">{{ $post->title }}</a></h4>
                  </div>
                </div>
            </div>
            @endforeach
           
        </div>
          
          <!-- End Headline -->
</div>
