@extends('layout.app')

@section('body')
    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">
            <div class="card-header">
                <a href="{{route('categories.create')}}" class="btn btn-primary">
                    <i data-feather="plus"></i>Add Category
                </a>
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Slug</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $c)
                        <tr>
                            <td>{{ $c->category }}</td>
                            @if ($c->is_active == 1)
                            <td> <span class="badge bg-success">Active</span> </td>
                            @else
                            <td> <span class="badge bg-danger">Inactive</span> </td>
                            @endif
                            <td>
                            <td>{{ $c->types }}</td>
                            <td>{{ $c->slug }}</td>
                                <a href="#" class="btn icon btn-primary"><i class="bi bi-pencil"></i></a>
                                <a href="users" class="btn icon btn-danger"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
    <!-- Basic Tables end -->
@endsection