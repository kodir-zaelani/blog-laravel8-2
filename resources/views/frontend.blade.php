<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="{{ url('') }}/assets/frontend/css/bootstrap.min.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="{{ url('') }}/assets/frontend/plugins/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="{{ url('') }}/assets/frontend/css/fancybox.min.css">
  <!-- Nice Select CSS -->
  <link rel="stylesheet" href="{{ url('') }}/assets/frontend/css/niceselect.css">
  <link rel="stylesheet" href="{{ url('') }}/assets/frontend/css/cubeportfolio.min.css">
  <link rel="stylesheet" href="{{ url('') }}/assets/frontend/css/dzsparallaxer.min.css">
  <link rel="stylesheet" href="{{ url('') }}/assets/frontend/css/styles.css">
  <link rel="stylesheet" href="{{ url('') }}/assets/frontend/css/responsive.css">
  
  <title>TEst Kreasi test</title>
</head>

<body>
  
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark nav-custom">
    <div class="container">
      <a class="navbar-brand" href="index.html">Laman Kreasi</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link" href="index.html">BERANDA</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            PROFIL
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">SEJARAH</a></li>
            <li><a class="dropdown-item" href="#">VISI MISI</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="berita.html">BERITA</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="agenda.html">AGENDA</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="galery.html">GALERI</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="video.html">VIDEO</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="kontak.html">KONTAK</a>
        </li>
      </ul>
      <div class="d-flex">
        <a href="#" data-toggle="modal" data-target="#register_online" class="btn btn-sm btn-success">Register Online</a>
      </div>
    </div>
  </div>
</nav>
<!-- Home Banner -->
<header class="main-banner">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-md-7">
        <div class="row">
          <div class="col-12">
            <div class="banner-title">
              <h2>Laman Kreasi</h2>
              <h4 class="card-title">Belajar</h4>
              <p>Sharing</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5 col-md-5">
        <div class="main-banner-content">
          <img src="{{ url('') }}/assets/frontend/image/hero.png" style="max-width: 90%">
        </div>
      </div>
    </div>
  </div>
</header>

