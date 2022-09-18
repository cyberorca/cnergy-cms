@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/menu.css') }}" />
@endsection

@section('body')
    <x-page-heading title="Table Role" subtitle="View and Manage Role Data"/>
    <section class="section">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">Role List</span>
                <a href="{{ route('role.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp;Add
                    Role</a>

            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                    <tr>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->role }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('role.edit', $role->id) }}" class="btn icon btn-warning"><i class="bi bi-pencil-square"></i></a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $role->id }}">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade text-left" id="edit{{$role->id}}" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel1">Add New Role</h5>
                                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <form action="{{ route('role.update', $role->id) }}" method="post">
                                        {{ method_field('patch') }}
                                        <div class="modal-body">
                                            @csrf
                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <input type="text" class="form-control" id="role" name="role"
                                                       placeholder="Enter role">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Close</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Save Change</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade text-left" id="delete{{ $role->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel1">Delete Role</h5>
                                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Delete Role "{{ $role->role }}"?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('role.destroy', $role->id) }}"
                                              method="post">
                                            {{ method_field('delete') }}
                                            @csrf
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Cancel</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                                         
                                                <span class="d-none d-sm-block">Delete</span>
                                            </button>
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
    <!-- Tables end -->

@endsection

@section('javascript')
    <script src="assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="assets/js/pages/datatables.js"></script>
@endsection
