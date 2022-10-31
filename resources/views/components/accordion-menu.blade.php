{{-- @dump($accordion) --}}
<div class="accordion border border-1" id="accordion-list">
    @foreach ($accordion as $item)
        <x-accordion-menu-item :item="$item"/>
    @endforeach
</div>
