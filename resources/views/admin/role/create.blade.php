@extends('layout.app')

@section('css')
@endsection

@section('body') 
<x-page-heading title="Table Role" subtitle="View and Manage Role Data"/>
    <section class="section">
        <div class="card col-md-7">
            <div class="card-header"><span class="h4">Add Role</span></div>
            <div class="card-body d-flex flex-column gap-2">
                <form action="{{ route('role.store') }}" method="post">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="basicInput" class="mb-2">Role Name</label>
                            <input type="text" class="form-control" id="basicInput" name="role"
                                   placeholder="Enter Role Name " />
                        </div>
                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <a href="{{route('role.index')}}" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Back to Table Rome">Back</a>
                            <button class="btn btn-primary" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Create Role">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
@endsection
