@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/pages/menu.css')}}">
@endsection

@section('body')

    <x-page-heading title="Table News" subtitle="View and Manage News Data" />
    <div class="card ">
        <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">News Search</span>
        </div>
        <div class="card-body">
            <form class="row g-3" method="GET">
                <div class="col-md-4">
                    <label for="inputTitle" class="form-label">Title</label>
                    <input name="inputTitle" id="title" placeholder="Title" type="text" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Created at</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="startDate">
                        &nbsp;&nbsp;&nbsp;<p>To</p>&nbsp;&nbsp;&nbsp;
                        <input type="date" class="form-control" name="endDate">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="inputHeadline" class="form-label">Reporter</label>
                    <select name="reporter" id="inputHeadline" class="form-select">
                        <option value="" selected>All</option>
                        @foreach ($reporters as $r)
                            <option value="{{ $r->uuid }}">{{ $r->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="inputHeadline" class="form-label">Type</label>
                    <select name="newsTypes" id="inputHeadline" class="form-select">
                        <option value="" selected>All</option>
                        @foreach ($newsTypes as $t)
                            <option value="{{$t}}">{{$t}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-3">
                    <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Category Search"><i class="bi bi-search"></i>&nbsp;&nbsp;&nbsp;Search</button>
                    <a href="" class="btn btn-light" data-bs-toggle="tooltip"
                       data-bs-placement="top" title="Show All Category Data"><i
                            class="bi bi-card-list"></i>&nbsp;&nbsp;&nbsp;Show All</a>
                </div>
            </form>
        </div>
    </div>
    <section class="section">

        <!-- Basic Tables start -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">Page List</span>
{{--                <a href="" class="btn btn-primary"><i class="bi bi-plus-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Tag"></i>&nbsp;&nbsp;&nbsp;Add--}}
{{--                    Page</a>--}}
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Reporter</th>
                        <th>Last Modified</th>
                        <th>Type</th>
                        <th style="width:20%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($news as $n)
                        <tr>
                            <td>{{ $news->firstItem() + $loop->index }}</td>
                            <td>{{ $n->title}}</td>
                            <td></td>
                            <td>@if(is_null($n->updated_at))
                                    {{$n->created_at}}
                                @else
                                    {{$n->updated_at}}
                                @endif
                                </td>
                            <td>{{$n->types}}</td>
                            <td>
                                <a href="{{route($n->types .'.edit', $n->id)}}" class="btn icon btn-warning"
                                   data-bs-toggle="tooltip" data-bs-placement="top" title="Update Page Data"><i
                                        class="bi bi-pencil-square"></i></a>
                                <button type="button" data-toggle="modal"
                                        data-target="#deleteModal{{ $n->id }}" class="btn icon btn-danger"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Page Data"><i
                                        class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <div class="modal fade" id="deleteModal{{ $n->id }}" tabindex="-1"
                             aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Delete News</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Delete News "{{ $n->title }}"?
                                    </div>
                                    <div class="modal-footer">

                                        <form action="{{route($type.'.destroy', $n->id)}}" method="post">
                                            {{ method_field('delete') }}
                                            @csrf
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Delete</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex">
                    {{ $news->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
@section('javascript')
    <script src="assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
@endsection
