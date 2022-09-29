@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/pages/menu.css') }}">
@endsection

@section('body')
    <x-page-heading title="Table News" subtitle="View and Manage News Data" />
    <div class="card ">
        <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">News Search</span></div>
        <div class="card-body">
            <form class="row g-3" method="GET">
                <div class="col-md-4">
                    <label for="inputTitle" class="form-label">Title</label>
                    <input name="inputTitle" id="title" placeholder="Title" type="text" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="inputCategory" class="form-label">Category</label>
                    <input name="inputCategory" id="category" placeholder="Category" type="text" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="inputHeadline" class="form-label">Headline</label>
                    <select name="headline" id="inputHeadline" class="form-select">
                        <option value="" selected>All</option>
                        <option value="1">Headline</option>
                        <option value="2">Not Headline</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Created Date</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="startDate">
                        &nbsp;&nbsp;&nbsp;<p>To</p>&nbsp;&nbsp;&nbsp;
                        <input type="date" class="form-control" name="endDate">
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-3 mt-3">
                        <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Category Search"><i class="bi bi-search"></i>&nbsp;&nbsp;&nbsp;Search</button>
                        <a href="{{route('categories.index')}}" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Show All Category Data"><i class="bi bi-card-list"></i>&nbsp;&nbsp;&nbsp;Show All</a> 
                </div>
            </form>
        </div>
    </div>
    <section class="section">

        <!-- Basic Tables start -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">News List</span>
                <a href="" class="btn btn-primary"><i class="bi bi-plus-circle-fill" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Add Tag"></i>&nbsp;&nbsp;&nbsp;Add
                    News</a>
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Synopsis</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Tags News</th>
                            <th style="width:15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($news as $n)
                            <tr>
                                <td>{{ $n->id }}</td>
                                <td>{{ $n->title }}</td>
                                <td>{{ $n->slug }}</td>
                                <td>{{ $n->synopsis }}</td>
                                <td>{{ $n->types }}</td>
                                <td>{{ $n->categories->category_id}}</td>
                                <td>{{ $n->news_tag}}</td>
                                <td>
                                    <a href="" class="btn icon btn-warning"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Update User Data"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <button type="button" data-toggle="modal" data-target=""
                                        class="btn icon btn-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Delete User Data"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div  class="d-flex">
                    {{ $news->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection