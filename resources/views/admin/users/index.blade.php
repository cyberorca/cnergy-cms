@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/menu.css') }}" />
@endsection

@section('body')
<x-page-heading title="Table User" subtitle="View and Manage User Data" />
    <section class="section"> 
    <div class="card ">
            <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">User Search</span></div>
            <div class="card-body">
                <form class="row g-3" method="GET">
                    <div class="col-md-4">
                        <label for="inputCategory" class="form-label">Email</label>
                        <input name="inputCategory" id="category" placeholder="Email" type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="inputSlug" class="form-label">Name</label>
                        <input name="inputSlug" id="slug" placeholder="Name" type="text" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Role</label>
                                <select name="role" class="form-select">
                                    <option value="" selected>Role</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                    @endforeach
                                </select>
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
                            <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="User Search"><i class="bi bi-search"></i>&nbsp;&nbsp;&nbsp;Search</button>
                            <a href="{{route('users.index')}}" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Show All Users Data"><i class="bi bi-card-list"></i>&nbsp;&nbsp;&nbsp;Show All</a>
                    </div>
                    
                </form>
            </div>
        </div>




        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">Users List</span>
                <a href="{{ route('users.create') }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Add User"><i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp;Add
                    User</a>
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Last Login</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $u)
                        <tr>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->roles->role }}</td>
                            <td>{{ $u->last_logged_in }}</td>
                            @if ($u->is_active == 1)
                            <td> <span class="badge bg-success">Active</span> </td>
                            @else
                            <td> <span class="badge bg-danger">Inactive</span> </td>
                            @endif
                            <td>
                                <a href="{{ route('users.edit', $u->uuid) }}" class="btn icon btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Update User Data"><i class="bi bi-pencil-square"></i></a>
                                <button type="button" data-toggle="modal" data-target="#deleteModal{{ $u->uuid }}" class="btn icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete User Data"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <div class="modal fade" id="deleteModal{{ $u->uuid }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Delete User "{{ $u->name }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('users.destroy', $u->uuid) }}"
                                                        method="post">
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