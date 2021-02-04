<div>
  @if (count($posts))
      
  <!-- Start CTA -->
  <section class="call-to-action overlay dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll out-of-bootstrap mt-5" data-options='{ direction: "normal"}'>
    <div class="overlay divimage dzsparallaxer--target bg-image" style="width: 100%; height: 150%; background-image: url(assets/img/38923ffd19be83834ef17c98567fa070.png)"></div>
    <div class="call-to-main">
      <div id="particles-js"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-10 offset-lg-1 col-12">
            <div class="text-inner">
              <div class="call-text">
                <h2>ARTIKEL BERDASARKAN KATEGORI</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ End CTA -->
  @if (count($global_adverstisment_home_middle))
  <div class="container">
      <div class="row justify-content-center pt-4 d-none d-sm-none d-md-block d-lg-block">
          <div class="col-12 text-center">
              @foreach ($global_adverstisment_home_middle as $item)
                  @if ($item->image)
                      <img src="{{ url('/uploads/advertisements', $item->image) }}" alt="" srcset="">
                  @else 
                      {!! $item->source !!}
                  @endif
              @endforeach
          </div>
      </div>
  </div>
  @endif
  <section class="category-article" id="category-article">
    <div class="container">
      <div class="row justify-content-center">
        
        @foreach ($categoryposts as $item)
        {{-- Jika post sesuai relasi category ada tampilkan  --}}
          @if (count($item->post()->get())) 
            <div class="col-md-4 col-g-4 col-12 mb-4">
              <div class="card card-primary h-100 shadow-sm border-0 rounded-lg">
                <div class="card-header text-center">
                  <div class="h4">{{ $item->title }}</div>
                </div>
                <div class="card-body">
                  <div class="list-group">
                    @foreach ($item->post()->take(4)->latest()->get() as $post)
                    <a href="" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded">
                      <div class="row justify-content-center">
                        <div class="col-4 d-flex align-items-center">
                          @if ($post->imageThumbUrl)
                                <img src="{{ $post->imageThumburl }}" alt="{{ $post->title }}"style="object-fit: cover;border-radius: .3rem;border-top-right-radius: .3rem;"
                                class="img-fluid "/>  
                            @else
                              <img src="{{ url('') }}/assets/help/img/edu5.jpeg" alt="post" style="object-fit: cover;border-radius: .3rem;border-top-right-radius: .3rem;"
                              class="img-fluid " />
                            @endif
                        </div>
                        <div class="col-8 d-flex align-items-center">
                          <span >{{ $post->title }}</span>
                        </div>
                      </div>
                    </a>
                    @endforeach
                    
                  </div>
                </div>
                <div class="text-center card-footer bg-white">
                  <a href="{{ route('categorypost.show', $item->slug) }}" class="btn btn-primary mt-2">Lihat Lebih Banyak</a>
                </div>
              </div>
            </div>
          @endif
        @endforeach
        
      </div>
    </div>
  </section>
  @endif
  
  <!-- end category section -->
</div>
