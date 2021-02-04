<div>
    @section("title")Post Search @endsection
    <div class="cta-header pt-5">
        <div class="container-fluid">
            <div class="row justify-content-center pt-5">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="cta-header-title text-center">
                        <div> <a href="https://www.freepik.com/free-icon/search_929060.htm#page=1&query=search&position=20" title="Freepik"><img src="{{ url('') }}/assets/frontend/image/search_monitor.png" alt="" srcset="" style="max-width: 30%"></a> </div>
                        <h2 class="py-4 text-uppercase font-weight-bold">Hasil Pencarian</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog Archive -->
    <section class="blogs grid-sidebar archive section" style="background-color:#edf2f7">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                  <h3 class="font-weight-bold mb-3 text-uppercase">ARTIKEL DENGAN KUNCI PENCARIAN " {{ $searchterm }} "</h3><hr>
                </div>
            </div>
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
                    @livewire('frontend.main.sidebarpopular')
                    @livewire('frontend.main.sidebarcategory')
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

    @push('scripts')
        <script>
            $(document).ready(function(){
            // This event js triger when the modal is hidden
            $("#searchModal").on('hidden.bs.modal', function(){
                // alert('The modal is now hidden.');
                livewire.emit('forcedClosesearchModal');
            });
        });
        </script>
    @endpush
</div>
    