
<li
    class="sidebar-item
        @if ($item['children']) has-sub @endif" data-parent-sidebar="{{ $item['parent_id'] }}" data-id-sidebar="{{ $item['id'] }}" >
    <a href="{{ url($item['slug']) }}" class='sidebar-link'>
        <i class="bi bi-stack"></i>
        <span>{{ $item['menu_name'] }}</span>
    </a>
    @if ($item['children'])
        <ul class="submenu 
    ">
            @foreach ($item['children'] as $sidebar_child)
                <x-sidebar-sub-menu :item="$sidebar_child" />
            @endforeach
        </ul>
    @endif
</li>
