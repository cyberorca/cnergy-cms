
@extends('layout.app')

@section('body')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Update Category</h4>
            </div>
            <form action="{{route('categories.update',$post->id)}}" method="post">
            @csrf
            @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput">Category Name</label>
                                <input type="text" class="form-control my-2" id="category" placeholder="Ex: Bandung Merdeka" name="category" value="{{$post->category}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="basicInput" class="my-2">Slug</label>
                                <input type="text" class="form-control my-2" id="slug" placeholder="http://example.com/about" name="slug" value="{{$post->slug}}">
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
                        </div>

                        <div class="form-group my-2">
                            <a href="{{route('categories.index')}}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- validations end -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
@endsection