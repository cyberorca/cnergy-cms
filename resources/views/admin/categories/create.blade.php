@extends('layout.app')

@section('css')
@endsection

@section('body')
<x-page-heading title="Table Category" subtitle="View and Manage Category Data" />
<section class="section">
    <div class="card col-md-7">
            <div class="card-header"><span class="h4">Add Category</span></div>
            <div class="card-body d-flex flex-column gap-2">
            <form action="{{ route('categories.store') }}" method="post" id="basicform" data-parsley-validate="">
                    @csrf  
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="basicInput">Category Name</label>
                            <input type="text" class="form-control" id="category" placeholder="Ex: Bandung Merdeka" name="category" >
                        </div>
                        
                        <div class="form-group">
                            <label for="basicInput">Slug</label>
                            <input type="text" class="form-control" id="slug" placeholder="http://example.com/about" name="slug">
                        </div>
                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <a href="{{route('categories.index')}}" class="btn btn-secondary">Back</a>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('javascript')
@endsection