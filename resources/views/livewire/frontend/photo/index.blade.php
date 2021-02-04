<div>
    @if (count($photos))
    <section class="portfolio section mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                  <h4 class="font-weight-bold mb-3 mx-3">PORTFOLIO</h4>
                </div>
              </div>
            <div class="row">
                <div class="col-12">
                    <!-- portfolio Nav -->
                    <div class="portfolio-nav">
                        <ul class="tr-list list-inline cbp-l-filters-work" id="portfolio-menu">
                            <li data-filter="*" class="cbp-filter-item active">All<div class="cbp-filter-counter"></div>
                            </li>  
                            @foreach ($albums as $album)
                                @if (count($album->photo()->get()))
                                <li data-filter=".{{ $album->slug }}" class="cbp-filter-item">{{ $album->title }}<div class="cbp-filter-counter"></div>
                                </li>
                                @endif
                            @endforeach
    
                        </ul>  		
                    </div>
                    <!--/ End portfolio Nav -->
                </div>
            </div>
            
            <div class="portfolio-inner">
                <div id="portfolio-item">
                    @foreach ($photos as $photo)
                    <div class="cbp-item development {{ $photo->album->slug }} ">
                        <div class="portfolio-single">
                            <div class="portfolio-head">
                                @if ($photo->ImageThumbUrl)
                                <img src="{{ $photo->ImageThumbUrl }}" alt="#"/>
                                @else
                                <img src="assets/kz/images/gallery-1.jpg" alt="#"/>
                                @endif
                                <div class="portfolio-hover">
                                    <h4>{{ $photo->title }}</h4>
                                    <div class="p-button">
                                        <a data-fancybox="portfolio" href="{{ $photo->ImageUrl }}" data-caption="{{ $photo->title }}" class="btn primary"><i class="fas fa-image"></i></a>
                                        <a href="#" class="btn primary" title="Album {{ $photo->album->title }}"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Load More Button -->
                <div class="row text-center mt-4">
                    <div class="col-12 ">
                    {{-- <a href="{{ route('post.all') }}" class="btn btn-primary">Tampilkan lebih banyak </a> --}}

                        
                    </div>
                </div>
                <!--/ End Load More Button -->
            </div>

        </div>
    </section>
    @else
        {{-- <h2 class="fw-bold" style="color:red">Nothing Found</h2> --}}
    @endif
</div>
