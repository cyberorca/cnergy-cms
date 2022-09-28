<li class="sidebar-item   @if ($item->count_childs() !== 0) has-sub @endif">
    <a href="{{ url($item->slug()) }}" class='sidebar-link'>
        <i class="bi bi-stack"></i>
        <span>{{ $item->menu_name() }}</span>
    </a>
    @if ($item->childs())
        <ul class="submenu">
            @foreach ($item->childs() as $sidebar_child)
                <x-sidebar-sub-menu :item="$sidebar_child" />
            @endforeach
        </ul>
    @endif
</li>
