<div>
    <div class="d-flex justify-content-end col-12">
        <div class="form-group">
            <div class="flex flex-column">
                <button class="btn btn-success"><i class="bi bi-search"></i>&nbsp; Search</button>
            </div>
        </div>
    </div>
    <p class="fw-bold m-0 mt-2 mb-1">Image List</p>
    <div class="d-flex flex-wrap">
        @for ($i = 0; $i < 10; $i++)
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
        @endfor
    </div>
</div>
