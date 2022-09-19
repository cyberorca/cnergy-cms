<div class="accordion-item border-top-0 border-end-0 border-bottom-0">
    <h2 class="menu accordion-header" id="heading-{{ $menu->slug() }}-{{ $menu->id }}">
        <div class="px-3 ps-0 py-0 border-0">
            <div class="d-flex align-items-center w-100 justify-content-between">
                <div class="m-0 w-100 h-100 p-3 menu accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse-{{ $menu->slug() }}-{{ $menu->id }}" aria-expanded="false"
                    aria-controls="collapse-{{ $menu->slug() }}-{{ $menu->id }}">
                    <p class="m-0 p-0 ms-3">{{ $menu->menu_name() }}</p>
                </div>
                <div class="d-flex gap-2">
                    <a class="btn btn-primary ms-3" href="{{ route('menu.create', $menu->id) }}"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Add New Child Menu"><i
                            class="bi bi-plus-circle-fill"></i></a>
                    <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-warning"><i
                            class="bi bi-pencil-square"></i></a>
                    <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $menu->id }}"><i class="bi bi-trash-fill"
                            ></i></a>
                    <div class="modal fade text-left" id="delete{{ $menu->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel1">Delete Menu</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="" style="font-size: 15px"> Are you sure you want to delete role <strong class="text-danger">{{ $menu->menu_name() }}</strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('menu.destroy', $menu->id) }}" method="post">
                                        {{ method_field('delete') }}
                                        @csrf
                                        <button type="button" class="btn" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">No</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Yes</span>
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </h2>
    @if ($menu->childs() !== null)
        <div id="collapse-{{ $menu->slug() }}-{{ $menu->id }}" class="accordion-collapse collapse show"
            aria-labelledby="heading-{{ $menu->slug() }}-{{ $menu->id }}">
            <div class="accordion-body pe-0 py-0 border-0 d-flex flex-column">
                @foreach ($menu->childs() as $item)
                    <x-accordion-menu-item :menu="$item" />
                @endforeach
            </div>
        </div>
    @endif
</div>
