<div>
    <!-- Home Banner -->
    <header class="main-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <div class="row">
                        <div class="col-12">
                            <div class="banner-content">
                                @if ($global_settings->title)
                                    <h2>{!! $global_settings->title !!}</h2>
                                @else
                                <h2>Laman Kreasi Nusantara</h2>
                                @endif
                                @if ($global_settings->tagline)
                                <h4>{!! $global_settings->tagline !!}</h4>
                                @else
                                    <h4>Ayo semangat belajar</h4>
                                @endif 
                                @if ($global_settings->description)
                                    <p>{!! $global_settings->description !!}</p>
                                @else
                                    <p>Melalui website ini semoga dapat menjadi sarana upaya peningkatan kompetensi</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-12">
                    <div class="banner-images">
                        @if ($global_settings->image)
                        <img src="{{ $global_settings->imageUrl }}" style="max-width: 80%">
                        @else
                        <img src="{{ url('') }}/assets/help/img/hero.png" style="max-width: 80%">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
    @if (count($global_adverstisment_hometop))
    <div class="container">
        <div class="row justify-content-center pt-4 d-none d-sm-none d-md-block d-lg-block">
            <div class="col-12 text-center">
                @foreach ($global_adverstisment_hometop as $item)
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
</div>
