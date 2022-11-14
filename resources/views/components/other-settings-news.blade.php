<div class="col-4">
    <div class="card">
        <div class="card-body">
            <a data-bs-toggle="collapse" href="#satu" aria-expanded="false" aria-controls="collapseExample">
                <span class="h6">Status & Visibility</span>
                <i class="bi bi-chevron-up pull-right fs-6"></i>
                <i class="bi bi-chevron-down pull-right fs-6"></i>
            </a>
            <hr />
            <div class="collapse show fade" id="satu">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="basicInput">Publish Status</label>
                        </div>
                        <div class="col-md-6">
                            <input class="form-check-input" type="radio" value="1" name="isPublished"
                                @if ($method === 'edit' and $news->is_published == '1') checked @endif />
                            <label class="form-check-label">
                                On
                            </label>
                            <input class="form-check-input" type="radio" value="0" name="isPublished"
                                @if ($method === 'edit' and $news->is_published == '0') checked @endif />
                            <label class="form-check-label">
                                Off
                            </label>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="publishedAt">Schedule</label>
                        </div>
                        <div class="col-md-6">
                            <input type="date" class="example" name="date"
                                @if ($method === 'edit') value="{{ date('Y-m-d', strtotime($news->published_at)) }}" @endif>
                            <input type="time" class="example" name="time"
                                @if ($method === 'edit') value="{{ date('H:i', strtotime($news->published_at)) }}" @endif>
                            <input class="" type="text" name="jQueryScript" value=" "
                                done="true" style="display: none;">
                        </div>
                    </div>
                </div>
            </div>


            <a data-bs-toggle="collapse" href="#dua" aria-expanded="false"
                aria-controls="collapseExample">
                <span class="h6">Picture</span>
                <i class="bi bi-chevron-up pull-right fs-6"></i>
                <i class="bi bi-chevron-down pull-right fs-6"></i>
            </a>
            <hr />
            <div class="collapse show fade" id="dua">
                <div class="form-group">
                    @if (isset($news))
                        <x-image-uploader :item="$news" :type="$type" />
                    @else
                        <x-image-uploader
                            :type="$type"
                        />
                    @endif
                </div>
            </div>


            <a data-bs-toggle="collapse" href="#sembilan" aria-expanded="false"
                aria-controls="collapseExample">
                <span class="h6">Category</span>
                <i class="bi bi-chevron-up pull-right fs-6"></i>
                <i class="bi bi-chevron-down pull-right fs-6"></i>
            </a>
            <hr />
            <div class="collapse show fade" id="sembilan">
                <div class="form-group">
                    <div class="row">
                        <fieldset class="form-group">
                            <select class="form-select" name="category" id="category">
                                @if ($method === 'create')
                                    <option value="" disabled selected>Select Category</option>
                                @endif
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        @if ($method === 'edit' and $category->id === $news->category_id) selected @endif>
                                        {{ $category->category }}
                                    </option>
                                @endforeach
                            </select>
                            <br>
                        </fieldset>

                    </div>
                </div>
                <div class="form-group">

                </div>
            </div>

                


            <a data-bs-toggle="collapse" href="#tiga" aria-expanded="false"
                aria-controls="collapseExample">
                <span class="h6">Tags</span>
                <i class="bi bi-chevron-up pull-right fs-6"></i>
                <i class="bi bi-chevron-down pull-right fs-6"></i>
            </a>
            <hr />
            <div class="collapse show fade" id="tiga">
                <div class="form-group">
                    <div class="row">
                        <select name="tags[]" class="form-select" style='width: 100%;' multiple="multiple"
                            id="tags" required>
                            @if ($method === 'edit')
                                @foreach ($tags as $id => $tag)
                                    <option id="{{ $id }}" value="{{ $tag->id }}"
                                        @if ($method === 'edit' and $tag->news()->find($news->id)) selected @endif>{{ $tag->tags }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <br>
            </div>


            <a data-bs-toggle="collapse" href="#tujuh" aria-expanded="false"
                aria-controls="collapseExample">
                <span class="h6">Description</span>
                <i class="bi bi-chevron-up pull-right fs-6"></i>
                <i class="bi bi-chevron-down pull-right fs-6"></i>
            </a>
            <hr />
            <div class="collapse show fade" id="tujuh">
                <div class="form-group">
                    <textarea name="description" class="form-control" id="description" cols="30" rows="3" required
                        placeholder="Enter description">@if($method === 'edit'){{ $news->description }}@endif</textarea>

                </div>
            </div>

            <!--<a data-bs-toggle="collapse"  href="#delapan">
                                                                    <i class="bi bi-chevron-down fs-6" style="float:right"></i>
                                                                    <span class="h6">Author</span>
                                                                </a>
                                                                <hr />
                                                                <div class="collapse show fade" id="delapan">
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <select name="author[]" class="choices form-select multiple-remove"
                                                                            multiple="multiple"
                                                                            id="author">
                                                                                <optgroup label="Author">


                                                                                </optgroup>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>-->


            <a data-bs-toggle="collapse" href="#empat" aria-expanded="false"
                aria-controls="collapseExample">
                <span class="h6">Other Settings</span>
                <i class="bi bi-chevron-up pull-right fs-6"></i>
                <i class="bi bi-chevron-down pull-right fs-6"></i>
            </a>
            <hr />
            <div class="collapse show fade" id="empat">
                {{--<div class="form-group">
                    <label class="mb-2">Keyword</label><br>
                    <input name="keywords" id="keywords" type="text" required
                        @if ($method === 'create') placeholder="Enter Keyword" @endif
                        class="w-100 form-control" data-role="tagsinput"
                        @if ($method === 'edit') value="{{ $news->keywords }}" @endif />
                </div>--}}
                
                <div class="form-group">
                    <div class="row">
                    <label class="mb-2">Keyword</label><br>
                        <select name="keywords[]" class="form-select" style='width: 100%;' multiple="multiple"
                            id="keyword" required>
                            @if ($method === 'edit')
                                @foreach ($keywords as $id => $keyword)
                                    <option id="{{ $id }}" value="{{ $keyword->id }}"
                                        @if ($method === 'edit' and $keyword->news()->find($news->id)) selected @endif>{{ $keyword->keywords }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="mb-2">Reporter</label><br>
                    <select name="reporters[]"
                            class="choices form-select multiple-remove"
                            multiple="multiple"
                            id="reporter">
                        <optgroup label="reporter">
                            @foreach($users as $user)
                                @if($user->roles->role === 'Reporter')
                                    <option
                                        @if ($method === 'edit' and is_null(json_decode($news->reporters))==false)
                                        @if(in_array($user->uuid,json_decode($news->reporters)))
                                        selected
                                        @endif
                                        @endif
                                        value="{{$user->uuid}}">{{$user->name}}</option>
                                @endif
                            @endforeach
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <label class="mb-2">Photographer</label><br>
                    <select name="photographers[]"
                            class="choices form-select multiple-remove"
                            multiple="multiple"
                            id="photographer">
                        <optgroup label="photographer">
                            @foreach($users as $user)
                                @if($user->roles->role === 'Photographer')
                                    <option
                                        @if ($method === 'edit' and is_null(json_decode($news->photographers))==false)
                                        @if(in_array($user->uuid,json_decode($news->photographers)))
                                        selected
                                        @endif
                                        @endif
                                        value="{{$user->uuid}}">{{$user->name}}</option>
                                @endif
                            @endforeach
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <label class="mb-2">Contributor</label><br>
                    <select name="contributors[]"
                            class="choices form-select multiple-remove"
                            multiple="multiple"
                            id="contributor">
                        <optgroup label="contributor">
                            @foreach($contributors as $contributor)
                                <option
                                    @if ($method === 'edit' and is_null(json_decode($news->contributors))==false)
                                    @if(in_array($contributor->uuid,json_decode($news->contributors)))
                                    selected
                                    @endif
                                    @endif
                                    value="{{$contributor->uuid}}"
                                >{{$contributor->name}}</option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>
            <a data-bs-toggle="collapse" href="#lima" aria-expanded="false"
                aria-controls="collapseExample">
                <span class="h6">Content Type</span>
                <i class="bi bi-chevron-up pull-right fs-6"></i>
                <i class="bi bi-chevron-down pull-right fs-6"></i>
            </a>
            <hr />
            <div class="collapse show fade" id="lima">
                <div class="form-group">

                    <input name="isCurated" class="form-check-input" type="checkbox" id="isCurated"
                        @if ($method === 'edit' and $news->is_curated == '1') checked @endif />
                    <label class="form-check-label" for="isCurated">Curated/Feed</label>
                    <br>
                    <input name="isAdultContent" class="form-check-input" type="checkbox"
                        id="isAdultContent" @if ($method === 'edit' and $news->is_adult_content == '1') checked @endif />
                    <label class="form-check-label" for="isAdultContent">Adult Content(18+)</label>
                    <br>
                    <input name="isVerifyAge" class="form-check-input" type="checkbox" id="isVerifyAge"
                        @if ($method === 'edit' and $news->is_verify_age == '1') checked @endif />
                    <label class="form-check-label" for="isVerifyAge">Verify Age(18+)</label>
                    <br>
                    <input name="isHomeHeadline" class="form-check-input" type="checkbox"
                        id="isHomeHeadline" @if ($method === 'edit' and $news->is_home_headline == '1') checked @endif />
                    <label class="form-check-label" for="isHomeHeadline">Home Headline</label>
                    <br>
                    <input name="isCategoryHeadline" class="form-check-input" type="checkbox"
                        id="isCategoryHeadline" @if ($method === 'edit' and $news->is_category_headline == '1') checked @endif />
                    <label class="form-check-label" for="isCategoryHeadline">Category
                        Headline</label>
                    <br>
                    <input name="isAdvertorial" class="form-check-input" type="checkbox" id="isAdvertorial"
                        @if ($method === 'edit' and $news->is_advertorial == '1') checked @endif />
                    <label class="form-check-label" for="isAdvertorial">Advertorial</label>
                    <br>
                    <input name="isSeo" class="form-check-input" type="checkbox" id="isSeo"
                        @if ($method === 'edit' and $news->is_seo == '1') checked @endif />
                    <label class="form-check-label" for="isSeo">SEO</label>
                    <br>
                    <input name="isDisableInteractions" class="form-check-input" type="checkbox"
                        id="isDisableInteractions" @if ($method === 'edit' and $news->is_disable_interactions == '1') checked @endif />
                    <label class="form-check-label" for="isDisableInteractions">Disable
                        Interactions</label>
                    <br>
                    <input name="isBrandedContent" class="form-check-input" type="checkbox"
                        id="isBrandedContent" @if ($method === 'edit' and $news->is_branded_content == '1') checked @endif />
                    <label class="form-check-label" for="isBrandedContent">Branded Content</label>
                    <br>
                    <input name="isHeadline" class="form-check-input" type="checkbox" id="isHeadline"
                        @if ($method === 'edit' and $news->is_headline == '1') checked @endif />
                    <label class="form-check-label" for="isHeadline">Headline</label>
                    <br>
                    <input name="editorPick" class="form-check-input" type="checkbox" id="editorPick"
                        @if ($method === 'edit' and $news->editor_pick == '1') checked @endif />
                    <label class="form-check-label" for="editorPick">Editor Pick</label>
                </div>
            </div>
            <div class="d-flex justify-content-end gap-3 mt-3 flex-column">
                <button class="btn btn-primary w-100" name="save" type="submit" data-bs-toggle="tooltip"
                    value="publish" data-bs-placement="top" title="Create Role">Save
                </button>
                <a href="{{ route('news.index') }}" class="btn btn-outline-secondary w-100"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Back to Table Rome">Back</a>

            </div>
        </div>
    </div>
</div>