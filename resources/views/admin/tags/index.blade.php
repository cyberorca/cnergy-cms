@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/menu.css') }}" />
@endsection

@section('body')

    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">Tags List</span>
                <a href="{{ route('tags.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp;Add
                    Tag</a>
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tags</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $t)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $t->tags }}</td>
                                <td>{{ $t->slug }}</td>
                                @if ($t->is_active == 1)
                                <td> <span class="badge bg-success">Active</span> </td>
                                @else
                                <td> <span class="badge bg-danger">Inactive</span> </td>
                                @endif
                                <td>
                                    <a href="{{ route('tags.edit', $t->id) }}" class="btn icon btn-primary"><i class="bi bi-pencil"></i></a>
                                    <button type="button" data-toggle="modal" data-target="#deleteModal{{ $t->uuid }}" class="btn icon btn-danger"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <div class="modal fade" id="deleteModal{{ $t->uuid }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Delete Tag</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Yakin ingin menghapus Tag '{{ $t->tags }}' ?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('tags.destroy', $t->id) }}" method="post">
                                                {{ method_field('delete') }}
                                                @csrf
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
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
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script src="assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="assets/js/pages/datatables.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>
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
