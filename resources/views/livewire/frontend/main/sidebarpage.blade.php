<div>
    <!-- Blog Category -->
    @if ($pageprofile->count()>0)
    <div class="row">
        <div class="col-12">
            <div class="card card-primary mb-3" >
                <div class="card-header" >
                  <h4><i class="fa fa-folder" aria-hidden="true"></i> PROFIL</h4>
                </div>
                <div class="card-body categorys">
                  <div class="list-group">
        
                    @foreach ($pageprofile as $page)
                         <a href="{{ route('page.show', $page->slug) }}" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded"><i class="fa fa-folder" aria-hidden="true"></i> 
                            {{ $page->title }}
                        </a>
                    @endforeach
                  </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if ($pagesarpras->count()>0)
    <div class="row">
        <div class="col-12">
            <div class="card card-primary mb-3" >
                <div class="card-header" >
                  <h4><i class="fa fa-folder" aria-hidden="true"></i> PROFIL</h4>
                </div>
                <div class="card-body categorys">
                  <div class="list-group">
        
                    @foreach ($pageprofile as $page)
                       
                         <a href="{{ route('page.show', $page->slug) }}" class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded"><i class="fa fa-folder" aria-hidden="true"></i> 
                            {{ $page->title }}
                        </a>
                    @endforeach
                  </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!--/ End Blog Category -->
</div>