{{-- section article --}}
<section class="article" id="article">
  <div class="container-fluid mt-5">
    <div class="row">
      <div class="col-12">
        <h2 class="font-weight-bold mb-3">ARTIKEL TERBARU</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 col-lg-8 col-12">
        <div class="row">
          <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-lg">
              <div class="card-img">
                <img src="{{ url('') }}/assets/frontend/image/blog1.jpeg"
                class="img-fluid"
                style="object-fit: cover;border-top-left-radius: .3rem;border-top-right-radius: .3rem;"/>
              </div>
              <div class="card-body">
                <p>
                  <span class="badge bg-primary">Primary</span>
                  <span class="badge bg-secondary">Secondary</span>
                  <span class="badge bg-success">Success</span>
                  <span class="badge bg-danger">Danger</span>
                  <span class="badge bg-warning text-dark">Warning</span>
                  <span class="badge bg-info text-dark">Info</span>
                  <span class="badge bg-light text-dark">Light</span>
                  <span class="badge bg-dark">Dark</span>
                </p>
                <a href="http://" class="text-dark text-decoration-none">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit</h4>
                </a>
              </div>
              <div class="card-footer bg-white">
                <span class="author">
                  <a href="#"><img src="{{ url('') }}/assets/frontend/image/kodir.jpg"> Kodir Zaelani</a>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-lg">
              <div class="card-img">
                <img src="{{ url('') }}/assets/frontend/image/blog1.jpeg"
                class="img-fluid"
                style="object-fit: cover;border-top-left-radius: .3rem;border-top-right-radius: .3rem;">
              </div>
              <div class="card-body">
                <p>
                  <span class="badge bg-primary">Primary</span>
                  <span class="badge bg-secondary">Secondary</span>
                  <span class="badge bg-success">Success</span>
                  <span class="badge bg-danger">Danger</span>
                  <span class="badge bg-warning text-dark">Warning</span>
                  <span class="badge bg-info text-dark">Info</span>
                  <span class="badge bg-light text-dark">Light</span>
                  <span class="badge bg-dark">Dark</span>
                </p>
                <a href="http://" class="text-dark text-decoration-none">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit</h4>
                </a>
              </div>
              <div class="card-footer bg-white">
                <span class="author">
                  <a href="#"><img src="{{ url('') }}/assets/frontend/image/kodir.jpg"> Kodir Zaelani</a>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-lg">
              <div class="card-img">
                <img src="{{ url('') }}/assets/frontend/image/blog1.jpeg"
                class="img-fluid"
                style="object-fit: cover;border-top-left-radius: .3rem;border-top-right-radius: .3rem;">
              </div>
              <div class="card-body">
                <p>
                  <span class="badge bg-primary">Primary</span>
                  <span class="badge bg-secondary">Secondary</span>
                  <span class="badge bg-success">Success</span>
                  <span class="badge bg-danger">Danger</span>
                  <span class="badge bg-warning text-dark">Warning</span>
                  <span class="badge bg-info text-dark">Info</span>
                  <span class="badge bg-light text-dark">Light</span>
                  <span class="badge bg-dark">Dark</span>
                </p>
                <a href="http://" class="text-dark text-decoration-none">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit</h4>
                </a>
              </div>
              <div class="card-footer bg-white">
                <span class="author">
                  <a href="#"><img src="{{ url('') }}/assets/frontend/image/kodir.jpg"> Kodir Zaelani</a>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-lg">
              <div class="card-img">
                <img src="{{ url('') }}/assets/frontend/image/blog1.jpeg"
                class="img-fluid"
                style="object-fit: cover;border-top-left-radius: .3rem;border-top-right-radius: .3rem;">
              </div>
              <div class="card-body">
                <p>
                  <span class="badge bg-primary">Primary</span>
                  <span class="badge bg-secondary">Secondary</span>
                  <span class="badge bg-success">Success</span>
                  <span class="badge bg-danger">Danger</span>
                  <span class="badge bg-warning text-dark">Warning</span>
                  <span class="badge bg-info text-dark">Info</span>
                  <span class="badge bg-light text-dark">Light</span>
                  <span class="badge bg-dark">Dark</span>
                </p>
                <a href="http://" class="text-dark text-decoration-none">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit</h4>
                </a>
              </div>
              <div class="card-footer bg-white">
                <span class="author">
                  <a href="#"><img src="{{ url('') }}/assets/frontend/image/kodir.jpg"> Kodir Zaelani</a>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-lg">
              <div class="card-img">
                <img src="{{ url('') }}/assets/frontend/image/blog1.jpeg"
                class="img-fluid"
                style="object-fit: cover;border-top-left-radius: .3rem;border-top-right-radius: .3rem;">
              </div>
              <div class="card-body">
                <p>
                  <span class="badge bg-primary">Primary</span>
                  <span class="badge bg-secondary">Secondary</span>
                  <span class="badge bg-success">Success</span>
                  <span class="badge bg-danger">Danger</span>
                  <span class="badge bg-warning text-dark">Warning</span>
                  <span class="badge bg-info text-dark">Info</span>
                  <span class="badge bg-light text-dark">Light</span>
                  <span class="badge bg-dark">Dark</span>
                </p>
                <a href="http://" class="text-dark text-decoration-none">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit</h4>
                </a>
              </div>
              <div class="card-footer bg-white">
                <span class="author">
                  <a href="#"><img src="{{ url('') }}/assets/frontend/image/kodir.jpg"> Kodir Zaelani</a>
                </span>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-lg">
              <div class="card-img">
                <img src="{{ url('') }}/assets/frontend/image/blog1.jpeg"
                class="img-fluid"
                style="object-fit: cover;border-top-left-radius: .3rem;border-top-right-radius: .3rem;">
              </div>
              <div class="card-body">
                <p>
                  <span class="badge bg-primary">Primary</span>
                  <span class="badge bg-secondary">Secondary</span>
                  <span class="badge bg-success">Success</span>
                  <span class="badge bg-danger">Danger</span>
                  <span class="badge bg-warning text-dark">Warning</span>
                  <span class="badge bg-info text-dark">Info</span>
                  <span class="badge bg-light text-dark">Light</span>
                  <span class="badge bg-dark">Dark</span>
                </p>
                <a href="http://" class="text-dark text-decoration-none">
                  <h4 class="card-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit</h4>
                </a>
              </div>
              <div class="card-footer bg-white">
                <span class="author">
                  <a href="#"><img src="{{ url('') }}/assets/frontend/image/kodir.jpg"> Kodir Zaelani</a>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center mt-3">
          <div class="col-12 text-center">
            <a href="#" class="btn btn-primary">Lihat Lebih Banyak</a>
          </div>
        </div>
      </div>
      <!-- Sidebar -->
      <div class="col-md-4 col-lg-4 col-12">
        <!-- Category section -->
        <div class="card card-primary mb-3" >
          <div class="card-body">
            <h4 class="font-weight-bold"><i class="fab fa-stack-overflow"></i> KATEGORI</h4>
            <hr>
            <div class="list-group my-3">
              <a href="" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded">
                <span class="pull-left ">
                  <img src="{{ url('') }}/assets/frontend/image/kodir.jpg" 
                  style="width: 50px;height: 50px" 
                  class="img-fluid rounded-circle mr-2" />
                </span>
                <span style="font-size: 20px">HTML</span>
              </a>
              
              <a href="" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded">
                <span class="pull-left ">
                  <img src="{{ url('') }}/assets/frontend/image/kodir.jpg" 
                  style="width: 50px;height: 50px" 
                  class="img-fluid rounded-circle mr-2" />
                </span>
                <span style="font-size: 20px">CSS</span>
              </a>
              <a href="" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded">
                <span class="pull-left ">
                  <img src="{{ url('') }}/assets/frontend/image/kodir.jpg" 
                  style="width: 50px;height: 50px" 
                  class="img-fluid rounded-circle mr-2" />
                </span>
                <span style="font-size: 20px">Laravel</span>
              </a>
            </div>
          </div>
        </div>
        <!-- end Category section -->
        <!-- Tags section -->
        <div class="card card-primary mb-3" >
          <div class="card-body">
            <h4 class="font-weight-bold"><i class="fas fa-tags"></i> Tags</h4>
            <hr>
            <span class="badge bg-primary">Primary</span>
            <span class="badge bg-secondary">Secondary</span>
            <span class="badge bg-success">Success</span>
            <span class="badge bg-danger">Danger</span>
            <span class="badge bg-warning text-dark">Warning</span>
            <span class="badge bg-info text-dark">Info</span>
            <span class="badge bg-light text-dark">Light</span>
            <span class="badge bg-dark">Dark</span>
          </div>
        </div>
        <!-- end Tags section -->
        <!-- live tv -->
        <div class="card card-primary mb-3" >
          <div class="card-header" >
            <h4 class="card-title"><i class="fab fa-youtube"></i> Spansa One TV</h4>
          </div>
          <div class="card-body text-center">
            <div class="embed-responsive embed-responsive-16by9 embed-responsive-item">
              <iframe width="853" height="480" src="https://www.youtube.com/embed/ULa8_4fqmMs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            
            <br>
            <button class="btn btn-primary">Tampilkan lebih banyak</button>
          </div>
        </div>
        <!-- live tv -->
        <!-- Popular Post -->
        <div class="card mb-3">
          <div class="card-body">
            <div class="single-sidebar post-tab">
              <!-- Tab Nav -->
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#popular" role="tab">Popular</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#recent" role="tab">Recent</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#featured" role="tab">Featured</a></li>
              </ul>
              <!--/ End Tab Nav -->
              <div class="tab-content" id="myTabContent">
                <!-- Popular Posts -->
                <div class="tab-pane fade show active" id="popular" role="tabpanel" >
                  <!-- Single Post -->
                  <div class="single-post">
                    <div class="post-img">
                      <img src="http://via.placeholder.com/65x60" alt="#">
                    </div>
                    <div class="post-info">
                      <h4 class="card-title"><a href="blog-single.html">How to Earn Huge Money Without any Investment</a></h4>
                      <p><i class="fa fa-calendar"></i>09 May, 2018</p>
                    </div>
                  </div>
                  <!--/ End Single Post -->
                  <!-- Single Post -->
                  <div class="single-post">
                    <div class="post-img">
                      <img src="http://via.placeholder.com/65x60" alt="#">
                    </div>
                    <div class="post-info">
                      <h4 class="card-title"><a href="blog-single.html">10 Awesome Ways for Start Your Own Website</a></h4>
                      <p><i class="fa fa-calendar"></i>05 July, 2018</p>
                    </div>
                  </div>
                  <!--/ End Single Post -->
                  <!-- Single Post -->
                  <div class="single-post">
                    <div class="post-img">
                      <img src="http://via.placeholder.com/65x60" alt="#">
                    </div>
                    <div class="post-info">
                      <h4 class="card-title"><a href="blog-single.html">Why buying a big house is a bad investment</a></h4>
                      <p><i class="fa fa-calendar"></i>10 April, 2018</p>
                    </div>
                  </div>
                  <!--/ End Single Post -->
                  <!-- Single Post -->
                  <div class="single-post">
                    <div class="post-img">
                      <img src="http://via.placeholder.com/65x60" alt="#">
                    </div>
                    <div class="post-info">
                      <h4 class="card-title"><a href="blog-single.html">Styles come and go. Design is a language</a></h4>
                      <p><i class="fa fa-tag"></i>23 April, 2018</p>
                    </div>
                  </div>
                  <!-- Single Post -->
                </div>
                <!--/ End Popular Posts -->
                <!-- Popular Posts -->
                <div class="tab-pane fade" id="recent" role="tabpanel" >
                  <!-- Single Post -->
                  <div class="single-post">
                    <div class="post-img">
                      <img src="http://via.placeholder.com/65x60" alt="#">
                    </div>
                    <div class="post-info">
                      <h4 class="card-title"><a href="blog-single.html">10 Awesome Ways for Start Your Own Website</a></h4>
                      <p><i class="fa fa-calendar"></i>05 July, 2018</p>
                    </div>
                  </div>
                  <!--/ End Single Post -->
                  <!-- Single Post -->
                  <div class="single-post">
                    <div class="post-img">
                      <img src="http://via.placeholder.com/65x60" alt="#">
                    </div>
                    <div class="post-info">
                      <h4 class="card-title"><a href="blog-single.html">How to Earn Huge Money Without any Investment</a></h4>
                      <p><i class="fa fa-calendar"></i>09 May, 2018</p>
                    </div>
                  </div>
                  <!--/ End Single Post -->
                  <!-- Single Post -->
                  <div class="single-post">
                    <div class="post-img">
                      <img src="http://via.placeholder.com/65x60" alt="#">
                    </div>
                    <div class="post-info">
                      <h4 class="card-title"><a href="blog-single.html">Styles come and go. Design is a language</a></h4>
                      <p><i class="fa fa-tag"></i>23 April, 2018</p>
                    </div>
                  </div>
                  <!-- Single Post -->
                  <!-- Single Post -->
                  <div class="single-post">
                    <div class="post-img">
                      <img src="http://via.placeholder.com/65x60" alt="#">
                    </div>
                    <div class="post-info">
                      <h4 class="card-title"><a href="blog-single.html">Why buying a big house is a bad investment</a></h4>
                      <p><i class="fa fa-calendar"></i>10 April, 2018</p>
                    </div>
                  </div>
                  <!--/ End Single Post -->
                </div>
                <!--/ End Popular Posts -->
                <!-- Popular Posts -->
                <div class="tab-pane fade" id="featured" role="tabpanel" >
                  <!-- Single Post -->
                  <div class="single-post">
                    <div class="post-img">
                      <img src="http://via.placeholder.com/65x60" alt="#">
                    </div>
                    <div class="post-info">
                      <h4 class="card-title"><a href="blog-single.html">How to Earn Huge Money Without any Investment</a></h4>
                      <p><i class="fa fa-calendar"></i>09 May, 2018</p>
                    </div>
                  </div>
                  <!--/ End Single Post -->
                  <!-- Single Post -->
                  <div class="single-post">
                    <div class="post-img">
                      <img src="http://via.placeholder.com/65x60" alt="#">
                    </div>
                    <div class="post-info">
                      <h4 class="card-title"><a href="blog-single.html">Styles come and go. Design is a language</a></h4>
                      <p><i class="fa fa-tag"></i>23 April, 2018</p>
                    </div>
                  </div>
                  <!-- Single Post -->
                  <!-- Single Post -->
                  <div class="single-post">
                    <div class="post-img">
                      <img src="http://via.placeholder.com/65x60" alt="#">
                    </div>
                    <div class="post-info">
                      <h4 class="card-title"><a href="blog-single.html">Why buying a big house is a bad investment</a></h4>
                      <p><i class="fa fa-calendar"></i>10 April, 2018</p>
                    </div>
                  </div>
                  <!--/ End Single Post -->
                </div>
                <!--/ End Popular Posts -->
              </div>
            </div>
          </div>
        </div>
        <!-- Popular Post -->
        
        <!-- Subscribe -->
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
        <!--/ End Subscribe -->
      </div>
      <!-- End Sidebar -->
    </div>
  </div>
