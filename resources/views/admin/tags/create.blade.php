@extends('layout.app')

@section('body')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Tags</h4>
            </div>
            <form action="{{ route('tags.store') }}" method="POST">
                @csrf <!-- {{ csrf_field() }} -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="basicInput">Tags</label>
                            <input type="text" class="form-control" id="tags" placeholder="Tags" name="tags">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Slug</label>
                            <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug" >
                        </div>

                        <div class="form-group">
                            <input type="hidden" id="disabled" name="is_active" value="0">
                            <input type="checkbox" id="is_active" name="is_active" value="1">
                            <label for="is_active">Active</label><br>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Save"> 
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- validations end -->
@endsection