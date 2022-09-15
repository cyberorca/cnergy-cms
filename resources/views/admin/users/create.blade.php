@extends('layout.app')

@section('css')
@endsection

@section('body')
<x-page-heading title="Table User" subtitle="View and Manage User Data" />
    <section class="section">
    <div class="card col-md-7">
            <div class="card-header"><span class="h4">Add User</span></div>
            <div class="card-body d-flex flex-column gap-2">
            <form action="{{ route('users.store') }}" method="post" id="basicform" data-parsley-validate="">
                    @csrf  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="basicInput">Name</label>
                            <input type="text" class="form-control" id="name" required="" placeholder="Enter Name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Email</label>
                            <input type="email" class="form-control" id="email" required="" placeholder="Enter Email" name="email" >
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Password</label>
                            <input type="password" class="form-control" id="password" required="" placeholder="Enter Password" name="password" >
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Role</label>
                            <select class="form-control" id="input-select" name="role" required>
                                <option value="">Choose Role</option>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->role }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <a href="{{route('users.index')}}" class="btn btn-secondary">Back</a>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection