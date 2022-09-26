@extends('layout.app')

@section('css')
@endsection

@section('body')
    <x-page-heading title="Table Role" subtitle="View and Manage Role Data" />
    @if ($method === 'edit')
        <form action="{{ route('role.update', $role->id) }}" method="post">
        @else
            <form action="{{ route('role.store') }}" method="post">
    @endif
    <section id="basic-vertical-layouts">
        @csrf
        <div class="row match-height">
            <div class="col-6 ">
                <div class="card">
                    <div class="card-header"><span class="h4 text-capitalize">{{ $method }} Role</span></div>
                    <div class="card-body d-flex flex-column gap-2">
                        @if ($method === 'edit')
                            @method('PUT')
                            @csrf
                        @endif
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput" class="mb-2">Role Name</label>
                                <input type="text" class="form-control" id="basicInput" name="role"
                                    placeholder="Enter Role Name "
                                    @if ($method === 'edit') value="{{ $role->role }}" @endif />
                            </div>
                            <div class="d-flex justify-content-end gap-3 mt-3">
                                <a href="{{ route('role.index') }}" class="btn btn-light" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Back to Table Rome">Back</a>
                                <button class="btn btn-primary" type="submit" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Create Role">Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <span class="h4">Assign</span>
                    </div>
                    <div class="card-body d-flex flex-column gap-2">
                        <ul class="list-unstyled mb-0">
                            <li class=" me-2 mb-1">
                                <div class="form-check">
                                    @foreach ($menus as $menu)
                                        <!-- list groups simple & disabled start -->
                                        <div class="col-lg-12">
                                            <div class="accordion">
                                                <p class="w-100 accordion-item">
                                                <div class="custom-control custom-checkbox d-flex align-items-center">
                                                    <input type="checkbox"
                                                        class="parentCheckBox{{ $menu->id }} form-check-input form-check-success"
                                                        name="checkMenuChild[{{ $menu->id }}][{{ null }}]"
                                                        value="{{ $menu->id }}"
                                                        @if ($method === 'edit') @if ($menu->roles()->find($role->id)) checked @endif
                                                        @endif>
                                                    &nbsp;
                                                    <label class="form-check-label" for="customColorCheck3"></label>
                                                    <a data-bs-toggle="collapse" class="accordion-button"
                                                        href="#multiCollapseExample{{ $menu->id }}"
                                                        aria-expanded="false">
                                                        {{ $menu->menu_name() }}
                                                    </a>
                                                </div>
                                                </p>
                                                <div class=" collapse multi-collapse"
                                                    id="multiCollapseExample{{ $menu->id }}">
                                                    @if ($menu->childs() !== null)
                                                        @foreach ($menu->childs() as $item)
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox"
                                                                    class="childCheckBox{{ $item->id }} ms-1 form-check-input form-check-success"
                                                                    name="checkMenuChild[{{ $menu->id }}][{{ $item->id }}]"
                                                                    value="{{ $item->id }}"
                                                                    @if ($method === 'edit')
                                                                        @if ($item->roles()->find($role->id)) checked @endif
                                                                    @endif
                                                                id="customColorCheck2">
                                                                <label class="form-check-label"
                                                                    for="customColorCheck2">{{ $item->menu_name() }}</label>
                                                            </div>
                                                            <script>
                                                                $(".parentCheckBox{{ $menu->id }}").click(
                                                                    function() {
                                                                        let getParent = document.querySelector(".parentCheckBox{{ $menu->id }}")
                                                                        let getChild = document.querySelector(".childCheckBox{{ $item->id }} ")
                                                                        if (getParent.checked == true) {
                                                                            getChild.checked = true
                                                                        } else {
                                                                            getChild.checked = false
                                                                        }
                                                                    }
                                                                )
                                                            </script>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- list groups simple & disabled end -->
                                    @endforeach
                                </div>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </section>

    </form>
@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
