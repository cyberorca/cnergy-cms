@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/pages/menu.css') }}" />
    <style>
        .card-body * {
            transition: all 0.2s;
        }
        
        .accordion-item.draggable.over .accordion-button {
            background-color: rgba(71, 71, 71, 0.233) !important;
        }

        .space-element{
            height: 52px;
            background-color: rgba(77, 77, 77, 0.245);
        }

        .front-end-name span{
            background-color: rgb(154, 220, 255);
            border-radius: 10px;
            padding: 0 10px;
            margin-left: 10px;
        }
    </style>
@endsection

@section('body')
    <x-page-heading title="FrontEnd Menu Config" subtitle="Manage frontend menu for user" />
    <section class="section">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">Menu List</span>
                <a href="{{ route('front-end-menu.create') }}" class="btn btn-primary"><i
                        class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp;Add
                    Menu Front End</a>
            </div>
            <div class="card-body d-flex flex-column gap-2">
                {{-- <div class="spinner-border text-light" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div> --}}
                <button class="btn btn-success col-2 d-none" id="button-save-order"><i class="bi bi-save"></i> &nbsp;&nbsp; Save Change </button>
                <x-accordion-menu :accordion="$fe_menus" />
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script src={{ asset('assets/js/dragable.js') }}></script>
@endsection
