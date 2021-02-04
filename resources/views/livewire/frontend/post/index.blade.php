<div>
  
  <!-- section article -->
  <section class="article" id="article">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <h2 class="font-weight-bold mb-3">HOME</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 col-lg-8 col-12">
          
          @if (count($posts))
          <div class="row">
            @foreach ($posts as $post)
            <div class="col-md-6 mb-4">
              <div class="card h-100 shadow-sm border-0 rounded-lg">
                <div class="card-img">
                  @if ($post->ImageThumbUrl)
                  <a href="{{ route('post.show', $post) }}">
                    <img src="{{ $post->ImageThumbUrl }}"
                    class="card-img-top"
                    style="object-fit: cover; border-top-left-radius: .3rem;border-top-right-radius: .3rem;" alt="{{ $post->title }}"/>
                  </a>   
                  @else
                  <a href="{{ route('post.show', $post) }}">
                    <img src="{{ url('') }}/assets/frontend/image/blog1.jpeg"
                    class="card-img-top"
                    style="object-fit: cover; border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="{{ $post->title }}"/>
                  </a>
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
          </div>
          <div class="row justify-content-center my-3">
            <div class="col-12 text-center">
              <a href="{{ route('post.all') }}" class="btn btn-primary">Lihat Lebih Banyak</a>
            </div>
          </div>
          @endif
        </div>
        <!-- Sidebar -->
        <div class="col-md-4 col-lg-4 col-12">
          <!-- Category section -->
          @livewire('frontend.main.sidebarcategory')
          <!-- end Category section -->
          <!-- Advertisement-->
          <div class="row mb-3">
            <div class="col-12">
              <div class="card">
              @foreach ($global_adverstisment_sidebarmiddle as $item)
              <div class="card-fluid">
                @if ($item->image)
                <img src="{{ url('') }}/uploads/advertisements/{{ $item->image}}" style="width: 100%;height: 300px" 
                class="img-fluid  mr-2 mb-3">
                @else
                    
                {!! $item->source !!}
                @endif
              </div>  
              @endforeach
            </div>
            </div>
        </div>
          <!-- Advertisement-->
          <!-- Tags section -->
          @livewire('frontend.main.sidebartags')
          <!-- end Tags section -->
          <!-- Popular Post -->
          @livewire('frontend.main.sidebarpopular')
          <!-- Popular Post -->
          
          <!-- Subscribe -->
          <!--
            <div class="card card-primary mb-3" >
              <div class="card-header" >
                <h4 class="card-title"><i class="fas fa-mail-bulk"></i> Newsletter</h4>
              </div>
              <div class="card-body">
                <p>Subscribe to our monthly newsletter. Every month we'll send you an awesome update!</p>
                <div class="subscribe">
                  <form action="#">
                    <input placeholder="Email Address" type="email">
                    <button type="submit"><i class="fa fa-paper-plane"></i></button>
                  </form>	
                </div>
              </div>
            </div>
          -->
          <!--/ End Subscribe -->
        </div>
        <!-- End Sidebar -->
      </div>
    </div>
  </section>
  <!--  section article -->
</div>
