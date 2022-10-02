@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/pages/image-uploader.css') }}" />
@endsection

@section('body')
    <x-page-heading title="Dashboard" subtitle="Manage dashboard" />
    <section class="section">
        <div class="d-flex justify-content-between gap-2">
            <div class="card col-md-8">
                <div class="card-header">
                    <h4 class="card-title">Example Content <i class="bi bi-trash-fill"></i> <i class="bi bi-1-circle"></i> <i
                            class="bi bi-file-earmark-x-fill"></i></h4>
                </div>
                <div class="card-body">
                    <x-image-uploader :modal="$modal"/>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script>
        // var image_preview = document.getElementById("image_preview")
        // var image_input = document.getElementById("image_input")

        var image_preview_result = document.getElementById("image_preview_result")
        var upload_image_button = document.getElementById("upload_image_button")

        // image_input.onchange = evt => {
        //     const [file] = image_input.files
        //     if (file) {
        //         image_preview.src = URL.createObjectURL(file)
        //     }
        // }

        upload_image_button.onchange = evt => {
            console.log("onchange");
            const [file] = upload_image_button.files
            if (file) {
                image_preview_result.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
