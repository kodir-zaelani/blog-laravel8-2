<div>
    <!-- slider section -->
<div id="myCarousel" class="carousel slide pt-5" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($herosliders as $keys => $slider)
            <li data-target="#myCarousel" data-slide-to="{{ $keys }}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach ($herosliders as $key => $slider)

        <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
            
            <img src="{{ asset($slider->imageUrl)}}"
            class="w-100">
            
        </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- slider section -->
</div>
