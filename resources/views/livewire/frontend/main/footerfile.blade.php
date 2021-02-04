<div>
    <footer class="footer">
        <div class="container-fluid" style="background: rgb(255, 255, 255);">
            <div class="row p-4">
                <div class="col-md-4 mb-4">
                    <h5 class="font-weight-bold">KATEGORI</h5>
                    <hr>
                    <div class="single-widget links">
                        <ul class="list" style="list-style: none">
                            @livewire('frontend.main.footermenu')
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="font-weight-bold">POPULER</h5>
                    <hr>
                    <div class="single-widget posts">
                        <ul>
                            @foreach ($global_latestFooter as $post)
                            <li>
                                @if ($post->ImageThumbUrl)
                                <a href="{{ route('post.show', $post) }}"><img src="{{ $post->ImageThumbUrl }}" alt="{{ $post->title }}" ></a>   
                                @else
                                <a href="{{ route('post.show', $post) }}"><img src="{{ url('') }}/assets/help/img/edu5.jpeg" alt="{{ $post->title }}" 
                                    ></a>
                                    @endif
                                    
                                    <a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 ">
                        <h5 class="font-weight-bold">KONTAK</h5>
                        <hr>
                        <div class="text-left">
                            <p>
                                Kritik, saran, dan tawaran kerja sama atau kolaborasi bisa dikirimkan ke alamat kontak dibawah
                            </p>
                            <p>
                                <a href="https://api.whatsapp.com/send?phone=6208115986878&text=Assalamualaikum" target="_blank"> 
                                    <i class="fab fa-whatsapp"></i> 
                                    @if ($global_settings->whatapss)
                                    {{ $global_settings->whatapss }}
                                    @else
                                    08115986878
                                    @endif
                                </a>
                            </p>
                            <p>
                                <a href="mailto:com.{{ $global_settings->email }}"> 
                                    <i class="fa fa-envelope"></i> 
                                    @if ($global_settings->email)
                                    {{ $global_settings->email }}
                                    @else
                                    laman.kreasi@gmail.com
                                    @endif
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid bg-dark">
                <div class="row p-3">
                    <div class="text-center text-white font-weight-bold">
                        © 2020 - @php echo  date('Y'); @endphp | {{ $global_settings->website }} 
                    </div>
                </div>
            </div>
        </footer>
    </div>
    