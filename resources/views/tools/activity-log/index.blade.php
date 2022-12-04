@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/css/pages/menu.css')}}">
@endsection

@section('body')

    <x-page-heading title="Activity Log" subtitle="View All Activity Log"/>
    <div class="card ">
        <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">News Search</span>
        </div>
        <div class="card-body">
            <form class="row g-3" method="GET">
                <div class="col-md-4">
                    <label for="inputName" class="form-label">Name</label>
                    <input name="inputName" id="inputName" placeholder="Name" type="text" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Date</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="startDate">
                        &nbsp;&nbsp;&nbsp;<p>To</p>&nbsp;&nbsp;&nbsp;
                        <input type="date" class="form-control" name="endDate">
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="inputType" class="form-label">Model Type</label>
                    <select name="modelType" id="inputType" class="form-select">
                        <option value="" selected>All</option>
                        @foreach ($modelType as $t)
                            <option value="{{$t}}">{{$t}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="inputModelID" class="form-label">Model ID</label>
                    <input name="inputModelID" id="inputModelID" placeholder="Model ID" type="text" class="form-control">
                </div>

                <div class="d-flex justify-content-end gap-3 mt-3">
                    <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Activity Log Search"><i class="bi bi-search"></i>&nbsp;&nbsp;&nbsp;Search
                    </button>
                    <a href="" class="btn btn-light" data-bs-toggle="tooltip"
                       data-bs-placement="top" title="Show All Category Data"><i
                            class="bi bi-card-list"></i>&nbsp;&nbsp;&nbsp;Show All</a>
                </div>
            </form>
        </div>
{{--    </div>--}}
    <section class="section">

        <!-- Basic Tables start -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">Page List</span>
            </div>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Model Type</th>
                        <th>Model ID</th>
                        <th>Action</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($activity as $l)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$l->causer->name}}</td>
                            <td>{{$l->created_at}}</td>
                            <td>{{$l->log_name}}</td>
                            <td>{{$l->subject_id}}</td>
                            <td>{{$l->event}}</td>
                            <td>{{$l->description}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex">
                    {{ $activity->links() }}
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
