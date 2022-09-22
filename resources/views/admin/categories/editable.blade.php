@extends('layout.app')

@section('css')
@endsection

@section('body')
    <x-page-heading title="Table Category" subtitle="View and Manage Category Data" />
    <section class="section">
        <div class="card col-md-7">
            <div class="card-header"><span class="h4">Add Category</span></div>
            <div class="card-body d-flex flex-column gap-2">
                @if ($method === 'edit')
                    <form action="{{ route('categories.update', $post->id) }}" method="post">
                        @method('PUT')
                    @else
                        <form action="{{ route('categories.store') }}" method="post" id="basicform" data-parsley-validate="">
                @endif
                @csrf
                <div class="col-md-12">
                    @if ($method !== 'edit')
                        @if ($parent)
                            <input type="hidden" name="parent_id" value="{{ $parent->id }}">
                            <label for="basicInput" class="mb-2 fw-bold">Parent Category : {{ $parent->category }}</label>
                        @endif
                    @endif
                    <div class="form-group">
                        <label for="basicInput">Category Name</label>
                        <input type="text" class="form-control" id="category" placeholder="Ex: Bandung Merdeka"
                            name="category" @if ($method === 'edit') value="{{ $post->category }}" @endif>
                    </div>

                    <div class="form-group">
                        <label for="basicInput">Slug</label>
                        <input type="text" class="form-control" id="slug" placeholder="http://example.com/about"
                            name="slug" @if ($method === 'edit') value="{{ $post->slug }}" @endif>
                    </div>
                    @if ($method === 'edit')
                        <div class="form-group">
                            <label for="basicInput">Status</label>
                            <div class="form-group">
                                <input class="form-check-input" type="radio" name="is_active"
                                    @if ($post->is_active == 1) checked @endif value="1">
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
                        <a href="{{ route('categories.index') }}" class="btn btn-light" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Back to Table Category">Back</a>
                        <button class="btn btn-primary" type="submit" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Create Category">Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('javascript')
@endsection
