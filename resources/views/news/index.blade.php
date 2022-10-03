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
                    <label for="inputPublished" class="form-label">Published</label>
                    <select name="published" id="inputPublished" class="form-select">
                        <option value="" selected>All</option>
                        <option value="1">Published</option>
                        <option value="2">Not Published</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="inputTag" class="form-label">Tag</label>
                    <input name="inputTag" id="tag" placeholder="Tag" type="text" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Created Date</label>
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
                    <label for="inputHeadline" class="form-label">Editor</label>
                    <select name="editor" id="inputHeadline" class="form-select">
                        <option value="" selected>All</option>
                        @foreach ($editors as $e)
                        <option value="{{ $e->uuid }}">{{ $e->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex justify-content-end gap-3 mt-3">
                        <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Category Search"><i class="bi bi-search"></i>&nbsp;&nbsp;&nbsp;Search</button>
                        <a href="{{ route('news.index') }}" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Show All Category Data"><i class="bi bi-card-list"></i>&nbsp;&nbsp;&nbsp;Show All</a> 
                </div>
            </form>
        </div>
    </div>
    <section class="section">

        <!-- Basic Tables start -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">News List</span>
                <a href="{{route('news.create')}}" class="btn btn-primary"><i class="bi bi-plus-circle" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Add Tag"></i>&nbsp;&nbsp;&nbsp;Add
                    News</a>
            </div>
            <div class="card-body" >
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Published</th>
                            <th>Category</th>
                            <th>Schedule</th>
                            <th>Headline</th>
                            <th>Tags News</th>
                            <th style="width:20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no = 1; @endphp
                        @foreach ($news as $n)
                            <tr>
                                <td>{{ $no++ }}</td> 
                                <td>{{ $n->id }}</td>
                                <td>{{ $n->title }}</td>
                                @if ($n->is_published  == 1)
                                <td align="center"> <span class="badge bg-success"><i class="bi bi-check fs-5"></i></span> </td>
                                @else
                                <td align="center"> <span class="badge bg-danger"><i class="bi bi-x fs-5"></i></span> </td>
                                @endif
                                <td>{{ $n->categories->category}}</td>
                                <td>{{ $n->created_at->format('d M Y H:i');}}</td>
                                @if ($n->is_headline  == 1)
                                <td align="center">
                                    <i class="bi bi-check text-primary fs-2"></i>
                                </td>
                                @else
                                <td></td>
                                @endif
                                <td> @foreach ($n->tags as $item)
                                    <span class="badge badge-pill bg-light-secondary me-1">{{$item->tags}}</span>
                                @endforeach</td>
                                <td>
                                    <a href="#" class="btn icon btn-primary"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="#"><i class="bi bi-save"></i></a>
                                    <a href="{{route('news.edit', $n->id) }}" class="btn icon btn-warning"
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
@section('javascript')
    <script></script>
@endsection
