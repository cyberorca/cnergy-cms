@extends('layout.app')

@section('body')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Category</h4>
            </div>
            <form action="{{ route('categories.store') }}" method="post" id="basicform" data-parsley-validate="">
                <div class="card-body">
                @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Category Name</label>
                                <input type="text" class="form-control my-2" id="category" placeholder="Ex: Bandung Merdeka" name="category">
                            </div>

                            <div class="form-group">
                                <label for="basicInput" class="my-2">Slug</label>
                                <input type="text" class="form-control my-2" id="slug" placeholder="http://example.com/about" name="slug" >
                            </div>
                        </div>
                            
                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <a href="{{route('categories.index')}}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection