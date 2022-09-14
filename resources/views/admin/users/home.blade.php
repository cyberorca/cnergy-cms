@extends('layout.app')

@section('body')
    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{route('users.create')}}" class="btn btn-primary">
                    <i data-feather="plus"></i>Add User
                </a>
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
                                <a href="#" class="btn icon btn-primary"><i class="bi bi-pencil"></i></a>
                                <a href="users" class="btn icon btn-danger"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
    <!-- Basic Tables end -->
    @endsection