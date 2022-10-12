<div>
    <div class="d-flex col-12">
        <div class="form-group w-100">
            <form action="{{ route('news.create') }}" method="get">
                <div class="d-flex gap-2">
                    <input type="text" class="form-control" name="search" style="width: 250px"
                        placeholder="search image" id="search_image_bank_input" />
                    <div class="btn btn-success col-2" id="search_image_bank_button"><i class="bi bi-search"></i>&nbsp; Search</div>
                </div>
            </form>
        </div>
    </div>
    <p class="fw-bold m-0 mt-2 mb-1">Image List</p>
    <input type="hidden" id="path_image" value="{{ rtrim(Storage::url(""), "///") }}">
    <div class="d-flex flex-wrap" id="image_list_parent">
        {{-- @foreach ($item as $image)
            <div class="image-card border p-0 d-flex flex-column align-items-center">
                <img src="{{ asset('storage/image_bank/' . $image->slug) }}" alt="" class="w-100 image_bank_modal" id="image_bank_modal">
                <p class="mx-2 font-14 mt-3 mb-1">{{ $image->title }}</p>
                <span class="mx-2 mb-2 btn-warning font-14 button-action button_image_bank_modal" data-bs-dismiss="modal"><i
                        class="bi bi-plus-circle"></i>&nbsp;&nbsp;Select</span>
            </div>
        @endforeach --}}
        {{-- @for ($i = 0; $i < 10; $i++)
            <div class="image-card border p-0 image-card border p-0 d-flex flex-column align-items-center">
                <img @if ($i % 2 == 0) src="{{ asset('assets/images/example_image.jpg') }}" 
                            @else     
                            src="{{ asset('assets/images/example_image_1.jpg') }}" @endif
                    alt="" class="w-100 image_bank_modal">
                <p class="mx-2 font-14 mt-3 mb-1">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                <span class="mx-2 btn-warning font-14 w-100 button-action button_image_bank_modal" data-bs-dismiss="modal"><i
                        class="bi bi-plus-circle"></i>&nbsp;&nbsp;Select</span>

            </div>
        @endfor --}}
    </div>
</div>
