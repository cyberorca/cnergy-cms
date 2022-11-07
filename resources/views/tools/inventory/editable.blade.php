@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/pages/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/dracula.css') }}">
    <style>
        .CodeMirror {
            border: 1px solid #eee;
            height: 375px;
        }
    </style>
@endsection

@push('head')
@endpush

@section('body')
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="desktop-tab" data-bs-toggle="tab" href="#desktop" role="tab"
                        aria-controls="desktop" aria-selected="true">Desktop</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="mobile-tab" data-bs-toggle="tab" href="#mobile" role="tab"
                        aria-controls="mobile" aria-selected="false">Mobile</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="amp-tab" data-bs-toggle="tab" href="#amp" role="tab"
                        aria-controls="amp" aria-selected="false">AMP</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="desktop" role="tabpanel" aria-labelledby="desktop-tab">
                    <div class="row">
                        <div class="col-md-3">
                            <p class="fw-bold">Billboard/Masthead</p>
                            <div class="form-group">
                                <label for="slot_name" class="mb-2">Slot name</label>
                                <input type="text" class="form-control" id="slot_name" name="slot_name" required
                                    {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="adunit_size" class="mb-2">Adunit size</label>
                                <input type="text" class="form-control" id="adunit_size" name="adunit_size" required
                                    {{-- value="{{ $item->adunit_size }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="creative_size" class="mb-2">Creative Size</label>
                                <input type="text" class="form-control" id="creative_size" name="creative_size" required
                                    {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="template_id" class="mb-2">Template ID</label>
                                <input type="text" class="form-control" id="template_id" name="template_id" required
                                    {{-- value="{{ $item->template_id }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="placement_id" class="mb-2">Placement ID</label>
                                <input type="text" class="form-control" id="placement_id" name="placement_id" required
                                    {{-- value="{{ $item->placement_id }}" --}} />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bold">Leaderboard</p>
                            <div class="form-group">
                                <label for="adunit_size" class="mb-2">Adunit size</label>
                                <input type="text" class="form-control" id="adunit_size" name="adunit_size" required
                                    {{-- value="{{ $item->adunit_size }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="creative_size" class="mb-2">Creative Size</label>
                                <input type="text" class="form-control" id="creative_size" name="creative_size"
                                    required {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="template_id" class="mb-2">Template ID</label>
                                <input type="text" class="form-control" id="template_id" name="template_id" required
                                    {{-- value="{{ $item->template_id }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="placement_id" class="mb-2">Placement ID</label>
                                <input type="text" class="form-control" id="placement_id" name="placement_id"
                                    required {{-- value="{{ $item->placement_id }}" --}} />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bold">Skin Ads</p>
                            <div class="form-group">
                                <label for="adunit_size" class="mb-2">Adunit size</label>
                                <input type="text" class="form-control" id="adunit_size" name="adunit_size" required
                                    {{-- value="{{ $item->adunit_size }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="creative_size" class="mb-2">Creative Size</label>
                                <input type="text" class="form-control" id="creative_size" name="creative_size"
                                    required {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="template_id" class="mb-2">Template ID</label>
                                <input type="text" class="form-control" id="template_id" name="template_id" required
                                    {{-- value="{{ $item->template_id }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="placement_id" class="mb-2">Placement ID</label>
                                <input type="text" class="form-control" id="placement_id" name="placement_id"
                                    required {{-- value="{{ $item->placement_id }}" --}} />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">Half Page</p>
                            <div class="form-group">
                                <label for="adunit_size" class="mb-2">Adunit size</label>
                                <input type="text" class="form-control" id="adunit_size" name="adunit_size" required
                                    {{-- value="{{ $item->adunit_size }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="creative_size" class="mb-2">Creative Size</label>
                                <input type="text" class="form-control" id="creative_size" name="creative_size"
                                    required {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="template_id" class="mb-2">Template ID</label>
                                <input type="text" class="form-control" id="template_id" name="template_id" required
                                    {{-- value="{{ $item->template_id }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="placement_id" class="mb-2">Placement ID</label>
                                <input type="text" class="form-control" id="placement_id" name="placement_id"
                                    required {{-- value="{{ $item->placement_id }}" --}} />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">Showcase 1</p>
                            <div class="form-group">
                                <label for="adunit_size" class="mb-2">Adunit size</label>
                                <input type="text" class="form-control" id="adunit_size" name="adunit_size" required
                                    {{-- value="{{ $item->adunit_size }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="creative_size" class="mb-2">Creative Size</label>
                                <input type="text" class="form-control" id="creative_size" name="creative_size"
                                    required {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="template_id" class="mb-2">Template ID</label>
                                <input type="text" class="form-control" id="template_id" name="template_id" required
                                    {{-- value="{{ $item->template_id }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="placement_id" class="mb-2">Placement ID</label>
                                <input type="text" class="form-control" id="placement_id" name="placement_id"
                                    required {{-- value="{{ $item->placement_id }}" --}} />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">Showcase 2</p>
                            <div class="form-group">
                                <label for="adunit_size" class="mb-2">Adunit size</label>
                                <input type="text" class="form-control" id="adunit_size" name="adunit_size" required
                                    {{-- value="{{ $item->adunit_size }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="creative_size" class="mb-2">Creative Size</label>
                                <input type="text" class="form-control" id="creative_size" name="creative_size"
                                    required {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="template_id" class="mb-2">Template ID</label>
                                <input type="text" class="form-control" id="template_id" name="template_id" required
                                    {{-- value="{{ $item->template_id }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="placement_id" class="mb-2">Placement ID</label>
                                <input type="text" class="form-control" id="placement_id" name="placement_id"
                                    required {{-- value="{{ $item->placement_id }}" --}} />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">Bottom Frame</p>
                            <div class="form-group">
                                <label for="adunit_size" class="mb-2">Adunit size</label>
                                <input type="text" class="form-control" id="adunit_size" name="adunit_size" required
                                    {{-- value="{{ $item->adunit_size }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="creative_size" class="mb-2">Creative Size</label>
                                <input type="text" class="form-control" id="creative_size" name="creative_size"
                                    required {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="template_id" class="mb-2">Template ID</label>
                                <input type="text" class="form-control" id="template_id" name="template_id" required
                                    {{-- value="{{ $item->template_id }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="placement_id" class="mb-2">Placement ID</label>
                                <input type="text" class="form-control" id="placement_id" name="placement_id"
                                    required {{-- value="{{ $item->placement_id }}" --}} />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">Widget</p>
                            <p>Widget after article script tag</p>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">Before Body</p>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">After Body</p>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="mobile" role="tabpanel" aria-labelledby="mobile-tab">
                    <div class="row">
                        <div class="col-md-3">
                            <p class="fw-bold">Billboard/Masthead</p>
                            <div class="form-group">
                                <label for="slot_name" class="mb-2">Slot name</label>
                                <input type="text" class="form-control" id="slot_name" name="slot_name" required
                                    {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="adunit_size" class="mb-2">Adunit size</label>
                                <input type="text" class="form-control" id="adunit_size" name="adunit_size" required
                                    {{-- value="{{ $item->adunit_size }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="creative_size" class="mb-2">Creative Size</label>
                                <input type="text" class="form-control" id="creative_size" name="creative_size" required
                                    {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="template_id" class="mb-2">Template ID</label>
                                <input type="text" class="form-control" id="template_id" name="template_id" required
                                    {{-- value="{{ $item->template_id }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="placement_id" class="mb-2">Placement ID</label>
                                <input type="text" class="form-control" id="placement_id" name="placement_id" required
                                    {{-- value="{{ $item->placement_id }}" --}} />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bold">Headline</p>
                            <div class="form-group">
                                <label for="adunit_size" class="mb-2">Adunit size</label>
                                <input type="text" class="form-control" id="adunit_size" name="adunit_size" required
                                    {{-- value="{{ $item->adunit_size }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="creative_size" class="mb-2">Creative Size</label>
                                <input type="text" class="form-control" id="creative_size" name="creative_size"
                                    required {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="template_id" class="mb-2">Template ID</label>
                                <input type="text" class="form-control" id="template_id" name="template_id" required
                                    {{-- value="{{ $item->template_id }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="placement_id" class="mb-2">Placement ID</label>
                                <input type="text" class="form-control" id="placement_id" name="placement_id"
                                    required {{-- value="{{ $item->placement_id }}" --}} />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bold">Exposer</p>
                            <div class="form-group">
                                <label for="adunit_size" class="mb-2">Adunit size</label>
                                <input type="text" class="form-control" id="adunit_size" name="adunit_size" required
                                    {{-- value="{{ $item->adunit_size }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="creative_size" class="mb-2">Creative Size</label>
                                <input type="text" class="form-control" id="creative_size" name="creative_size"
                                    required {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="template_id" class="mb-2">Template ID</label>
                                <input type="text" class="form-control" id="template_id" name="template_id" required
                                    {{-- value="{{ $item->template_id }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="placement_id" class="mb-2">Placement ID</label>
                                <input type="text" class="form-control" id="placement_id" name="placement_id"
                                    required {{-- value="{{ $item->placement_id }}" --}} />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">Showcase 1</p>
                            <div class="form-group">
                                <label for="adunit_size" class="mb-2">Adunit size</label>
                                <input type="text" class="form-control" id="adunit_size" name="adunit_size" required
                                    {{-- value="{{ $item->adunit_size }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="creative_size" class="mb-2">Creative Size</label>
                                <input type="text" class="form-control" id="creative_size" name="creative_size"
                                    required {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="template_id" class="mb-2">Template ID</label>
                                <input type="text" class="form-control" id="template_id" name="template_id" required
                                    {{-- value="{{ $item->template_id }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="placement_id" class="mb-2">Placement ID</label>
                                <input type="text" class="form-control" id="placement_id" name="placement_id"
                                    required {{-- value="{{ $item->placement_id }}" --}} />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">Showcase 2</p>
                            <div class="form-group">
                                <label for="adunit_size" class="mb-2">Adunit size</label>
                                <input type="text" class="form-control" id="adunit_size" name="adunit_size" required
                                    {{-- value="{{ $item->adunit_size }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="creative_size" class="mb-2">Creative Size</label>
                                <input type="text" class="form-control" id="creative_size" name="creative_size"
                                    required {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="template_id" class="mb-2">Template ID</label>
                                <input type="text" class="form-control" id="template_id" name="template_id" required
                                    {{-- value="{{ $item->template_id }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="placement_id" class="mb-2">Placement ID</label>
                                <input type="text" class="form-control" id="placement_id" name="placement_id"
                                    required {{-- value="{{ $item->placement_id }}" --}} />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">Bottom Frame</p>
                            <div class="form-group">
                                <label for="adunit_size" class="mb-2">Adunit size</label>
                                <input type="text" class="form-control" id="adunit_size" name="adunit_size" required
                                    {{-- value="{{ $item->adunit_size }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="creative_size" class="mb-2">Creative Size</label>
                                <input type="text" class="form-control" id="creative_size" name="creative_size"
                                    required {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="template_id" class="mb-2">Template ID</label>
                                <input type="text" class="form-control" id="template_id" name="template_id" required
                                    {{-- value="{{ $item->template_id }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="placement_id" class="mb-2">Placement ID</label>
                                <input type="text" class="form-control" id="placement_id" name="placement_id"
                                    required {{-- value="{{ $item->placement_id }}" --}} />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">Widget</p>
                            <p>Widget after article script tag</p>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">Before Page</p>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">After Page</p>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="amp" role="tabpanel" aria-labelledby="amp-tab">
                    
                    <div class="row">
                        <div class="col-md-3">
                            <p class="fw-bolder">Bottom Frame</p>
                            <div class="form-group">
                                <label for="adunit_size" class="mb-2">Adunit size</label>
                                <input type="text" class="form-control" id="adunit_size" name="adunit_size" required
                                    {{-- value="{{ $item->adunit_size }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="creative_size" class="mb-2">Creative Size</label>
                                <input type="text" class="form-control" id="creative_size" name="creative_size"
                                    required {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="template_id" class="mb-2">Template ID</label>
                                <input type="text" class="form-control" id="template_id" name="template_id" required
                                    {{-- value="{{ $item->template_id }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="placement_id" class="mb-2">Placement ID</label>
                                <input type="text" class="form-control" id="placement_id" name="placement_id"
                                    required {{-- value="{{ $item->placement_id }}" --}} />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">Heading 1</p>
                            <div class="form-group">
                                <label for="adunit_size" class="mb-2">Adunit size</label>
                                <input type="text" class="form-control" id="adunit_size" name="adunit_size" required
                                    {{-- value="{{ $item->adunit_size }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="creative_size" class="mb-2">Creative Size</label>
                                <input type="text" class="form-control" id="creative_size" name="creative_size"
                                    required {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="template_id" class="mb-2">Template ID</label>
                                <input type="text" class="form-control" id="template_id" name="template_id" required
                                    {{-- value="{{ $item->template_id }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="placement_id" class="mb-2">Placement ID</label>
                                <input type="text" class="form-control" id="placement_id" name="placement_id"
                                    required {{-- value="{{ $item->placement_id }}" --}} />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">Heading 2</p>
                            <div class="form-group">
                                <label for="adunit_size" class="mb-2">Adunit size</label>
                                <input type="text" class="form-control" id="adunit_size" name="adunit_size" required
                                    {{-- value="{{ $item->adunit_size }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="creative_size" class="mb-2">Creative Size</label>
                                <input type="text" class="form-control" id="creative_size" name="creative_size"
                                    required {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="template_id" class="mb-2">Template ID</label>
                                <input type="text" class="form-control" id="template_id" name="template_id" required
                                    {{-- value="{{ $item->template_id }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="placement_id" class="mb-2">Placement ID</label>
                                <input type="text" class="form-control" id="placement_id" name="placement_id"
                                    required {{-- value="{{ $item->placement_id }}" --}} />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">Showcase 1</p>
                            <div class="form-group">
                                <label for="adunit_size" class="mb-2">Adunit size</label>
                                <input type="text" class="form-control" id="adunit_size" name="adunit_size" required
                                    {{-- value="{{ $item->adunit_size }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="creative_size" class="mb-2">Creative Size</label>
                                <input type="text" class="form-control" id="creative_size" name="creative_size"
                                    required {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="template_id" class="mb-2">Template ID</label>
                                <input type="text" class="form-control" id="template_id" name="template_id" required
                                    {{-- value="{{ $item->template_id }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="placement_id" class="mb-2">Placement ID</label>
                                <input type="text" class="form-control" id="placement_id" name="placement_id"
                                    required {{-- value="{{ $item->placement_id }}" --}} />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">Showcase 2</p>
                            <div class="form-group">
                                <label for="adunit_size" class="mb-2">Adunit size</label>
                                <input type="text" class="form-control" id="adunit_size" name="adunit_size" required
                                    {{-- value="{{ $item->adunit_size }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="creative_size" class="mb-2">Creative Size</label>
                                <input type="text" class="form-control" id="creative_size" name="creative_size"
                                    required {{-- value="{{ $item->slot_name }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="template_id" class="mb-2">Template ID</label>
                                <input type="text" class="form-control" id="template_id" name="template_id" required
                                    {{-- value="{{ $item->template_id }}" --}} />
                            </div>
                            <div class="form-group">
                                <label for="placement_id" class="mb-2">Placement ID</label>
                                <input type="text" class="form-control" id="placement_id" name="placement_id"
                                    required {{-- value="{{ $item->placement_id }}" --}} />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">Widget</p>
                            <p>Widget after article script tag</p>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">Before Page</p>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <p class="fw-bolder">After Page</p>
                        </div>
                        <div class="col-md-9">
                            <textarea name="code" id="code" cols="30" rows="20" class="h-100 CodeMirror"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('javascript')
    <script src="{{ asset('assets/js/codemirror.js') }}"></script>
    <script src="{{ asset('assets/js/extensions/javascript.js') }}"></script>
    <script src="{{ asset('assets/js/pages/inventory.js') }}"></script>
@endsection
