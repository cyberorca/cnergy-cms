<li class="submenu-item @if ($item->count_childs() !== 0) sidebar-item has-sub @endif">
    <a
        @if ($item->childs()) class="sidebar-link"
        href="{{ url($item->slug()) }}" 
    @else
        href="{{ url($item->slug()) }}" @endif>{{ $item->menu_name() }}</a>
    @if ($item->childs())
        <ul class="submenu">
            @foreach ($item->childs() as $sidebar_child)
                <x-sidebar-sub-menu :item="$sidebar_child" />
            @endforeach
        </ul>
    @endif
</li>
