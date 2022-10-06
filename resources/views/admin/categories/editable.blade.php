@extends('layout.app')

@section('css')
@endsection

@section('body')
    <x-page-heading title="Table Category" subtitle="View and Manage Category Data" />
    <section class="section">
        <div class="card col-md-7">
            <div class="card-header"><span class="h4 text-capitalize">{{ $method }} Category</span></div>
            <div class="card-body d-flex flex-column gap-2">
                @if ($method === 'edit')
                    <form action="{{ route('category.update', $post->id) }}" method="post">
                        @method('PUT')
                    @else
                        <form action="{{ route('category.store') }}" method="post" id="basicform" data-parsley-validate="">
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
                        <label for="basicInput">Type Category</label>
                        <div class="form-group">
                        <li class="d-inline-block me-2 mb-1">
                            <div class="form-check">
                                <div class="checkbox">
                                    <input type="checkbox" name="types[]" value="news" class="form-check-input" @if ($method === 'edit') @if(in_array("news", json_decode($post->types))) checked @endif @endif>
                                    <label for="checkbox1">News</label>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="types[]" value="photonews" class="form-check-input" @if ($method === 'edit') @if(in_array("photonews", json_decode($post->types))) checked @endif @endif>
                                    <label for="checkbox1">Photo News</label>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="types[]" value="video" class="form-check-input" @if ($method === 'edit') @if(in_array("video", json_decode($post->types))) checked @endif @endif>
                                    <label for="checkbox1">Video</label>
                                </div>
                            </div>
                        </li>
                        </div>
                    </div>

                    @if ($method === 'edit')
                    <input type="hidden" name="parent_id" value="{{ $post->parent_id }}">
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
                        <a href="{{ route('category.index') }}" class="btn btn-light" data-bs-toggle="tooltip"
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
