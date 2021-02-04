<div>
    
     <!-- profile section -->
    <section class="main-profil" id="main-profil">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8 col-12">
                    <div class="card h-100 shadow-sm border-0 rounded-lg">
                        <div class="card-body text-center">
                            <div class="profile-content">
                                <iframe
                                style="width:100%; border-top-left-radius:.3rem;border-top-right-radius:.3rem"
                                src="{{ $global_settings->video_profil }}" frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                            <div class="video-link pt-3">
                                <a href="{{ $global_settings->video_profil }}" class="btn btn-primary video-play cbp-lightbox"><i class="fa fa-play"></i> Profil {{ $global_settings->title }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 col-lg-4 col-12 principle">
                <div class="card h-100 shadow-sm border-0 rounded-lg">
                    <div class="card-body text-center ">
                        <div class="principle-title pt-2 pb-2">
                            <h4>KEPALA SEKOLAH</h4>
                        </div>
                        @foreach ($principle as $item)
                            <div class="principle-image">
                                <img src="{{ $item->imageUrl}}" class="img-thumbnail" style="height: 300px">
                            </div>
                            <h3>{{ $item->fullname }}</h3>
                            <a href="{{ route('principle.show',$item->slug) }}" class="btn btn-primary">Profil detail</a>
                        @endforeach
                        </div>
                </div>
                
            </div>
        </div>
    </div>
    </section>
<!-- end profile section -->
</div>
