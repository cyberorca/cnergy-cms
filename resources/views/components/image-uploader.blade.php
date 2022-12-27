<div>
    <div class="d-flex input-file-uploader">
        <span class="w-100 btn btn-success d-flex justify-content-center align-items-center" data-bs-toggle="modal"
            data-bs-target="#image-bank" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Image" id="upload_image_bank_button"><i
                class="bi bi-upload mb-2"></i>&nbsp;&nbsp;
            Add Image</span>
        <input type="hidden" name="upload_image_selected" id="upload_image_selected"  value="@if (isset($item)) {{ Storage::url($item->image) }} @endif"/>
        {{-- <span class="border">OR</span>
        <div class="input-upload-file">
            <input type="file" name="upload_image" id="upload_image_button" />
            <span class="btn btn-succsess d-flex justify-content-center align-items-center"><i class="bi bi-upload mb-2"></i>
            Upload File</span>
        </div> --}}
    </div>
    <div class="image-file-preview mt-3">
        
        <img src="@if (!isset($item)) {{ asset('assets/images/preview-image.jpg') }} @else {{ Storage::url($item->image) }} @endif"
            alt="" srcset="" id="image_preview_result" selectedImage="false">
    </div>

    {{-- <div class="p-2 px-3 border mt-2">
        <p class="m-0" id="image_title">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab officiis non architecto odit.</p>
    </div> --}}
    <hr>
    <div class="modal fade text-left" id="image-bank" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true" aria-type="{{ $type }}">
        <div class="modal-dialog modal-dialog-scrollable d-flex justify-content-center modal-xl" role="document" style="z-index: 1000">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Image Bank</h5>
                    <button type="button" class="close rounded-pill close-modals-button" id="" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile"
                                role="tab" aria-controls="profile" aria-selected="true">Image Bank</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Insert Image</a>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab"
                                aria-controls="contact" aria-selected="false">Image URL</a>
                        </li> --}}
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="py-3 px-1" id="form-upload-image">
                                <div class="form-group">
                                    <label for="site_logo" class="mb-2">Image File</label>
                                    <div
                                        class="d-flex flex-column align-items-center justify-content-center image-file-preview">
                                        <img src="{{ asset('assets/images/preview-image.jpg') }}"
                                            class="mb-3 image-preview" alt="Your Image" id="image_preview_modal">
                                        <input type="file" class="form-control" name="image_input"
                                            id="upload_image_button" accept="image/*" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="basicInput" class="mb-2">Title</label>
                                    <input type="text" class="form-control" id="basicInput" name="title_image"
                                        placeholder="Enter image title" />
                                </div>
                                <div class="form-group">
                                    <label for="basicInput" class="mb-2">Image Alt</label>
                                    <input type="text" class="form-control " id="basicInput" name="image_alt"
                                        placeholder="Enter image alt" />
                                </div>
                                <div class="form-group">
                                    <label for="site_logo" class="mb-2">Photographer</label>
                                    <div class="flex flex-column">
                                        <input type="text" class="form-control" id="basicInput" name="photographer"
                                            placeholder="Enter image photographer" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="site_logo" class="mb-2">Copyright</label>
                                    <div class="flex flex-column">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">&copy;
                                                {{ Date::now()->year }}</span>
                                            <input type="text" class="form-control" id="basicInput"
                                                name="copyright" placeholder="techno.id" value=""
                                                aria-describedby="basic-addon1" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="site_logo" class="mb-2">Caption</label>
                                    <div class="flex flex-column">
                                        <input type="text" class="form-control" id="basicInput" name="caption"
                                            placeholder="Enter image caption" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="site_logo" class="mb-2">Keywords</label>
                                    <div class="flex flex-column">
                                        <input name="keywords" id="keywords" type="text" 
                                            placeholder="Enter Keyword" class="w-100 form-control"
                                            data-role="tagsinput" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="site_logo" class="mb-2">Description</label>
                                    <div class="d-flex flex-column">
                                        <textarea name="description_image" class="form-control" id="description" cols="30" rows="3"
                                            placeholder="Enter Description"></textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end w-100">
                                    {{-- data-bs-dismiss="modal" --}}
                                    <button class="btn btn-primary" type="button" id="save_uploaded_image">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-sm-block"><i class="bi bi-save"></i>&nbsp;&nbsp;Upload
                                            Image</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade p-2 py-3 show active" id="profile" role="tabpanel"
                            aria-labelledby="profile-tab">
                            <x-image-bank />
                        </div>

                        {{-- <div class="tab-pane fade p-2 py-3" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="form-group">
                                <label for="site_logo" class="mb-2">Image URL</label>
                                <div class="flex flex-column">
                                    <input type="text" class="form-control @error('image_url') is-invalid @enderror"
                                        id="basicInput" name="image_url" placeholder="Enter image url" />
                                    @error('image_url')
                                        <div class="invalid-feedback">
                                            <i class="bx bx-radio-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-check me-auto">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" id="add_meta_image_checkbox" value="false">
                            Add caption, copyright & photographer below image
                        </label>
                    </div>
                    @if ($type === 'photonews')
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal" id="save_photo_news"
                            disabled>
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Save Image</span>
                        </button>
                    @endif
                    <button type="button" class="btn btn-outline-secondary close-modals-button" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block close-modals-button">Cancel</span>
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
