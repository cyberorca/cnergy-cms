@extends('layout.app')

@section('css')
@endsection

@section('body')
    <x-page-heading title="Table Tag" subtitle="View and Manage Tag Data" />
    <section class="section">
        <div class="card col-md-7">
            <div class="card-header"><span class="h4 text-capitalize">{{ $method }} Tag</span></div>
            <div class="card-body d-flex flex-column gap-2">
                @if ($method === 'edit')
                    <form action="{{ route('tag-management.update', $tag->id) }}" method="post">
                        @method('PUT')
                    @else
                        <form action="{{ route('tag-management.store') }}" method="POST">
                @endif
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="basicInput">Tag Name</label>
                        <input type="text" class="form-control" id="tags" placeholder="Enter Tag Name"
                            name="tag" @if ($method === 'edit') value="{{ $tag->tags }}" @endif>
                    </div>
                    @if ($method === 'edit')
                        <div class="form-group">
                            <label for="basicInput">Status</label>
                            <div class="form-group">
                                <input class="form-check-input" type="radio" name="is_active"
                                    @if ($tag->is_active == 1) checked @endif  value="1">
                                <label class="form-check-label">
                                    On
                                </label>
                                <input class="form-check-input" type="radio" name="is_active"
                                    @if ($tag->is_active == 0) checked @endif value="0">
                                <label class="form-check-label">
                                    Off
                                </label>
                            </div>
                        </div>
                    @endif
                    <div class="d-flex justify-content-end gap-3 mt-3">
                        <a href="{{ route('tag-management.index') }}" class="btn btn-light" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Back to Table Tag">Back</a>
                        <button class="btn btn-primary" type="submit" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Create Tag Data">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection
