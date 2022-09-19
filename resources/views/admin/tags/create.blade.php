@extends('layout.app')

@section('body')
    <section class="section">
        <div class="card col-md-7">
            <div class="card-header">
                <h4 class="card-title">Add Tags</h4>
            </div>
            <form action="{{ route('tags.store') }}" method="POST">
                @csrf <!-- {{ csrf_field() }} -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="form-group">
                            <label for="basicInput">Tags</label>
                            <input type="text" class="form-control" id="tags" placeholder="Tags" name="tag">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Slug</label>
                            <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug" >
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <a href="{{route('tags.index')}}" class="btn btn-secondary">Back</a>
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- validations end -->
@endsection