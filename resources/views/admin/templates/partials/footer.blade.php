<footer class="main-footer">
    <b>V 1.0 | </b>
    <strong>Copyright &copy; 2020 - @php
        echo  date('Y');
    @endphp |  
     @if ($global_settings->website)
     <a href="http://{{ $global_settings->website }}" target="_blank">{{ $global_settings->title }}</a>.</strong>
     All rights reserved.
    @else
        <a href="http://lamankreasi.com" target="_blank">Laman Kreasi</a>.</strong>
        All rights reserved.
        
    @endif
    <div class="float-right d-none d-sm-inline-block">
        <b>Developed : Laman Kreasi</b>
    </div>
</footer>