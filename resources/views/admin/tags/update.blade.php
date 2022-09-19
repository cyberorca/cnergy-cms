@extends('layout.app')

@section('body')
<x-page-heading title="Table Tag" subtitle="View and Manage Tag Data" />
<section class="section">
    <div class="card col-md-7">
            <div class="card-header"><span class="h4">Update Tag</span></div>
            <div class="card-body d-flex flex-column gap-2">
                <form action="{{route('tags.update',$tag->id)}}" method="post">
                    @method("PUT")
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group">
                                <label for="basicInput">Tag</label>
                                <input type="text" class="form-control" id="tags" value="{{$tag->tags}}" name="tag">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Slug</label>
                                <input type="text" class="form-control" id="slug" value="{{$tag->slug}}" name="slug" >
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Status</label>
                                <div class="form-group">
                                    @if ($tag->is_active == 1)
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
                            <a href="{{route('tags.index')}}" class="btn btn-secondary">Back</a>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection