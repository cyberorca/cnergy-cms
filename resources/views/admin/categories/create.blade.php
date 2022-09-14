@extends('layout.app')

@section('body')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Category</h4>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="basicInput">Category</label>
                            <input type="text" class="form-control" id="category" placeholder="Category" name="category">
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Type</label>
                            <br>
                            <input type="checkbox" id="type" name="type" value="News">
                            <label for="vehicle1">News</label><br>
                            <input type="checkbox" id="type" name="type" value="Photo News">
                            <label for="vehicle2">Photo News</label><br>
                            <input type="checkbox" id="type" name="type" value="Video">
                            <label for="vehicle3">Video</label><br>       
                        </div>

                        <div class="form-group">
                            <label for="basicInput">Slug</label>
                            <input type="email" class="form-control" id="slug" placeholder="Slug" name="slug" >
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