@extends('layout.app')

@section('body')

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add User</h4>
            </div>
            <form action="{{ route('users.store') }}" method="post" id="basicform" data-parsley-validate="">
                <div class="card-body">
                @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Name</label>
                                <input type="text" class="form-control" id="name" required="" placeholder="Enter Name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Email</label>
                                <input type="email" class="form-control" id="email" required="" placeholder="Enter Email" name="email" >
                            </div>
                        </div>
                        <div class="col-md-6">
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
                        </div>
                        <div class="form-group">
                            <a href="{{route('users.index')}}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection