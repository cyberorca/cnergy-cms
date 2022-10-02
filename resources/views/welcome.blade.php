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
                    <x-image-uploader :modal="$modal" :item="$image_bank" />
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script src="{{ asset('assets/js/pages/image-uploader.js') }}"></script>
@endsection
