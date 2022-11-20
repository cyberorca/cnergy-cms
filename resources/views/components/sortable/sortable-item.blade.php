@php
    $path = 'category';
@endphp
<div class="box-sortable">
    <div class="accordion-item  border-top-0 border-end-0 border-bottom-0 draggable" data-id='{{ $item['id'] }}'
        data-parent="{{ $item['parent_id'] }}" data-name="{{ $item['menu_name'] }}" 
        @if ($path === 'front-end-menu') data-position="{{ $item['position'] }}" @endif
        >
        <h2 class="menu accordion-header" id="heading-{{ $item['slug'] }}-{{ $item['id'] }}">
            <div class="px-3 ps-0 py-0 border-0">
                <div class="d-flex align-items-center w-100 justify-content-between">
                    @php
                        $noChildren = '';
                        if ($item['children'] == null) {
                            $noChildren = 'no-children';
                        }
                    @endphp
                    <div class="m-0 w-100 h-100 p-3 menu accordion-button {{ $noChildren }}" type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapse-{{ implode('-', explode('/', $item['slug'])) }}{{ $item['id'] }}"
                        aria-expanded="false"
                        aria-controls="collapse-{{ implode('-', explode('/', $item['slug'])) }}{{ $item['id'] }}">
                        <p class="m-0 p-0 ms-3 front-end-name">{!! $item['menu_name'] !!}
                            {{-- {{ isset($item['parents']) ? implode(',', $item['parents']) : 'null' }} --}}
                        </p>
                    </div>
                    <div class="d-flex gap-2">
                        <a class="btn btn-primary ms-3"
                            href="{{ route($path . '.create', [
                                'parents' => isset($item['parents']) ? implode(',', $item['parents']) : 'null',
                                'id' => $item['id'],
                            ]) }}"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Add New Child Menu"><i
                                class="bi bi-plus-circle"></i></a>
                        <a href="{{ route($path . '.edit', $item['id']) }}" class="btn btn-warning"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Menu"><i
                                class="bi bi-pencil-square"></i></a>
                        <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#delete{{ $item['id'] }}" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Delete Menu"><i class="bi bi-trash-fill"></i></a>
                        <div class="modal fade text-left" id="delete{{ $item['id'] }}" tabindex="-1" role="dialog"
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
                                        <p class="" style="font-size: 15px"> Are you sure you want to delete role
                                            <strong class="text-danger">{{ $item['menu_name'] }}</strong>?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route($path . '.destroy', $item['id']) }}" method="post">
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
        @if ($item['children'] !== null)
            <div id="collapse-{{ implode('-', explode('/', $item['slug'])) }}{{ $item['id'] }}"
                class="accordion-collapse collapse show"
                aria-labelledby="heading-{{ $item['slug'] }}-{{ $item['id'] }}">
                <div class="accordion-body pe-0 py-0 border-0 d-flex flex-column nested" data-id='{{ $item['id'] }}'>
                    @foreach ($item['children'] as $child)
                        @include('components.sortable.sortable-item', ['item' => $child])
                    @endforeach
                </div>
            </div>
        @else
            <div id="collapse-{{ implode('-', explode('/', $item['slug'])) }}{{ $item['id'] }}"
                class="accordion-collapse collapse show"
                aria-labelledby="heading-{{ $item['slug'] }}-{{ $item['id'] }}">
                <div class="accordion-body pe-0 py-0 py-5 border-0 d-flex flex-column nested">
                </div>
            </div>
        @endif
    </div>
</div>
