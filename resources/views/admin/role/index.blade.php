@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{asset("assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/css/pages/datatables.css")}}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/menu.css')}}">
@endsection

@section('body')
    <x-page-heading title="All Role's" subtitle="Manage backend role"/>

    {{--  Alert Start  --}}
    @if (session('status'))
        <div class="alert alert-success alert-dismissible show fade">
            <strong>{{ session('status') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible show fade">
            <strong>{{ $error }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach

    {{--  Alert End  --}}

    <!-- Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">Role List</span>
                <!-- Button trigger for add modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#add">
                    <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp;Add
                    Role
                </button>

            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $no++}}</td>
                            <td>{{ $role->role }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#edit{{$role->id}}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
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
                                        <h5 class="modal-title" id="myModalLabel1">Add New Role</h5>
                                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to Delete Role {{ $role->role }}?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('role.destroy', $role->id) }}"
                                              method="post">
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
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Add Modal -->
        <div class="modal fade text-left" id="add" tabindex="-1" role="dialog"
             aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <form action="{{ route('role.store') }}" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">Add New Role</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                    aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="role">Role</label>
                                <input type="text" class="form-control" id="role" name="role" placeholder="Enter role">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Save</span>
                            </button>
                        </div>
                    </form>
                </div>
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
