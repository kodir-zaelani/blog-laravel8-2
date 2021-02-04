<div>
    @section("title")Post Tags @endsection
    <div class="cta-header pt-5">
        <div class="container-fluid">
            <div class="row justify-content-center pt-5">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="cta-header-title text-center">
                        
                        <h2 class="py-4 text-uppercase font-weight-bold">{{ $tag->title }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Archive -->
    <section class="section-detail">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                  <h3 class="font-weight-bold mb-3 text-uppercase">ARTIKEL DENGAN TAG "{{ $tag->title }}"</h3><hr>
                </div>
              </div>
            <div class="row">
                {{-- <div class="alert alert-info"> --}}
                    {{--  <livewire:frontend.post.alert />  --}}
                    {{-- <p>Tag name: <strong>{{ $tag_name}}</strong></p> --}}
                {{-- </div> --}}
                <div class="col-md-8 col-lg-8 col-12">
                    @if (count($posts))
                    <div class="row justify-content-center">
                        @foreach ($posts as $post)
                        <div class="col-md-6 col-lg-6 col-12 mb-4">
                            <div class="card h-100 shadow-sm border-0 rounded-lg">
                                <div class="card-img">
                                    @if ($post->ImageThumbUrl)
                                    <a href="{{ route('post.show', $post) }}"><img src="{{ $post->ImageThumbUrl }}" class="card-img-top" alt="{{ $post->title }}" class="w-100">
                                    </a>   
                                    @else
                                    <a href="{{ route('post.show', $post) }}"><img src="{{ url('') }}/assets/help/img/edu5.jpeg" class="card-img-top" alt="{{ $post->title }}" 
                                        class="w-100"></a>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        @if ($post->tags_html )
                                        <p> <i class="fa fa-tags mr-2"></i> {!! $post->tags_html !!}</p>
                                        @endif
                                        <h4><a href="{{ route('post.show', $post) }}">{{ $post->title }}</a></h4>

                                    </div>
                                    <div class="card-footer bg-white">
                                        <span class="author">
                                            @if ($post->author->photo)
                                            <img src="{{ url('') }}/uploads/photos/users/photos_thumb/{{ $post->author->photo}}"  ><span><a href="{{ route('author.show', $post->author->slug) }}">{{ $post->author->name  }}</a></span></li>
                                            @else
                                            <i class="fa fa-user"></i> <span><a href="{{ route('author.show', $post->author->slug) }}">{{ $post->author->name  }}</a></span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        <!-- end berita section -->
                        @else
                        <h2 class="fw-bold" style="color:red">Nothing Post Found</h2>
                        @endif
                    </div>
                    <div class="row pt-5 justify-content-center">
                        <div class="col-12">
                            <!-- Pagination -->
                            <div class="pagination-main" >
                                {{ $posts->links() }}
                            </div>
                            <!--/ End Pagination -->
                        </div>
                    </div>	
                </div>
                <div class="col-md-4 col-lg-4 col-12">
                    <!-- Blog Sidebar -->
                    @livewire('frontend.main.sidebarcategory')
                    @livewire('frontend.main.sidebarpopular')
                    @livewire('frontend.main.sidebartags')
                    {{-- @livewire('frontend.main.sidebarphoto') --}}
                    <!--/ End Blog Sidebar -->
                </div>
            </div>
        </div>
    </section>
    <!--/ End Blog Archive -->
    <!-- Newsletter -->
    {{--  <livewire:main.newsletter></livewire:main.newsletter>  --}}
    <!--/ End Newsletter -->
    </div>
    