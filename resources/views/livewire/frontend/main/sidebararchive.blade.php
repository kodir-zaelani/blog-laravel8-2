<div>
    <!-- Blog Archives -->
    <div class="blog-sidebar">
        <div class="card single-sidebar categorys">
        <div class="card-body">
            <h2><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-archive-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z"/>
              </svg> Asip</h2>
            <div class="faqs-main">
                <!-- Faqs Area -->
                <div class="faq-area">
                    <div id="accordion-one"  role="tablist">
                        @foreach ($postyear as $item)
                        <!-- Single Faq -->
                        <div class="single-faq active">
                            <div class="faq-heading" role="tab" id="faq1">
                              <h4 class="faq-title">
                                <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-shopping-basket"></i>{{ $item->year }} judul</a>
                              </h4>
                            </div>
                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="faq1" data-parent="#accordion-one">
                              <div class="faq-body">
                                <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid</p>
                              </div>
                            </div>
                        </div>
                        <!--/ End Single Faq -->
                        @endforeach
                    </div>
                </div>
                <!--/ End Faqs Area -->
            </div> 
            
            <ul>
                @foreach ($global_archives as $archive)
                <li>
                    {{-- <a href="{{ route('post.archive', ['month' => $archive->month, 'year' => $archive->year]) }}"">{{ month_name($archive->month)  }}</a> --}}
                    <a href="{{ route('post.archive', ['month' => $archive->month, 'year' => $archive->year]) }}"">{{ month_name($archive->month) . " " . $archive->year }}</a>
                    <span class="badge pull-right">{{ $archive->post_count }}</span>
                </li>
                @endforeach			
            </ul>
        </div>
    </div>
    <!--/ End Blog Archives -->
</div>
