@extends('layout.app')

@section('css')
@endsection

@section('body')
    <x-page-heading title="Role Config" subtitle="Manage backend role" />
    <section class="section">
        <div class="card col-md-7">
            <div class="card-header"><span class="h4">Add Role</span></div>
            <div class="card-body d-flex flex-column gap-2">
                <form action="{{ route('role.store') }}" method="post">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="basicInput" class="mb-2">Role</label>
                            <input type="text" class="form-control" id="basicInput" name="role"
                                   placeholder="Role's name here" />
                        </div>
                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <a href="{{route('role.index')}}" class="btn btn-secondary">Back</a>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
@endsection
