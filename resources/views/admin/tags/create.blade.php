@extends('layout.app')

@section('css')
@endsection

@section('body') 
<x-page-heading title="Table Tag" subtitle="View and Manage Tag Data" />
    
<section class="section">
    <div class="card col-md-7">
            <div class="card-header"><span class="h4">Add Tag</span></div>
            <div class="card-body d-flex flex-column gap-2">
            <form action="{{ route('tags.store') }}" method="POST">
                    @csrf  
                    <div class="col-md-12">
                    <div class="form-group">
                            <label for="basicInput">Tag Name</label>
                            <input type="text" class="form-control" id="tags" placeholder="Enter Tag Name" name="tag">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Slug</label>
                            <input type="text" class="form-control" id="slug" placeholder="http://example.com/about" name="slug" >
                        </div>
                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <a href="{{route('tags.index')}}" class="btn btn-secondary">Back</a>
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
