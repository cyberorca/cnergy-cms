<li class="submenu-item @if ($item->childs()) sidebar-item has-sub @endif">
    <a 
    @if ($item->childs()) 
        class="sidebar-link"
        href="#" 
    @else # 
        href="{{ route('menu.index') }}" 
        class=""
    @endif
        >{{ $item->menu_name() }}</a>
    @if ($item->childs())
        <ul class="submenu">
            @foreach ($item->childs() as $sidebar_child)
                <x-sidebar-sub-menu :item="$sidebar_child" />
            @endforeach
        </ul>
    @endif
</li>
