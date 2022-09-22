<div class="accordion border border-1" id="accordionExample">
    @foreach ($accordion as $item)
        <x-accordion-menu-item :item="$item"/>
    @endforeach
</div>