</section>
{{-- section article --}}

<!-- Start CTA -->
<section class="call-to-action overlay dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll out-of-bootstrap" data-options='{ direction: "normal"}'>
  <div class="overlay divimage dzsparallaxer--target bg-image" style="width: 100%; height: 150%; background-image: url(assets/img/38923ffd19be83834ef17c98567fa070.png)"></div>
  <div class="call-to-main">
    <div id="particles-js"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1 col-12">
          <div class="text-inner">
            <div class="call-text">
              <h2>ARTIKEL BERDASARKAN KATEGORI</h2>
              {{-- <p>Mauris euismod interdum lectus, ac gravida leo hendrerit eu. Integer a commodo turpis, nec pharetra lacus. Sed vitae ipsum lacus. Nulla sit amet ultricies tellus, eget tristique nisi. Nunc eget metus ac mi mollis.</p> --}}
            </div>
            {{-- <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Kata Kunci Materi Pelajaran" aria-label="Kata Kunci Materi Pelajaran" aria-describedby="basic-addon2">
              <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
            </div> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End CTA -->

<!-- Course -->
<section class="category-article" id="category-article">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-g-4 col-12 mb-4">
        <div class="card card-primary h-100 shadow-sm border-0 rounded-lg">
          <div class="card-header text-center">
            <div class="h4">HTML</div>
          </div>
          <div class="card-body">
            <div class="list-group">
              <a href="" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded">
                <div class="row justify-content-center">
                  <div class="col-4 d-flex align-items-center">
                    <img src="{{ url('') }}/assets/frontend/image/kodir.jpg" 
                    style="object-fit: cover;border-radius: .3rem;border-top-right-radius: .3rem;"
                    {{-- style="object-fit: cover;border-radius: .3rem;border-top-right-radius: .3rem;" --}}
                    class="img-fluid " />
                  </div>
                  <div class="col-8 d-flex align-items-center">
                    <span >Lorem ipsum dolor sit amet. Lorem, ipsum dolor. Lorem, ipsum dolor.</span>
                  </div>
                </div>
              </a>
              
              <a href="" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded">
                <div class="row justify-content-center">
                  <div class="col-4 d-flex align-items-center">
                    <img src="{{ url('') }}/assets/frontend/image/kodir.jpg" 
                  style="object-fit: cover;border-radius: .3rem;border-top-right-radius: .3rem;"
                  class="img-fluid " />
                  </div>
                  <div class="col-8 d-flex align-items-center">
                    <span >Lorem ipsum dolor sit amet. Lorem, ipsum dolor. Lorem, ipsum dolor.</span>
                  </div>
                </div>
              </a>
              <a href="" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded">
                <div class="row justify-content-center">
                  <div class="col-4 d-flex align-items-center">
                    <img src="{{ url('') }}/assets/frontend/image/kodir.jpg" 
                  style="object-fit: cover;border-radius: .3rem;border-top-right-radius: .3rem;"
                  class="img-fluid " />
                  </div>
                  <div class="col-8 d-flex align-items-center">
                    <span >Lorem ipsum dolor sit amet. </span>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="text-center card-footer bg-white">
            <a href="#" class="btn btn-primary mt-2">Lihat Lebih Banyak</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-g-4 col-12 mb-4">
        <div class="card card-primary h-100 shadow-sm border-0 rounded-lg">
          <div class="card-header text-center">
            <div class="h4">CSS</div>
          </div>
          <div class="card-body">
            <div class="list-group">
              <a href="" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded">
                <div class="row justify-content-center">
                  <div class="col-4 d-flex align-items-center">
                    <img src="{{ url('') }}/assets/frontend/image/kodir.jpg" 
                  style="object-fit: cover;border-radius: .3rem;border-top-right-radius: .3rem;"
                  class="img-fluid " />
                  </div>
                  <div class="col-8 d-flex align-items-center">
                    <span >Lorem ipsum dolor sit amet. Lorem, ipsum dolor. Lorem, ipsum dolor.</span>
                  </div>
                </div>
              </a>
              
              <a href="" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded">
                <div class="row justify-content-center">
                  <div class="col-4 d-flex align-items-center">
                    <img src="{{ url('') }}/assets/frontend/image/kodir.jpg" 
                  style="object-fit: cover;border-radius: .3rem;border-top-right-radius: .3rem;"
                  class="img-fluid " />
                  </div>
                  <div class="col-8 d-flex align-items-center">
                    <span >Lorem ipsum dolor sit amet. Lorem, ipsum dolor. Lorem, ipsum dolor.</span>
                  </div>
                </div>
              </a>
              <a href="" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded">
                <div class="row justify-content-center">
                  <div class="col-4 d-flex align-items-center">
                    <img src="{{ url('') }}/assets/frontend/image/kodir.jpg" 
                  style="object-fit: cover;border-radius: .3rem;border-top-right-radius: .3rem;"
                  class="img-fluid " />
                  </div>
                  <div class="col-8 d-flex align-items-center">
                    <span >Lorem ipsum dolor sit amet. </span>
                  </div>
                </div>
              </a>
              <a href="" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded">
                <div class="row justify-content-center">
                  <div class="col-4 d-flex align-items-center">
                    <img src="{{ url('') }}/assets/frontend/image/kodir.jpg" 
                  style="object-fit: cover;border-radius: .3rem;border-top-right-radius: .3rem;"
                  class="img-fluid " />
                  </div>
                  <div class="col-8 d-flex align-items-center">
                    <span >Lorem ipsum dolor sit amet. </span>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="text-center card-footer bg-white">
            <a href="#" class="btn btn-primary mt-2">Lihat Lebih Banyak</a>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-g-4 col-12 mb-4">
        <div class="card card-primary h-100 shadow-sm border-0 rounded-lg">
          <div class="card-header text-center">
            <div class="h4">Laravel</div>
          </div>
          <div class="card-body">
            <div class="list-group">
              <a href="" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded">
                <div class="row justify-content-center">
                  <div class="col-4 d-flex align-items-center">
                    <img src="{{ url('') }}/assets/frontend/image/kodir.jpg" 
                  style="object-fit: cover;border-radius: .3rem;border-top-right-radius: .3rem;"
                  class="img-fluid " />
                  </div>
                  <div class="col-8 d-flex align-items-center">
                    <span >Lorem ipsum dolor sit amet. Lorem, ipsum dolor. Lorem, ipsum dolor.</span>
                  </div>
                </div>
              </a>
              
              <a href="" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded">
                <div class="row justify-content-center">
                  <div class="col-4 d-flex align-items-center">
                    <img src="{{ url('') }}/assets/frontend/image/kodir.jpg" 
                  style="object-fit: cover;border-radius: .3rem;border-top-right-radius: .3rem;"
                  class="img-fluid " />
                  </div>
                  <div class="col-8 d-flex align-items-center">
                    <span >Lorem ipsum dolor sit amet. Lorem, ipsum dolor. Lorem, ipsum dolor.</span>
                  </div>
                </div>
              </a>
              <a href="" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded">
                <div class="row justify-content-center">
                  <div class="col-4 d-flex align-items-center">
                    <img src="{{ url('') }}/assets/frontend/image/kodir.jpg" 
                  style="object-fit: cover;border-radius: .3rem;border-top-right-radius: .3rem;"
                  class="img-fluid " />
                  </div>
                  <div class="col-8 d-flex align-items-center">
                    <span >Lorem ipsum dolor sit amet. </span>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="text-center card-footer bg-white">
            <a href="#" class="btn btn-primary mt-2">Lihat Lebih Banyak</a>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section>
<!-- Course -->

<!-- Porfolio -->
<section class="portfolio">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 text-center">
          <h2 class="font-weight-bold">Portfolio</h2>
          <!-- <p>Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin</p> -->
        </div>
      </div> 
    </div> 
    <div class="row">
      <div class="col-12">
        <!-- portfolio Nav -->
        <div class="portfolio-nav">
          <ul class="tr-list list-inline cbp-l-filters-work" id="portfolio-menu">
            <li data-filter="*" class="cbp-filter-item active">All<div class="cbp-filter-counter"></div></li>  
            <li data-filter=".website" class="cbp-filter-item">Website<div class="cbp-filter-counter"></div></li>
            <li data-filter=".branding" class="cbp-filter-item">Branding<div class="cbp-filter-counter"></div></li>
            <li data-filter=".package" class="cbp-filter-item">Package<div class="cbp-filter-counter"></div></li>
            <li data-filter=".development" class="cbp-filter-item">Development<div class="cbp-filter-counter"></div></li>
            <li data-filter=".printing" class="cbp-filter-item">Printing<div class="cbp-filter-counter"></div></li>
          </ul>  		
        </div>
        <!--/ End portfolio Nav -->
      </div>
    </div>
    <div class="portfolio-inner">
      <div id="portfolio-item">
        <!-- Single portfolio -->
        <div class="cbp-item website package">
          <div class="portfolio-single">
            <div class="portfolio-head">
              <img src="assets/image/edu1.jpg" alt="#"/>
              <div class="portfolio-hover">
                <h4 class="card-title"><a href="portfolio-single.html">Creative Work</a></h4>
                <div class="p-button">
                  <a href="https://www.youtube.com/embed/UalTfOIDQ7M" class="btn primary video-play cbp-lightbox"><i class="fa fa-play"></i></a>
                  <a href="portfolio-single.html" class="btn"><i class="fa fa-link"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ End portfolio -->	
        <!-- Single portfolio -->
        <div class="cbp-item development printing">
          <div class="portfolio-single">
            <div class="portfolio-head">
              <img src="assets/image/edu2.jpeg" alt="#"/>
              <div class="portfolio-hover">
                <h4 class="card-title"><a href="portfolio-single.html">Animation</a></h4>
                <div class="p-button">
                  <a data-fancybox="portfolio" href="assets/image/edu2.jpeg" class="btn primary"><i class="fas fa-image"></i></a>
                  <a href="portfolio-single.html" class="btn"><i class="fa fa-link"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ End portfolio -->	
        <!-- Single portfolio -->
        <div class="cbp-item development package">
          <div class="portfolio-single">
            <div class="portfolio-head">
              <img src="assets/image/edu3.jpeg" alt="#"/>
              <div class="portfolio-hover">
                <h4 class="card-title"><a href="portfolio-single.html">Bootstrap 4</a></h4>
                <div class="p-button">
                  <a href="https://www.youtube.com/embed/gvzbqDc6AWI" class="btn primary video-play cbp-lightbox"><i class="fa fa-play"></i></a>
                  <a href="portfolio-single.html" class="btn"><i class="fa fa-link"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ End portfolio -->	
        <!-- Single portfolio -->
        <div class="cbp-item website development">
          <div class="portfolio-single">
            <div class="portfolio-head">
              <img src="assets/image/edu4.jpeg" alt="#"/>
              <div class="portfolio-hover">
                <h4 class="card-title"><a href="portfolio-single.html">Awesome Design</a></h4>
                <div class="p-button">
                  <a data-fancybox="portfolio" href="assets/image/edu4.jpeg" class="btn primary"><i class="fas fa-image"></i></a>
                  <a href="portfolio-single.html" class="btn"><i class="fa fa-link"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ End portfolio -->	
        <!-- Single portfolio -->
        <div class="cbp-item website printing">
          <div class="portfolio-single">
            <div class="portfolio-head">
              <img src="assets/image/edu5.jpeg" alt="#"/>
              <div class="portfolio-hover">
                <h4 class="card-title"><a href="portfolio-single.html">Branding</a></h4>
                <div class="p-button">
                  <a href="https://www.youtube.com/embed/UalTfOIDQ7M" class="btn primary video-play cbp-lightbox"><i class="fa fa-play"></i></a>
                  <a href="portfolio-single.html" class="btn"><i class="fa fa-link"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ End portfolio -->	
        <!-- Single portfolio -->
        <div class="cbp-item branding website">
          <div class="portfolio-single">
            <div class="portfolio-head">
              <img src="assets/image/edu6.jpeg" alt="#"/>
              <div class="portfolio-hover">
                <h4 class="card-title"><a href="portfolio-single.html">Gallery</a></h4>
                <div class="p-button">
                  <a data-fancybox="portfolio" href="assets/image/edu6.jpeg" class="btn primary"><i class="fas fa-image"></i></a>
                  <a href="portfolio-single.html" class="btn"><i class="fa fa-link"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ End portfolio -->	
        <!-- Single portfolio -->
        <div class="cbp-item branding package">
          <div class="portfolio-single">
            <div class="portfolio-head">
              <img src="assets/image/edu7.jpeg" alt="#"/>
              <div class="portfolio-hover">
                <h4 class="card-title"><a href="portfolio-single.html">Clean & modern</a></h4>
                <div class="p-button">
                  <a data-fancybox="portfolio" href="assets/image/edu7.jpeg" class="btn primary"><i class="fas fa-image"></i></a>
                  <a href="portfolio-single.html" class="btn"><i class="fa fa-link"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ End portfolio -->	
        <!-- Single portfolio -->
        <div class="cbp-item printing website">
          <div class="portfolio-single">
            <div class="portfolio-head">
              <img src="assets/image/edu8.jpeg" alt="#"/>
              <div class="portfolio-hover">
                <h4 class="card-title"><a href="portfolio-single.html">Development</a></h4>
                <div class="p-button">
                  <a href="https://www.youtube.com/embed/UalTfOIDQ7M" class="btn primary video-play cbp-lightbox"><i class="fa fa-play"></i></a>
                  <a href="portfolio-single.html" class="btn"><i class="fa fa-link"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/ End portfolio -->	
      </div>
      <div class="row justify-content-center mt-3">
        <div class="col-12 text-center">
          <a href="#" class="btn btn-primary">Lihat Lebih Banyak</a>
        </div>
      </div>
    </div>
  </div>
</section>
<footer>
  <div class="container-fluid" style="background: rgb(255, 255, 255);">
    <div class="row p-4">
      <div class="col-md-4">
        <h5>TENTANG</h5>
        <hr>
        <p>
          Belajar menuangkan ide dalam kreasi
        </p>
        
      </div>
      <div class="col-md-4">
        <h5>TAGS</h5>
        <hr>
        <button class="btn btn-sm btn-outline-secondary mb-2">ISLAM</button>
        <button class="btn btn-sm btn-outline-secondary mb-2">BUDAYA</button>
        <button class="btn btn-sm btn-outline-secondary mb-2">OSIS</button>
        <button class="btn btn-sm btn-outline-secondary mb-2">KEGIATAN</button>
        <button class="btn btn-sm btn-outline-secondary mb-2">KERJA BAKTI</button>
        <button class="btn btn-sm btn-outline-secondary mb-2">PENGUMUMAN</button>
        <button class="btn btn-sm btn-outline-secondary mb-2">INFO</button>
        <button class="btn btn-sm btn-outline-secondary mb-2">PRAMUKA</button>
      </div>
      <div class="col-md-4">
        <h5>KONTAK</h5>
        <hr>
        <p>
          <i class="fa fa-map-marker" aria-hidden="true"></i> Kritik, saran, dan tawaran kerja sama atau kolaborasi bisa dikirimkan ke alamat kontak dibawah <br>
          
          <i class="fab fa-whatsapp"></i> +62811-5986-878
        </p>
      </div>
    </div>
  </div>
  <div class="container-fluid bg-dark">
    <div class="row p-3">
      <div class="text-center text-white font-weight-bold">
        Copyright © 2020 SMK INDONESIA. All rights reserved.
      </div>
    </div>
  </div>
</footer>

<!-- Bootstrap JS -->
<script src="{{ url('') }}/assets/frontend/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('') }}/assets/frontend/plugins/jquery/jquery-3.5.1.min.js"></script>
<script src="{{ url('') }}/assets/frontend/js/jquery-migrate.min.js"></script>
<script src="{{ url('') }}/assets/frontend/js/jquery-ui.min.js"></script>
<script src="{{ url('') }}/assets/frontend/js/modernizr.min.js"></script>

<!-- Particles JS -->
<script src="{{ url('') }}/assets/frontend/js/particles.min.js"></script>
<script src="{{ url('') }}/assets/frontend/js/particle-active.js"></script>
<!-- Select2 -->
<script src="{{ url('') }}/assets/frontend/plugins/select2/js/select2.full.min.js"></script>
<script src="{{ url('') }}/assets/frontend/js/theme-plugins.js"></script>
<script src="{{ url('') }}/assets/frontend/js/main.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  });
</script>

</body>
</html>