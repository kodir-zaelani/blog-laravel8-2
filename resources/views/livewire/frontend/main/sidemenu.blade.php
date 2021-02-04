<div>
    <ul class="nav navbar-nav">		
        @if ($side_menu)
            @foreach ($side_menu as $menu)
            <li>
                <a href="{{ $menu['link'] }}">{{ $menu['label'] }}</a>
                <hr>
            </li>
            @endforeach
        @endif	
    </ul>
</div>
