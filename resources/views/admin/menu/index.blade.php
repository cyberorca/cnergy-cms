@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/pages/menu.css') }}" />
@endsection

@section('body')
    <x-page-heading title="Menu Config" subtitle="Manage backend menu for user" />
    <section class="section">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">Menu List</span>
                <a href="{{ route('menu.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i>&nbsp;&nbsp;&nbsp;Add
                    Menu</a>
            </div>
            <div class="card-body d-flex flex-column gap-2">
                <x-accordion-menu :accordion="$menus"/>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
@endsection
