<div class="card-columns">
    @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category->id) as $key => $first_level_id)
        <div class="card shadow-none border-0">
            <ul class="list-unstyled mb-3">
                <li class="fw-600 border-bottom pb-2 mb-3">
                    @php
                 $sub=   \App\Category::find(@$first_level_id);
                 $error_product = json_decode(get_setting('error_product'), true); 

                    @endphp
                    <a class="text-reset" href="{{ route('products.category', \App\Category::find(@$first_level_id)->slug) }}">
                          <img
                        onerror="this.onerror=null;this.src='{{ uploaded_asset($error_product) }}';"
                        src="{{uploaded_asset($error_product) }}"
                        class="cat-image lazyload mr-2 opacity-60"
                        data-src="{{ uploaded_asset(@$sub->icon) }}"
                        width="16"
                        alt="{{ @$sub->getTranslation('name') }}"
                    >{{ \App\Category::find(@$first_level_id)->getTranslation('name') }}</a>
                </li>
                @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($first_level_id) as $key => $second_level_id)
                    <li class="mb-2">
                        <a class="text-reset" href="{{ route('products.category', \App\Category::find($second_level_id)->slug) }}" >{{ \App\Category::find($second_level_id)->getTranslation('name') }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
