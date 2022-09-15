<div class="accordion-item border-top-0 border-end-0 border-bottom-0">
    <h2 class="menu accordion-header" id="heading-{{ $menu->slug() }}-{{ $menu->id}}">
        <div class="px-3 ps-0 py-0 border-0" >
            <div class="d-flex align-items-center w-100 justify-content-between">
                <div class="m-0 w-100 h-100 p-3 menu accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-{{ $menu->slug() }}-{{ $menu->id}}" aria-expanded="false"
                    aria-controls="collapse-{{ $menu->slug() }}-{{ $menu->id}}"><p class="m-0 p-0 ms-3">{{ $menu->menu_name() }}</p></div>
                <div class="d-flex gap-2">
                    <a class="btn btn-primary" href="{{ route('menu.create', $menu->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Add New Child Menu"><i class="bi bi-plus-circle-fill"></i></a>
                    <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-warning"><i
                            class="bi bi-pencil-square"></i></a>
                    <form action="{{ route('menu.destroy', $menu->id) }}" method="post">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete {{ $menu->menu_name() }} Menu ?')" ><i class="bi bi-trash-fill"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </h2>
    @if ($menu->childs() !== null)
        <div id="collapse-{{ $menu->slug() }}-{{ $menu->id}}" class="accordion-collapse collapse"
            aria-labelledby="heading-{{ $menu->slug() }}-{{ $menu->id}}">
            <div class="accordion-body pe-0 py-0 border-0 d-flex flex-column gap-2">
                @foreach ($menu->childs() as $item)
                    <x-accordion-menu-item :menu="$item"/>
                @endforeach
            </div>
        </div>
    @endif
</div>