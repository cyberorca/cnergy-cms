@extends('layout.app')

@section('title', 'Merdeka.Com')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
@endsection


@section('title_page_header', 'Create User')

@section('body')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Update User</h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">User</li>
                        <li class="breadcrumb-item active" aria-current="page">Update</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
    <div class="row">
        <!-- ============================================================== -->
        <!-- basic form -->
        <!-- ============================================================== -->
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Basic Form</h5>
                <div class="card-body">
                    <form action="#" id="basicform" data-parsley-validate="">
                        <div class="form-group">
                            <label for="inputUserName">User Name</label>
                            <input id="inputUserName" type="text" name="name" data-parsley-trigger="change"
                                required="" placeholder="Enter user name" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email address</label>
                            <input id="inputEmail" type="email" name="email" data-parsley-trigger="change"
                                required="" placeholder="Enter email" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Role</label>
                            <select class="form-control" id="input-select" name="role">
                                <option disabled selected>Choose Role</option>
                                <option>Admin</option>
                                <option>Editor</option>
                                <option>Photographer</option>
                                <option>Content Creator</option>
                            </select>
                        </div>
                        <div class="col-sm-12 pl-0 mt-3 pr-0">
                            <p class="text-right">
                                <button type="submit" class="btn btn-space btn-primary m-0">Submit</button>
                                <button class="btn btn-space btn-secondary m-0">Cancel</button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end basic form -->
        <!-- ============================================================== -->

    </div>

@endsection

@section('javascript')
    <script src="{{ asset('assets/vendor/parsley/parsley.js') }}"></script>
    <script>
        $('#form').parsley();
    </script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection
