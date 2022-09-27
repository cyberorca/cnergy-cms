<li class="sidebar-item  @if ($item->childs()) has-sub @endif">
    <a href="#" class='sidebar-link'>
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
