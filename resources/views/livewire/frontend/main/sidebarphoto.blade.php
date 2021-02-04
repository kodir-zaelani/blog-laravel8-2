<div>
    <!-- Photo Gallery -->
    <div class="card card-primary mb-3" >
        <div class="card-body">
          <h4 class="font-weight-bold"><i class="fa fa-image" aria-hidden="true"></i> PHOTO</h4>
          <hr>
          <div class="photo">
            <ul style="list-style: none">
                @foreach ($photos as $photo)
                <li>
                    <a href="{{ $photo->ImageUrl }}" data-fancybox="photo" data-caption="{{ $photo->title }}">
                        <img src="{{ $photo->ImageThumbUrl }}" alt="#">
                    </a>
                </li>			
                @endforeach	
            </ul>
          </div>
        </div>
      </div>
      <!-- Photo Galery -->
</div>
