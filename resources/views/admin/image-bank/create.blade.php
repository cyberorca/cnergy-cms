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
        <div class="card col-md-7">
            <div class="card-header"><span class="h5">Add Image</span></div>
            <div class="card-body d-flex flex-column gap-2">
                <form action="{{ route('image-bank.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="basicInput" class="mb-2">Image Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="basicInput"
                                name="title" placeholder="Enter image title" />
                            @error('title')
                                <div class="invalid-feedback">
                                    <i class="bx bx-radio-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="site_logo" class="mb-2">Image (.png)</label>
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
                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <a href="{{ route('menu.index') }}" class="btn btn-light" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Back to Table Menu">Back</a>
                            <button class="btn btn-primary" type="submit" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Create Menu">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
