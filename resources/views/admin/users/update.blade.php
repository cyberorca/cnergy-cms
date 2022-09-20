@extends('layout.app')

@section('body')
<x-page-heading title="Table User" subtitle="View and Manage User Data" />
    <section class="section">
    <div class="card col-md-7">
            <div class="card-header"><span class="h4">Update User</span></div>
            <div class="card-body d-flex flex-column gap-2">
                <form action="{{route('users.update',$post->uuid)}}" method="post">
                    @method("PUT")
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="basicInput">Name</label>
                            <input type="text" class="form-control" id="name" required="" placeholder="Enter Name" value="{{$post->name}}" name="name">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Email</label>
                            <input type="email" class="form-control" id="email" required="" placeholder="Enter Email" value="{{$post->email}}" name="email" >
                        </div>
                        <div class="form-group">
                                <label for="basicInput">Role</label>
                                <select class="form-control" id="input-select" name="role" required>
                                    @foreach ($roles as $role)
                                    @if ($role->role == $post->roles->role)
                                    <option  selected="selected" value="{{ $role->id }}">{{ $role->role }}</option>
                                    @else
                                    <option value="{{ $role->id }}">{{ $role->role }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Status</label>
                                <div class="form-group">
                                    @if ($post->is_active == 1)
                                    <input class="form-check-input" type="radio" name="is_active" value="1" id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        On 
                                    </label>
                                    <input class="form-check-input" type="radio" name="is_active" value="0" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Off
                                    </label>
                                    @else
                                    <input class="form-check-input" type="radio" name="is_active" value="1" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        On 
                                    </label>
                                    <input class="form-check-input" type="radio" name="is_active" value="0" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Off
                                    </label>
                                    @endif
                                </div>
                            </div>
                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <a href="{{route('users.index')}}" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Back to Table User">Back</a>
                            <button class="btn btn-primary" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Update User Data">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection