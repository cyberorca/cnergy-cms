<div>
    <div class="d-flex col-12">
        <div class="form-group w-100">
            <form action="" method="get">
                <div class="d-flex gap-2">
                    <input type="text" class="form-control" id="basicInput" name="search" style="width: 250px"
                        placeholder="search image" />
                    <button class="btn btn-success col-2"><i class="bi bi-search"></i>&nbsp; Search</button>
                </div>
            </form>
        </div>
    </div>
    <p class="fw-bold m-0 mt-2 mb-1">Image List</p>
    <div class="d-flex flex-wrap">
        @foreach ($item as $image)
            <div class="image-card border p-0 d-flex flex-column align-items-center">
                <img src="{{ asset('storage/image_bank/' . $image->slug) }}" alt="" class="w-100 image_bank_modal" id="image_bank_modal">
                <p class="mx-2 font-14 mt-3 mb-1">{{ $image->title }}</p>
                <button class="mx-2 mb-2 btn-warning font-14 button-action button_image_bank_modal" data-bs-dismiss="modal"><i
                        class="bi bi-plus-circle"></i>&nbsp;&nbsp;Select</button>
            </div>
        @endforeach
        {{-- @for ($i = 0; $i < 10; $i++)
        <div class="image-card border p-0">
            <img @if ($i % 2 == 0) src="{{ asset('assets/images/example_image.jpg') }}" 
                            @else     
                            src="{{ asset('assets/images/example_image_1.jpg') }}" @endif
                alt="" class="w-100">
            <div class="d-flex flex-column gap-2 p-2">
                <p class="m-0 font-14">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
                <div class="d-flex">
                    <button class="btn-warning font-14 w-100 button-action"><i class="bi bi-plus-circle"></i>&nbsp;&nbsp;Select</button>
                </div>
            </div>
        </div>
        @endfor --}}
    </div>
</div>
