@extends('layout.app')

@section('body')
<x-page-heading title="Table Category" subtitle="View and Manage Category Data" />
<section class="section">
    <div class="card col-md-7">
            <div class="card-header"><span class="h4">Update Category</span></div>
            <div class="card-body d-flex flex-column gap-2">
                <form action="{{route('categories.update',$post->id)}}" method="post">
                    @method("PUT")
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="basicInput">Category Name</label>
                            <input type="text" class="form-control" id="category" placeholder="Ex: Bandung Merdeka" name="category" value="{{$post->category}}">
                        </div>
                        <div class="form-group">
                            <label for="basicInput">Slug</label>
                            <input type="text" class="form-control" id="slug"  placeholder="http://example.com/about" name="slug" value="{{$post->slug}}">
                        </div>
                            <div class="form-group">
                                <label for="basicInput">Status</label>
                                <div class="form-group">
                                    @if ($post->is_active == 1)
                                    <input class="form-check-input" type="radio" name="is_active" value="1" id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        On 
                                    </label>
                                    <input class="form-check-input" type="radio" name="is_active" value="0" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Off
                                    </label>
                                    @else
                                    <input class="form-check-input" type="radio" name="is_active" value="1" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        On 
                                    </label>
                                    <input class="form-check-input" type="radio" name="is_active" value="0" id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Off
                                    </label>
                                    @endif
                                </div>
                            </div>
                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <a href="{{route('categories.index')}}" class="btn btn-secondary">Back</a>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection