<div class="card">
    <div class="card-header d-flex justify-content-between">
        <a data-bs-toggle="collapse" class="d-flex justify-content-between w-100" href="#cimage" aria-expanded="false"
            aria-controls="collapseExample">
            <span class="h4 text-capitalize m-0">Image</span>
            <i class="bi bi-chevron-up pull-right fs-6 me-3"></i>
            <i class="bi bi-chevron-down pull-right fs-6 me-3"></i>
        </a>
        <i class="bi bi-trash pull-right text-danger fw-bold"></i>
    </div>
    <div class="collapse show fade photonews" id="cimage">
        <div class="card-body d-flex flex-column gap-2">
            <div class="row">
                <div class="col-md-5 col-12">
                    <div class="form-group">
                        <div class="image-file-preview mt-3">
                            <img src="{{ asset('assets/images/preview-image.jpg') }}" alt="" srcset=""
                                id="image_preview_result">
                            {{-- <img src="@if (!isset($item)) {{ asset('assets/images/preview-image.jpg') }} @else {{ Storage::url($item->image) }} @endif"
                                            alt="" srcset="" id="image_preview_result"> --}}
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-end gap-3 mt-3 flex-column">
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Set as Main
                                    Image</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-12">
                    <div class="form-group">
                        <label for="caption" class="mb-2">Caption</label>
                        <input type="text" class="form-control" id="caption" name="caption"
                            placeholder="Enter Caption " required />
                    </div>
                    <div class="form-group">
                        <label for="copyright" class="mb-2">Copyright</label>
                        <input type="text" class="form-control" id="copyright" name="copyright"
                            placeholder="Enter Copyright " required />
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Keyword</label><br>
                        <input name="image_keywords" id="image_keywords" type="text" required
                            class="w-100 form-control" data-role="tagsinput" placeholder="Enter Keywords " />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="image_description" class="form-label mb-2">Description</label>
                <textarea name="image_description" class="form-control" id="image_description" cols="30" rows="3" required
                    placeholder="Enter Description"></textarea>
            </div>
        </div>
    </div>
</div>
