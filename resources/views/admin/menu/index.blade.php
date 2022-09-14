@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/simple-datatables/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/simple-datatables.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/menu.css') }}" />
@endsection

@section('body')
    <x-page-heading title="All Menu's" subtitle="Manage backend menu for user" />
    <section class="section">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between"><span class="h4">Menu List</span>
                <a href="#" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp;Add
                    Menu</a>
            </div>
            <div class="card-body d-flex flex-column gap-2">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <div class="menu accordion-button border border-1 border-1 p-2 px-3" type="button"
                                data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                <div class="d-flex align-items-center w-100 justify-content-between">
                                    <p class="m-0">Peristiwa</p>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i></button>
                                        <button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                    </div>
                                </div>
                            </div>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse"
                            aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body pe-0 py-0 border-0">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="panelsStayOpen-headingOne-childOne">
                                        <div class="menu accordion-button border border-1 border-1 p-2 px-3" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne-childOne"
                                            aria-expanded="true" aria-controls="panelsStayOpen-collapseOne-childOne">
                                            <div class="d-flex align-items-center w-100 justify-content-between">
                                                <p class="m-0">Bencana Alam</p>
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i></button>
                                                    <button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                                                    <button class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOne-childOne" class="accordion-collapse collapse"
                                        aria-labelledby="panelsStayOpen-headingOne-childOne">
                                        <div class="accordion-body pe-0 py-0 border-0">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="panelsStayOpen-headingTwo-childTwo">
                                                    <div class="menu accordion-button border border-1 border-1 p-2 px-3" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo-childTwo"
                                                        aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo-childTwo">
                                                        <div class="d-flex align-items-center w-100 justify-content-between">
                                                            <p class="m-0">Gempa Bumi</p>
                                                            <div class="d-flex gap-2">
                                                                <button class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i></button>
                                                                <button class="btn btn-warning"><i class="bi bi-pencil-square"></i></button>
                                                                <button class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </h2>
                                                <div id="panelsStayOpen-collapseTwo-childTwo" class="accordion-collapse collapse"
                                                    aria-labelledby="panelsStayOpen-headingTwo-childTwo">
                                                    <div class="accordion-body text-primary">
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere distinctio
                                                        totam laboriosam? Quod, illo rerum harum voluptas reprehenderit, necessitatibus
                                                        culpa sit eveniet, soluta labore quo! Inventore molestias sint eum consectetur?
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
    <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/simple-datatables.js"></script>
@endsection
