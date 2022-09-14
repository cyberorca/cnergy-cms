@extends('layout.app')

@section('body')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add User</h4>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="basicInput">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" >
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label for="basicInput">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" >
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Role</label>
                            <select class="form-control" id="input-select" name="role">
                                <option disabled selected>Choose Role</option>
                                <option>Admin</option>
                                <option>Editor</option>
                                <option>Photographer</option>
                                <option>Content Creator</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- validations end -->
@endsection