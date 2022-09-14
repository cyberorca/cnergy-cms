@extends('layout.app')

@section('body')
    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{route('tags.create')}}" class="btn btn-primary">
                    <i data-feather="plus"></i>Add Tags
                </a>
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tags</th>
                            <th>Slug</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($tags as $t)
                        <tr>
                            <td>{{ $t->id }}</td>
                            <td>
                                <td>{{ $t->tags }}</td>
                                <td>{{ $t->slug }}</td>
                                <a href="#" class="btn icon btn-primary"><i class="bi bi-pencil"></i></a>
                                <a href="users" class="btn icon btn-danger"><i class="far fa-trash-alt"></i></a>
                            </td>
                            @if ($c->is_active == 1)
                            <td> <span class="badge bg-success">Active</span> </td>
                            @else
                            <td> <span class="badge bg-danger">Inactive</span> </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
    <!-- Basic Tables end -->
@endsection