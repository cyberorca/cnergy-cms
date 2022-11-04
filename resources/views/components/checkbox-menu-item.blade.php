{{--<div>--}}
<!-- list groups simple & disabled start -->
<div class="col-lg-12">
    <div class="accordion my-1">
        {{--        <div class="accordion-item p-3">--}}
        {{--            <div class="d-flex flex-row">--}}
        {{--                <label for="input">--}}
        {{--                    <input type="checkbox" id="input"--}}
        {{--                           class="parentCheckBox{{ $item->id}} form-check-inline  form-check-success "--}}
        {{--                           name="checkMenu[]"--}}
        {{--                           value="{{ $item->id }}"--}}
        {{--                           @if ($method === 'edit')--}}
        {{--                           @if($item->roles()->find(request()->segment(4)))--}}
        {{--                           checked--}}
        {{--                        @endif--}}
        {{--                        @endif--}}
        {{--                    >--}}
        {{--                </label>--}}
        {{--                <div class="d-flex flex-row justify-content-between w-100">--}}
        {{--                    <a data-bs-toggle="collapse"--}}
        {{--                       class="w-100 collapsed"--}}
        {{--                       href="#multiCollapseExample{{ $item->id }}"--}}
        {{--                       aria-expanded="false">--}}
        {{--                        {{ $item->menu_name() }}--}}
        {{--                    </a>--}}
        {{--                    <i class="bi bi-caret-down"></i>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div id="accordionActive{{$item->id}}" class="parentAccordion{{$item->id}}">
            <div class=" d-flex align-items-center">
                <label class="form-check-label" for="customColorCheck3"></label>
                <input type="checkbox"
                       class="parentCheckBox{{ $item->id}}  form-check-input-custom form-check-success "
                       name="checkMenu[]"
                       value="{{ $item->id }}"
                       @if ($method === 'edit')
                       @if($item->roles()->find(request()->segment(4)))
                       checked
                    @endif
                    @endif
                >
                @if(count($item->childs())>0)
                    <a data-bs-toggle="collapse" id="a-accordion-custom"
                       class="accordion-button-custom collapsed"
                       href="#multiCollapseExample{{ $item->id }}"
                       aria-expanded="false">
                        {{ $item->menu_name() }}
                    </a>
                @else
                    <a data-bs-toggle="collapse" id="a-accordion-custom"
                       class="accordion-button-custom-empty collapsed"
                       href="#multiCollapseExample{{ $item->id }}"
                       aria-expanded="false">
                        {{ $item->menu_name() }}
                    </a>
                @endif

            </div>
        </div>
    </div>

</div>
<!-- list groups simple & disabled end -->
{{--</div>--}}
{{--@if ($item->childs() !== null)--}}
{{--    <div id="collapse-{{ $item->id }}" class="accordion-collapse collapse show"--}}
{{--         aria-labelledby="heading-{{ $item->id }}">--}}
{{--        <div class="accordion-body pe-0 py-0 border-0 d-flex flex-column">--}}
{{--            @foreach ($item->childs() as $child)--}}
{{--                <x-checkbox-menu-item :item="$child" />--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endif--}}
<div class=" collapse multi-collapse"
     id="multiCollapseExample{{ $item->id }}">
    {{--    @if ($item->childs() !== null)--}}
    @foreach ($item->childs() as $child)
        <div class="ms-5">
            <x-checkbox-menu-item :item="$child"/>
        </div>

        {{--                        <div class="custom-control custom-checkbox">--}}
        {{--                            <input type="checkbox"--}}
        {{--                                   class="childCheckBox{{ $menu->id }} ms-1 form-check-input form-check-success"--}}
        {{--                                   name="checkMenuChild[{{ $item->id }}][{{ $menu->id }}]"--}}
        {{--                                   value="{{ $menu->id }}"--}}
        {{--                                   @if ($method === 'edit')--}}
        {{--                                   @if ($item->roles()->find($role->id)) checked @endif--}}
        {{--                                   @endif--}}
        {{--                                   id="customColorCheck2">--}}
        {{--                            <label class="form-check-label"--}}
        {{--                                   for="customColorCheck2">{{ $menu->menu_name() }}</label>--}}
        {{--                        </div>--}}
        <script>
            $(".parentCheckBox{{$item->id}}").click(
                function () {
                    let getParent = document.querySelector(".parentCheckBox{{ $item->id }}")
                    let getChild = document.querySelector(".parentCheckBox{{ $child->id }} ")
                    if (getParent.checked == true) {
                        getChild.checked = true
                    } else {
                        getChild.checked = false
                    }
                }
            )
            $("#accordionActive{{$item->id}}").click(
                function () {
                    if (this.classList.contains("accordion-active")){
                        this.classList.remove("accordion-active")
                    }else {
                        this.classList.add("accordion-active")
                    }

                }
            )
        </script>
    @endforeach
    {{--    @endif--}}
</div>
