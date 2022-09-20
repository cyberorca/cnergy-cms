@extends('layout.app')

@section('body')
<x-page-heading title="Table Category" subtitle="View and Manage Category Data" />
    <section class="section">
        <div class="card ">
            <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">Category Search</span></div>
            <div class="card-body">
                <form class="row g-3" method="GET">
                    <div class="col-md-4">
                        <label for="inputCategory" class="form-label">Category</label>
                        <input name="inputCategory" id="category" placeholder="Category" type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="inputSlug" class="form-label">Slug</label>
                        <input name="inputSlug" id="slug" placeholder="Slug" type="text" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label for="inputState" class="form-label">Status</label>
                        <select name="status" id="inputState" class="form-select">
                            <option value="" selected>All</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i>&nbsp;&nbsp;&nbsp;Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">Category List</span>
                <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp;Add
                    Category</a>
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $c)
                        <tr>
                            <td>{{ $c->category }}</td>
                            @if ($c->is_active == 1)
                            <td> <span class="badge bg-success">Active</span></td>
                            @else
                            <td> <span class="badge bg-danger">Inactive</span></td>
                            @endif
                            <td>{{ $c->types }}</td>
                            <td>{{ $c->slug }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $c->id) }}" class="btn icon btn-warning"><i class="bi bi-pencil-square"></i></a>
                                <button type="button" data-toggle="modal" data-target="#deleteModal{{ $c->id }}" class="btn icon btn-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <div class="modal fade" id="deleteModal{{ $c->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Delete Category "{{ $c->category }}" ?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('categories.destroy', $c->id) }}"
                                                        method="post">
                                                        {{ method_field('delete') }}
                                                        @csrf
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel
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
                <div  class="d-flex">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- Basic Tables end --> 
    <script src="assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    @endsection