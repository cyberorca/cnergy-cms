@extends('layout.app')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('body')
    <x-page-heading title="Today Tag" subtitle="Set today's tag" />
    <section class="section">
        <div class="card col-md-12">
        <div class="card-header"><span class="h4 text-capitalize card-header-text">{{ $method }} Today Tag</span></div>
            <div class="card-body d-flex flex-column gap-2">
                @if ($method === 'edit')
                <form action="{{ route('today-tag.update', $today_tag->id) }}" method="post">
                @method('PUT')
                @else
                <form action="{{ route('today-tag.store') }}" method="post">
                @endif
                @csrf
                    <div class="d-flex justify-content-between">
                        <div class="card col-md-6">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="basicInput" class="mb-2">Order</label>
                                        <select class="form-select" id="" name="order" required>
                                            <option value="" disabled selected>Select Order</option>
                                            @php
                                                $i=1;
                                            @endphp
                                            @while($i<=20)
                                                <option  value="{{$i}}" @if ($method === 'edit' and $today_tag->order_by_no === $i) selected @endif>{{$i}}</option>
                                                @php $i++; @endphp
                                            @endwhile
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput" class="mb-2">Type</label>
                                        <select class="form-select" id="" name="type" required aria-label="Default select example"
                                        onchange="getType(this)">
                                            <option value="" disabled selected>Select Type</option>
                                            <option value="news_tag" @if ($method === 'edit' and $today_tag->types === "news_tag") selected @endif>News Tag</option>
                                            <option value="sponsorship_tag" @if ($method === 'edit' and $today_tag->types === "sponsorship_tag") selected @endif>Sponsorshop Tag</option>
                                            <option value="external_link" @if ($method === 'edit' and $today_tag->types === "external_link") selected @endif>External Link</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="form-group-tag">
                                        <label for="basicInput" class="mb-2">Tag</label>
                                        <select name="Tag[]" class="form-select" style='width: 100%;' multiple="multiple"
                                                id="tag" >
                                                @if ($method === 'edit' && isset($today_tag->tag))
                                                    @php
                                                    $array_response = json_decode($today_tag->tag, true);
                                                    @endphp
                                                    @foreach($array_response as $value)
                                                        <option value="{{ $value }}" selected> {{ $value}} </option>
                                                    @endforeach
                                                @endif
                                        </select>
                                    </div>
                                    <div class="form-group" id="form-group-url">
                                        <label for="basicInput" class="mb-2">URL</label>
                                        <input type="text" class="form-control" id="url" name="url"
                                        placeholder="Enter URL "  
                                        @if ($method === 'edit') value="{{ $today_tag->url }}" @endif/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card col-md-6">
                            <div class="card-body d-flex flex-column gap-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="basicInput" class="mb-2">Title</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter Title " required 
                                        @if ($method === 'edit') value="{{ $today_tag->title }}" @endif/>
                                    </div>
                                    <div class="form-group">
                                        <label for="basicInput" class="mb-2">Category</label>
                                        <select class="form-select" name="category" id="category" required>
                                        @if ($method === 'create')
                                            <option value="" disabled selected>Select Category</option>
                                        @endif
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                    @if ($method === 'edit' and $category->id === $today_tag->category_id) selected @endif>
                                                {{ $category->category }}
                                            </option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="methodType" value="{{ $method }}">
                    <div class="d-flex justify-content-end gap-3 mt-3">
                        <a href="{{route('today-tag.index')}}" class="btn btn-light" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Back">Back
                        </a>
                        <button class="btn btn-primary" type="submit" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Save Setting Data Conf">Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
            $("#tag").select2({
                tags: true,
                placeholder: 'Select Tags',
                allowClear: true,
                tokenSeparators: [',', '\n'],
                ajax: {
                    url: "{{ route('tag.index') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function({
                        data
                    }) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.tags,
                                    text: item.tags
                                }
                            })
                        }
                    }
                }
            });

            $('#tag').change(function() {
                var tags = $('#tag').val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('tagging.edit') }}",
                        data: {
                            tags: tags,
                            _token: @json(csrf_token())
                        },
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(error) {
                        console.log(error, 'error auto save inline');
                    },
                });
            });
        });
    </script>
    <script>
        var tags = document.getElementById("form-group-tag");
        var url = document.getElementById("form-group-url");
        tags.style.display = 'none';
        url.style.display = 'none';

        function getType(selectObject) {
            var value = selectObject.value;
            
            if (value == 'external_link') {
                tags.style.display = 'none';
                url.style.display = 'block';
            }else{
                tags.style.display = 'block';
                url.style.display = 'none';
            }
        }
        var method = document.getElementById("methodType").value;
        if (method === 'edit') {
            var value = "{{ $method == 'edit' ? $today_tag->types:'' }}";
            console.log(value);
            if (value == 'external_link') {
                tags.style.display = 'none';
                url.style.display = 'block';
            }else{
                tags.style.display = 'block';
                url.style.display = 'none';
            }
        }
        console.log(method);
    </script>
@endsection
