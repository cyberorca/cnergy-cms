@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/pages/image-uploader.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
@endsection

@push('head')
@endpush

@section('body')
    <x-page-heading title="Table News" subtitle="View and Manage News Data" />
    @if ($method === 'edit')
        <form action="{{ route('news.update', $news->id) }}" method="post">
        @else
            <form action="{{ route('news.store') }}" method="post">
    @endif
    <section id="basic-vertical-layouts">
        @csrf
        <div class="row match-height">
            <div class="col-6 ">
                <div class="card">
                    <div class="card-header"><span class="h4 text-capitalize">{{ $method }} News</span>
                    </div>
                    <div class="card-body d-flex flex-column gap-2">
                        @if ($method === 'edit')
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="title" class="mb-2">Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Enter Title "
                                @if ($method === 'edit') value="{{ $news->title }}" @endif />
                            <label for="content" class="form-label">Content</label>
                            <textarea name="content" class="my-editor form-control" id="content" cols="30" rows="10">
                                                @if ($method === 'edit')
{{ $news->content }}
@endif
                                            </textarea>
                        </div>
                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <a href="{{ route('news.index') }}" class="btn btn-light" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Back to Table Rome">Back</a>

                            <button class="btn btn-primary" name="save" type="submit" data-bs-toggle="tooltip"
                                value="publish" data-bs-placement="top" title="Create Role">Save
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <span class="h4">Others</span>
                    </div>
                    <div class="card-body d-flex flex-column gap-2">

                        <div class="form-group">
                            <label for="synopsis" class="form-label mb-2">Synopsis</label>
                            <textarea name="synopsis" class="form-control" id="synopsis" cols="30" rows="3"
                                placeholder="Enter Synopsis">
@if ($method === 'edit')
{{ $news->synopsis }}
@endif
</textarea>


                            <label for="category" class="form-label mb-2">Category</label>
                            <fieldset class="form-group">
                                <select name="category" class="form-select" id="category">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($method === 'edit' and $category->id === $news->category) selected @endif>{{ $category->category }}
                                        </option>
                                    @endforeach
                                </select>
                            </fieldset>

                            <label for="type" class="form-label mb-2">Type</label>
                            <fieldset class="form-group">
                                <select name="type" class="form-select" id="type">
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}"
                                            @if ($method === 'edit' and $type === $news->type) selected @endif>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </fieldset>

                            <label class="form-check-label" for="isHeadline">Headline</label>
                            <input name="isHeadline" class="form-check-input" type="checkbox" id="isHeadline"
                                @if ($method === 'edit' and $news->is_headline == '1') checked @endif>
                            <label class="form-check-label" for="isPublish">Status Publish</label>
                            <input name="isPublish" class="form-check-input" type="checkbox" id="isPublish"
                                @if ($method === 'edit' and $news->is_published == '1') checked @endif>

                        </div>
                        <div class="form-group">
                            <label for="publishedAt" class="mb-2">Published At</label>
                            <input type="date" class="form-control" id="publishedAt" name="publishedAt"
                                placeholder="Pick Date "
                                @if ($method === 'edit') value="{{ $news->published_at }}" @endif />
                        </div>
                        <div class="form-group">
                            <label for="tags" class="form-label mb-2">Tags</label>
                            <select name="tags[]" class="choices form-select multiple-remove" multiple="multiple"
                                id="tags">
                                <optgroup label="Tags">
                                    @foreach ($tags as $id => $tag)
                                        <option id="{{ $id }}" value="{{ $id }}"
                                            @if ($method === 'edit' and $tag->news()->find($news->id)) selected @endif>{{ $tag->tags }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        </div>

        </div>
        </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <span class="h4">News Image</span>
                </div>
                <div class="card-body">
                    <x-image-uploader />
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <span class="h4">Others</span>
                </div>
                <div class="card-body d-flex flex-column gap-2">

                    <div class="form-group">
                        <label for="synopsis" class="form-label mb-2">Synopsis</label>
                        <textarea name="synopsis" class="form-control" id="synopsis" cols="30" rows="3"
                            placeholder="Enter Synopsis">
                                @if ($method === 'edit')
{{ $news->synopsis }}
@endif
                            </textarea>


                        <label for="category" class="form-label mb-2">Category</label>
                        <fieldset class="form-group">
                            <select name="category" class="form-select" id="category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if ($method === 'edit' and $category->id === $news->category) selected @endif>{{ $category->category }}
                                    </option>
                                @endforeach
                            </select>
                        </fieldset>

                        <label for="type" class="form-label mb-2">Type</label>
                        <fieldset class="form-group">
                            <select name="type" class="form-select" id="type">
                                @foreach ($types as $type)
                                    <option value="{{ $type }}"
                                        @if ($method === 'edit' and $type === $news->type) selected @endif>{{ $type }}</option>
                                @endforeach
                            </select>
                        </fieldset>

                        <label class="form-check-label" for="isHeadline">Headline</label>
                        <input name="isHeadline" class="form-check-input" type="checkbox" id="isHeadline"
                            @if ($method === 'edit' and $news->is_headline == '1') checked @endif>
                    </div>

                </div>
            </div>
        </div>
        </div>

    </section>
    </form>
@endsection


@section('javascript')
    <script src="https://cdn.tiny.cloud/1/vadmwvgg5mg6fgloc7tol190sn52g6mrsnk0dguphazk7y41/tinymce/4/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script src="{{ asset('assets/js/pages/image-uploader.js') }}"></script>
    <script>
        var editor_config = {
            path_absolute: "/",
            selector: "textarea.my-editor",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback: function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                    'body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no"
                });
            }
        };

        tinymce.init(editor_config);
    </script>
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-element-select.js') }}"></script>
@endsection
