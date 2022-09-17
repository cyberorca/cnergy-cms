@extends('layout.app')

@section('body')

    <section class="section">
        <div class="card col-md-7">
            <div class="card-header">
                <h4 class="card-title">Update User</h4>
            </div>
            <form action="{{route('tags.update',$tag->id)}}" method="post">
            @csrf
            @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="basicInput">Tag</label>
                                <input type="text" class="form-control" id="tags" required="" value="{{$tag->tags}}" name="tag">
                            </div>
                            <div class="form-group">
                                <label for="basicInput">Slug</label>
                                <input type="text" class="form-control" id="slug" required="" value="{{$tag->slug}}" name="slug" >
                            </div>
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
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <a href="{{route('tags.index')}}" class="btn btn-secondary">Back</a>
                            <button class="btn btn-primary" type="submit">Save</button>
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