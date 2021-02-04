<div>
    @section("title")Detail Page @endsection
    
    <!-- Blog Archive -->
    <!-- Blog Archive -->
    <section class="blogs archive single section pt-5">
        <div class="container">
            <div class="row justify-content-center pt-5">
                <div class="col-lg-8 col-12">
                    <div class="row">
                        <div class="col-12">
                            <!-- Single blog -->
                            <div class="card single-blog">
                                {{-- <div class="card-img">
                                    @if ($page->imageUrl)
                                    <img src="{{ $page->imageUrl }}" alt="{{ $page->title }}" class="card-img-top">   
                                    @else
                                    <img src="{{ url('') }}/assets/help/img/edu5.jpeg" class="card-img-top" alt="{{ $page->title }}">
                                    @endif
                                </div> --}}
                                <div class="card-body">
                                    <h2 class="card-title">{{ $page->title}}</h2>
                                    <hr>
                                  
                                    {!! $page->content !!}
                                  
                                </div>
                            </div>
                            <!--/ End Single blog -->
                        </div> 
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    
</div>
