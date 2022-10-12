<div>
    @foreach ($accordion as $item)
        <x-checkbox-menu-item :item="$item" />
    @endforeach
</div>
