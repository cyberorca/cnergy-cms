@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/pages/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/dracula.css') }}">
    <style>
        .CodeMirror {
            border: 1px solid #eee;
            height: 375px;
        }
    </style>
@endsection

@push('head')
@endpush

@section('body')
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach (array_keys($inventory_config) as $item)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link @if($loop->first) active @endif text-capitalize" id="{{ $item }}-tab" data-bs-toggle="tab"
                            href="#{{ $item }}" role="tab" aria-controls="{{ $item }}"
                            aria-selected="true">{{ $item }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="card-body">
            <form action="{{ route('inventory-management.store') }}" method="post">
                @csrf
                <div class="tab-content" id="myTabContent">
                    {{-- @dump($inventory_config) --}}
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection


@section('javascript')
    <script src="{{ asset('assets/js/codemirror.js') }}"></script>
    <script src="{{ asset('assets/js/extensions/javascript.js') }}"></script>
    <script src="{{ asset('assets/js/pages/inventory.js') }}"></script>
@endsection
