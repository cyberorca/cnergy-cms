<div>
    <!-- list groups simple & disabled start -->
    <div class="col-lg-12">
        <div class="accordion">
            <p class="w-100 accordion-item">
            <div class="custom-control custom-checkbox d-flex align-items-center">
                <input type="checkbox"
                       class="parentCheckBox{{ $item->id}}  form-check-input form-check-success "
                       name="checkMenu[]"
                       value="{{ $item->id }}"
                       @if ($method === 'edit')
                           @if($item->roles()->find(request()->segment(4)))
                       checked
                       @endif
                    @endif
                >
                <label class="form-check-label" for="customColorCheck3"></label>
                <a data-bs-toggle="collapse" class="accordion-button"
                   href="#multiCollapseExample{{ $item->id }}"
                   aria-expanded="false">
                    {{ $item->menu_name() }}
                </a>
            </div>
            </p>

        </div>
    </div>
    <!-- list groups simple & disabled end -->
</div>
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
    @if ($item->childs() !== null)
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
                $(".parentCheckBox{{ $item->id }}").click(
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
            </script>
        @endforeach
    @endif
</div>
