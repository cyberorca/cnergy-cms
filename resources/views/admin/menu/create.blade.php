@extends('layout.app')

@section('css')
@endsection

@section('body')
    <x-page-heading title="Menu Config" subtitle="Manage backend menu for user" />
    <section class="section">
        <div class="card col-md-7">
            <div class="card-header"><span class="h4">Add Menu</span></div>
            <div class="card-body d-flex flex-column gap-2">
                <form action="{{ route('menu.store') }}" method="post">
                    @csrf  
                    <div class="col-md-12">
                        @if ($parent)
                            <input type="hidden" name="parent_id" value="{{ $parent->id }}">
                            <label for="basicInput" class="mb-2 fw-bold">Parent Menu : {{ $parent->menu_name }}</label>
                        @endif
                        <div class="form-group">
                            <label for="basicInput" class="mb-2">Menu Name</label>
                            <input type="text" class="form-control @error('menu_name') is-invalid @enderror"
                                id="basicInput" name="menu_name" placeholder="Enter menu name" />
                            @error('menu_name')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="basicInput" class="mb-2">Menu URL</label>
                            <input type="text" class="form-control" id="basicInput" name="url"
                                placeholder="Enter menu url" />
                        </div>
                        <div class="form-group">
                            <label for="basicInput" class="mb-2">Menu Icon</label>
                            <input type="text" class="form-control" id="basicInput" name="icon"
                                placeholder="Enter menu icon" />
                        </div>
                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <a href="{{route('menu.index')}}" class="btn btn-secondary">Back</a>
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
