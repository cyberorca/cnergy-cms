<div class="list-group-item accordion" id="accordion-list">
    @foreach ($list as $item)
        @include('components.sortable.sortable-item', ['item' => $item, 'type' => $type ])
    @endforeach
</div>
