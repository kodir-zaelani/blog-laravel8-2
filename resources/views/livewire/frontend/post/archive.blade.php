<div>
    @section("title")Post Archive @endsection
    {{-- @section("sub_title")Category @endsection --}}
    
    <!-- Blog Archive -->
    <section class="blogs grid-sidebar archive section" style="background-color:#edf2f7">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8 col-12">
                    <div class="row">
                        @if (count($posts))
                        @foreach ($posts as $post)
                        <div class="col-md-6 col-lg-6 col-12 mb-4">
                            <div class="card h-100 shadow-sm border-0 rounded-lg">
                                <div class="card-img">
                                    @if ($post->ImageThumbUrl)
                                    <a href="{{ route('post.show', $post) }}"><img src="{{ $post->ImageThumbUrl }}" class="card-img-top" alt="{{ $post->title }}" class="w-100"></a>   
                                    @else
                                    <a href="{{ route('post.show', $post) }}"><img src="{{ url('') }}/assets/help/img/edu5.jpeg" class="card-img-top" alt="{{ $post->title }}" 
                                        class="w-100"></a>
                                        @endif
                                        
                                    </div>
                                    <div class="card-body blog-bottom">
                                        <ul class="blog-meta1">
                                            <li> <a href="{{ route('categorypost.show', $post->categorypost->slug) }}"><i class="fa fa-folder"></i>{{ $post->categorypost->title  }}</a></li>
                                            <li><a href="#"><i class="fas fa-calendar-alt"></i> {{ $post->CreatedAt }}</a></li>
                                        </ul>
                                        <h4><a href="{{ route('post.show', $post) }}">{{ $post->title }}</a></h4>
                                        
                                        @if ($post->tags_html )
                                        <p> <i class="fa fa-tags mr-2"></i> {!! $post->tags_html !!}</p>
                                        @endif
                                    </div>
                                    <div class="card-footer bg-white">
                                        <ul>
                                            <li class="author">
                                                @if ($post->author->photo)
                                                <img src="{{ url('') }}/uploads/photos/users/photos_thumb/{{ $post->author->photo }}" ><span>By: <a href="{{ route('author.show',$post->author->slug) }}">{{ $post->author->name  }}</a></span></li>
                                                @else
                                                <i class="fa fa-user"></i> <span>By: <a href="{{ route('author.show',$post->author->slug) }}">{{ $post->author->name  }}</a></span>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <h2 class="fw-bold" style="color:red">Nothing Result</h2>
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
                    @livewire('frontend.main.sidebar')
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
    