@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/pages/menu.css') }}" />
@endsection

@section('body')
    <x-page-heading title="Category Config" subtitle="Manage category" />
    {{-- <div class="card ">
        <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">Category Search</span></div>
        <div class="card-body">
            <form class="row g-3" method="GET">
                <div class="col-md-4">
                    <label for="inputCategory" class="form-label">Category</label>
                    <input name="inputCategory" id="category" placeholder="Category" type="text" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="inputSlug" class="form-label">Slug</label>
                    <input name="inputSlug" id="slug" placeholder="Slug" type="text" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Status</label>
                    <select name="status" id="inputState" class="form-select">
                        <option value="" selected>All</option>
                        <option value="1">Active</option>
                        <option value="2">Inactive</option>
                    </select>
                </div>
                <div class="d-flex justify-content-end gap-3 mt-3">
                        <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Category Search"><i class="bi bi-search"></i>&nbsp;&nbsp;&nbsp;Search</button>
                        <a href="{{route('categories.index')}}" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Show All Category Data"><i class="bi bi-card-list"></i>&nbsp;&nbsp;&nbsp;Show All</a> 
                </div>
                
            </form>
        </div>
    </div> --}}
    <section class="section">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">Category List</span>
                <a href="{{ route('category.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i>&nbsp;&nbsp;&nbsp;Add
                    Category</a>
            </div>
            <div class="card-body d-flex flex-column gap-2">
                <x-accordion-menu :accordion="$categories"/>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
@endsection
