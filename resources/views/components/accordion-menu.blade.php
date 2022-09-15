<div class="accordion border border-1" id="accordionExample">
    @foreach ($menus as $menu)
        <x-accordion-menu-item :menu="$menu"/>
    @endforeach
</div>
