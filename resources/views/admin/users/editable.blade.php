@extends('layout.app')

@section('css')
@endsection

@section('body')
    <x-page-heading title="Table User" subtitle="View and Manage User Data" />
    <section class="section">
        <div class="card col-md-7">
            <div class="card-header"><span class="h4 text-capitalize">{{ $method }} User</span></div>
            <div class="card-body d-flex flex-column gap-2">
                @if ($method === 'edit')
                    <form action="{{ route('users.update', $post->uuid) }}" method="post">
                        @method('PUT')
                    @else
                        <form action="{{ route('users.store') }}" method="post" id="basicform" data-parsley-validate="">
                @endif
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="basicInput">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name"
                            @if ($method === 'edit') value="{{ $post->name }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email"
                            @if ($method === 'edit') value="{{ $post->email }}" @endif>
                    </div>
                    <div class="form-group">
                        <label for="basicInput">Role</label>
                        <select class="form-control" id="input-select" name="role">
                            <option value="">Choose Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"
                                    @if ($method === 'edit') @if ($role->id === $post->roles->id)
                                            selected @endif
                                    @endif
                                    >{{ $role->role }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($method === 'edit')
                        <div class="form-group">
                            <label for="basicInput">Status</label>
                            <div class="form-group">
                                <input class="form-check-input" type="radio" name="is_active"
                                    @if ($post->is_active == 1) checked @endif  value="1">
                                <label class="form-check-label">
                                    On
                                </label>
                                <input class="form-check-input" type="radio" name="is_active"
                                    @if ($post->is_active == 0) checked @endif value="0">
                                <label class="form-check-label">
                                    Off
                                </label>
                            </div>
                        </div>
                    @endif
                    <div class="d-flex justify-content-end gap-3 mt-3">
                        <a href="{{ route('users.index') }}" class="btn btn-light" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Back to Table User">Back</a>
                        <button class="btn btn-primary" type="submit" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Create User Data">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection