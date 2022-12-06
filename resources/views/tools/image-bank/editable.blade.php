@extends('layout.app')

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
    <style>
        .image-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .bootstrap-tagsinput {
            width: 100%;
        }

        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: white !important;
            background-color: #38E54D;
            padding: .2em .6em .3em;
            font-size: 100%;
            font-weight: 700;
            vertical-align: baseline;
            border-radius: .25em;
        }

        .form-group label {
            font-weight: 700 !important;
        }

        .imageInfo {
            font-weight: 600;
        }
    </style>
@endsection

@section('body')
    <x-page-heading title="Meta Data Image" subtitle="Edit or Fill Meta Data Image" />
    <section class="section">

        <form
            action="@if ($method === 'edit') {{ route('image-bank.update', $imageBank->id) }}
            @else{{ route('image-bank.store') }} @endif"
            method="post" enctype="multipart/form-data">
            <div class="card p-4">
                <div class="row">
                    <div class="col-md-5">

                        <div class="card-body d-flex flex-column gap-2">
                            <div class="col-md-12">
                                {{-- <div class="card-header"><span class="h5">
                                        @if ($method === 'edit')
                                            Edit Meta
                                        @else
                                            New
                                        @endif Image
                                    </span></div> --}}
                                {{-- <label for="site_logo" class="mb-2">File</label> --}}
                                <div class="flex flex-column">
                                    @if ($method === 'edit')
                                        <img src="{{ Storage::url($imageBank->slug) }}" class="mb-3 image-preview w-100"
                                            alt="{{ $imageBank->image_alt }}">
                                    @else
                                        <img src="{{ asset('assets/images/preview-image.jpg') }}"
                                            class="mb-3 image-preview w-100" alt="Your Image" id="image_preview">
                                        <input type="file" class="form-control" name="image_input" id="image_input"
                                            accept="image/*" />
                                        @error('site_logo')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="card-body d-flex flex-column gap-2">

                            <div class="col-md-12">
                                @csrf
                                @if ($method === 'edit')
                                    @method('PUT')
                                    <div class="row">
                                        <div class="form-group imageInfo"><i class="bi bi-calendar"></i>
                                            Uploaded on : {{ $imageBank->created_at }}
                                        </div>
                                        <div class="form-group imageInfo"><i class="bi bi-person-fill"></i>
                                            Uploaded by : {{ $imageBank->createdBy->name }}
                                        </div>

                                        <div class="form-group d-flex gap-2">
                                            <input type="text" class="form-control w-50"
                                                value="{{ Storage::url($imageBank->slug) }}" id="copy" disabled />
                                            <button onclick="copyUrl()" type="button" class="btn btn-primary">Copy Link
                                            </button>
                                        </div>
                                        <div>File size: - </div>
                                        <div>Dimensions: - </div>
                                    </div>

                                    <script>
                                        function copyUrl() {
                                            // Get the text field
                                            var copyText = document.getElementById("copy");

                                            // Select the text field
                                            copyText.select();
                                            copyText.setSelectionRange(0, 99999); // For mobile devices

                                            // Copy the text inside the text field
                                            navigator.clipboard.writeText(copyText.value);
                                        }
                                    </script>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="card-body d-flex flex-column gap-2">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="basicInput" class="mb-2">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="basicInput" name="title" placeholder="Enter image title"
                                        @if ($method === 'edit') value="{{ $imageBank->title }}" @endif />
                                    @error('title')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="site_logo" class="mb-2">Text Alt</label>
                                    <div class="flex flex-column">
                                        <input type="text" class="form-control @error('image_alt') is-invalid @enderror"
                                            id="basicInput" name="image_alt" placeholder="Enter image alt"
                                            @if ($method === 'edit') value="{{ $imageBank->image_alt }}" @endif />
                                        @error('image_alt')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="site_logo" class="mb-2">Caption</label>
                                    <div class="flex flex-column">
                                        <input type="text" class="form-control @error('caption') is-invalid @enderror"
                                            id="basicInput" name="caption"
                                            value="@if ($method === 'edit') {{ $imageBank->caption }} @endif"
                                            placeholder="Enter image caption" />
                                        @error('caption')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="site_logo" class="mb-2">Photographer</label>
                                    <div class="flex flex-column">
                                        <input type="text"
                                            class="form-control @error('photographer') is-invalid @enderror" id="basicInput"
                                            name="photographer" placeholder="Enter image photographer"
                                            @if ($method === 'edit') value="{{ $imageBank->photographer }}" @endif />
                                        @error('photographer')
                                            <div class="invalid-feedback">
                                                <i class="bx bx-radio-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body d-flex flex-column gap-2">
                            <div class="form-group">
                                <label for="site_logo" class="mb-2">Copyright</label>
                                <div class="flex flex-column">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">&copy;
                                            {{ Date::now()->year }}</span>
                                        <input type="text"
                                            class="form-control @error('copyright') is-invalid @enderror" id="basicInput"
                                            name="copyright" placeholder="techno.id"
                                            @if ($method === 'edit') value="{{ $imageBank->copyright }}" @endif
                                            aria-describedby="basic-addon1" />
                                    </div>

                                    @error('copyright')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="site_logo" class="mb-2">Keywords</label>
                                <input name="keywords" id="keywords" type="text" required
                                    placeholder="Enter image keywords"
                                    class="w-100 form-control @error('keywords') is-invalid @enderror"
                                    @if ($method === 'edit') value="{{ $imageBank->keywords }}" @endif
                                    data-role="tagsinput" />
                                @error('keywords')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="site_logo" class="mb-2">Description</label>
                                <div class="d-flex flex-column">
                                    <textarea name="description" class="form-control" id="description" cols="30" rows="3"
                                        placeholder="Enter Description">
@if ($method === 'edit')
{{ $imageBank->description }}
@endif
</textarea>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-3 mt-3">
                                <a href="{{ route('image-bank.index') }}" class="btn btn-light" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Back to Table Menu">Back</a>
                                <button class="btn btn-primary" type="submit" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Create Menu">Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

    <script>
        $(function() {
            $('input')
                .on('change', function(event) {
                    var $element = $(event.target);
                    var $container = $element.closest('.example');
                    if (!$element.data('tagsinput')) return;
                    var val = $element.val();
                    if (val === null) val = 'null';
                    var items = $element.tagsinput('items');
                    $('code', $('pre.val', $container)).html(
                        $.isArray(val) ?
                        JSON.stringify(val) :
                        '"' + val.replace('"', '\\"') + '"'
                    );
                    $('code', $('pre.items', $container)).html(
                        JSON.stringify($element.tagsinput('items'))
                    );
                })
                .trigger('change');
        });
    </script>
    <script>
        var image_preview = document.getElementById("image_preview")
        var image_input = document.getElementById("image_input")
        image_input.onchange = evt => {
            const [file] = image_input.files
            if (file) {
                image_preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
