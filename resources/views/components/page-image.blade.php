<div class="card" id="imagephotonews-{{ $item->id }}">
    <div class="card-header d-flex justify-content-between">
        <a data-bs-toggle="collapse" class="d-flex justify-content-between w-100" href="#photonews-{{ $item->id }}"
            aria-expanded="false" aria-controls="collapseExample">
            <span class="h4 text-capitalize m-0">Image</span>
            <i class="bi bi-chevron-up pull-right fs-6 me-3"></i>
            <i class="bi bi-chevron-down pull-right fs-6 me-3"></i>
        </a>
        <i class="bi bi-trash pull-right text-danger fw-bold" id="{{ $item->id }}"></i> 
    </div>
    <div class="collapse show fade photonews" id="photonews-{{ $item->id }}">
        <div class="card-body d-flex flex-column gap-2">
            <div class="row">
                <div class="col-md-5 col-12">
                    <div class="form-group">
                        <div class="image-file-preview mt-3">
                            <img src="{{ Storage::url($item->url) }}" alt="" srcset=""
                            >
                            <input type="hidden" name="photonews[old][{{ $item->id }}][url]"
                                value="{{ $item->url }}"/>
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-end gap-3 mt-3 flex-column">
                                <span url-data="{{ Storage::url($item->url) }}"
                                    id="#button-photonews-selected-{{ $item->id }}"
                                    class="btn btn-light-secondary me-1 mb-1 button-old-photo-news">Set as Main
                                    Image</span>
                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-12">
                    <div class="form-group">
                        <label for="caption" class="mb-2">Caption</label>
                        <input type="text" class="form-control" id="caption" name="photonews[old][{{ $item->id }}][caption]"
                            placeholder="Enter Caption " required value="{{ $item->image }}" />
                            <input type="hidden" class="form-control" id="caption" name="photonews[old][{{ $item->id }}][is_active]"
                            placeholder="Enter Caption " required value="{{ $item->is_active }}" />
                            <input type="hidden" class="form-control" id="caption" name="photonews[old][{{ $item->id }}][created_by]"
                            placeholder="Enter Caption " required value="{{ $item->created_by }}" />
                            <input type="hidden" class="form-control" id="caption" name="photonews[old][{{ $item->id }}][updated_by]"
                            placeholder="Enter Caption " required value="{{ $item->updated_by }}" />
                    </div>
                    <div class="form-group">
                        <label for="copyright" class="mb-2">Copyright</label>
                        <input type="text" class="form-control" id="copyright" name="photonews[old][{{ $item->id }}][copyright]"
                            placeholder="Enter Copyright " required value="{{ $item->copyright }}" />
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Keyword</label><br>
                        <input name="photonews[old][{{ $item->id }}][keywords]" id="image_keywords" type="text" required
                            class="w-100 form-control" data-role="tagsinput" placeholder="Enter Keywords "
                            value="{{ $item->keywords }}" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="image_description" class="form-label mb-2">Description</label>
                <textarea name="photonews[old][{{ $item->id }}][description]" class="form-control" id="image_description" cols="30" rows="3" required
                    placeholder="Enter Description">{{ $item->description }}</textarea>
            </div>
        </div>
    </div>
</div>
