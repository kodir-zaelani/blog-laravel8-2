<div>
    
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>
    </nav>
                
    {{-- <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark nav-custom">
    <div class="container">
        <a class="navbar-brand" href="/">{!! $global_settings->title !!}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto mb-2 mb-md-0">
            @if ($public_menu)
            @foreach ($public_menu as $menu)
            <li class="nav-item @if ($menu['child']) dropdown @endif">
                @if ($menu['child'])
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                    {{ strtoupper($menu['label']) }}
                    @else
                    <li class="nav-item">
                        <a href="{{ $menu['link'] }}" class="nav-link">
                            {{ strtoupper($menu['label']) }}
                            @endif
                            
                        </a>
                        @if ($menu['child'])
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach( $menu['child'] as $child )
                            <li>
                                <a href="{{ $child['link'] }}" class="dropdown-item">{{ strtoupper($child['label']) }}</a></li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                        @endif
                    </ul>
                    <div class="d-flex">
                        <div class="title-info-class font-weight-bold " style="font-size: 16px; ">
                            KELAS ONLINE <sup class="new"
                            style="margin-left:3px;background: #e23337;color: #fff;font-size: 9px;top: -10px;padding: 3px;-webkit-border-radius: 2px;-moz-border-radius: 2px;-ms-border-radius: 2px;-o-border-radius: 2px;border-radius: 2px;">BETA</sup>
                        </div>
                        <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#searchModal">
                            <i class="fa fa-search" style="color: white"></i>
                        </button>
                        <a href="#" data-toggle="modal" data-target="#register_online" class="btn btn-sm btn-success">Register Online</a>
                    </div>
                </div>
                
            </div>
        </nav> --}}
        <!-- Modal -->
        {{-- modal search --}}
        
        @push('scripts')
        <script>
            // class menu active
            $(document).ready(function(){
                $('ul li a').click(function(){
                    $('li a').removeClass("active");
                    $(this).addClass("active");
                });
            });
            
            // date
            var tw = new Date();
            if (tw.getTimezoneOffset() == 0) (a=tw.getTime() + ( 7 *60*60*1000))
            else (a=tw.getTime());
            tw.setTime(a);
            var tahun= tw.getFullYear ();
            var hari= tw.getDay ();
            var bulan= tw.getMonth ();
            var tanggal= tw.getDate ();
            var hariarray=new Array("Minggu,","Senin,","Selasa,","Rabu,","Kamis,","Jum'at,","Sabtu,");
            var bulanarray=new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
            document.getElementById("date").innerHTML = hariarray[hari]+" "+tanggal+" "+bulanarray[bulan]+" "+tahun;
            
            // Clock
            function showTime() {
                var a_p = "";
                var today = new Date();
                var curr_hour = today.getHours();
                var curr_minute = today.getMinutes();
                var curr_second = today.getSeconds();
                if (curr_hour < 12) {
                    a_p = "AM";
                } else {
                    a_p = "PM";
                }
                if (curr_hour == 0) {
                    curr_hour = 12;
                }
                if (curr_hour > 12) {
                    curr_hour = curr_hour - 12;
                }
                curr_hour = checkTime(curr_hour);
                curr_minute = checkTime(curr_minute);
                curr_second = checkTime(curr_second);
                document.getElementById('clock').innerHTML=curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
            }
            
            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }
            setInterval(showTime, 500);
            
        </script>
        @endpush
    </div>