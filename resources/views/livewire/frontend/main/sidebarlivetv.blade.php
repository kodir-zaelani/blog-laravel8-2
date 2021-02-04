<div>
    <div class="row mb-3">
        <div class="col-12">
            <!-- live tv -->
            <div class="card card-primary" >
                <div class="card-header" >
                  <h4><i class="fab fa-youtube"></i> Spansa One TV</h4>
                </div>
                <div class="card-body text-center">
                  @foreach ($livetvs as $item)
                  <div class="embed-responsive embed-responsive-16by9 embed-responsive-item">
                    <iframe width="853" height="480" src="{{ $item->embed_video }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  </div>
                  @endforeach
                  <br>
                  <a href="https://www.youtube.com/channel/UC-LYhH7vIyx6wovJt1_lQ8Q" target="_blank" class="btn btn-primary">Tampilkan lebih banyak</a>
                </div>
              </div>
              <!-- live tv -->
        </div>
    </div>
</div>
