@extends('layout.app')

@section('css')
    <style>
        .image-preview {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }
    </style>
@endsection

@section('body')
    <x-page-heading title="Image Bank" subtitle="Manage Image" />
    <section class="section">
        <form action="{{ route('image-bank.store') }}" method="post" enctype="multipart/form-data">
            <div class="d-flex justify-content-between gap-2">
                <div class="card col-md-6">
                    <div class="card-header"><span class="h5">Add Image</span></div>
                    <div class="card-body d-flex flex-column gap-2">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="basicInput" class="mb-2">Image Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="basicInput" name="title" placeholder="Enter image title" />
                                @error('title')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="site_logo" class="mb-2">Image File</label>
                                <div class="flex flex-column">
                                    <img src="{{ asset('assets/images/site_logo.png') }}" class="mb-3 image-preview"
                                        alt="Your Image" id="image_preview">
                                    <input type="file" class="form-control" name="image_input" id="image_input"
                                        accept="image/*" />
                                    @error('site_logo')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                            <label for="site_logo" class="mb-2">Image Alt</label>
                            <div class="flex flex-column">
                                <input type="text" class="form-control @error('image_alt') is-invalid @enderror"
                                    id="basicInput" name="image_alt" placeholder="Enter image alt" />
                                @error('image_alt')
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
                <div class="card col-md-6">
                    <div class="card-header"><span class="h5">Image</span></div>
                    <div class="card-body d-flex flex-column gap-2">
                        <div class="form-group">
                            <label for="site_logo" class="mb-2">Photographer</label>
                            <div class="flex flex-column">
                                <input type="text" class="form-control @error('photographer') is-invalid @enderror"
                                    id="basicInput" name="photographer" placeholder="Enter image photographer" />
                                @error('photographer')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="site_logo" class="mb-2">Copyright</label>
                            <div class="flex flex-column">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">&copy; {{ Date::now()->year }}</span>
                                    <input type="text" class="form-control @error('copyright') is-invalid @enderror"
                                        id="basicInput" name="copyright" placeholder="techno.id" value=""
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
                            <label for="site_logo" class="mb-2">Caption</label>
                            <div class="flex flex-column">
                                <input type="text" class="form-control @error('caption') is-invalid @enderror"
                                    id="basicInput" name="caption" placeholder="Enter image caption" />
                                @error('caption')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="site_logo" class="mb-2">Keywords</label>
                            <div class="flex flex-column">
                                <textarea type="text" class="form-control @error('keywords') is-invalid @enderror" id="basicInput" name="keywords"
                                    placeholder="Enter keywords"></textarea>
                                @error('keywords')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <a href="{{ route('image-bank.index') }}" class="btn btn-light" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Back to Table Menu">Back</a>
                            <button class="btn btn-primary" type="submit" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Create Menu">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('javascript')
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
