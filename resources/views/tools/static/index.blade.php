@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/pages/menu.css') }}">
@endsection

@section('body')
    <x-page-heading title="Static Page" subtitle="View and Manage Static Page" />

    <section class="section">
        <div class="card ">
            <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">Static Page Search</span>
            </div>
            <div class="card-body">
                <form class="row g-3" method="GET">
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Created Date</label>
                        <div class="input-group">
                            <input type="date" class="form-control" name="startDate">
                            &nbsp;&nbsp;&nbsp;<p>To</p>&nbsp;&nbsp;&nbsp;
                            <input type="date" class="form-control" name="endDate">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="inputTitle" class="form-label">Title</label>
                        <input name="inputTitle" id="Title" placeholder="Title" type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="inputSlug" class="form-label">Slug</label>
                        <input name="inputSlug" id="slug" placeholder="Slug" type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Status</label>
                        <select name="status" id="inputState" class="form-select">
                            <option value="" selected>All</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end gap-3 mt-3">
                        <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Tag Search"><i class="bi bi-search"></i>&nbsp;&nbsp;&nbsp;Search</button>
                        <a href="{{ route('static-page.index') }}" class="btn btn-light" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Show All Tags Data"><i
                                class="bi bi-card-list"></i>&nbsp;&nbsp;&nbsp;Show All</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- Basic Tables start -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">Page List</span>
                <a href="{{ route('static-page.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Add Tag"></i>&nbsp;&nbsp;&nbsp;Add
                    Page</a>
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Creator</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($static_page as $s)
                            <tr>
                                <td>{{ $s->title }}</td>
                                <td>{{ $s->slug }}</td>
                                <td>{{ $s->users->name }}</td>
                                <td>{{ $s->created_at }}</td>
                                @if ($s->is_active == 1)
                                    <td> <span class="badge bg-success"><i
                                                class="bi bi-check fs-5"></i></span>
                                    </td>
                                @else
                                    <td> <span class="badge bg-danger"><i class="bi bi-x fs-5"></i></span>
                                    </td>
                                @endif

                                <td>
                                    <a href="{{ route($type . '.edit', $s->id) }}" class="btn icon btn-warning"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Update Static Page Data"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <button type="button" data-toggle="modal" data-target="#deleteModal{{ $s->id }}"
                                        class="btn icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Delete User Data"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <div class="modal fade" id="deleteModal{{ $s->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Delete Page</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Delete Page "{{ $s->title }}"?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route($type . '.destroy', $s->id) }}" method="post">
                                                {{ method_field('delete') }}
                                                @csrf
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Delete</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex">
                    {{ $static_page->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
@section('javascript')
    <script src="assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
@endsection
