<div>
    @if ($footer_menu)
        @foreach ($footer_menu as $menu)
        <li>
            <a href="{{ $menu['link'] }}"><i class="fa fa-caret-right"></i>{{ strtoupper($menu['label']) }}</a>
        </li>
        @endforeach
    @endif
</div>
