 <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
    <div class="filter-widget">
        <h4 class="fw-title">Danh mục</h4>
        <ul class="filter-catagories">
            @foreach ($categories as $cate)
                <li><a href="{{ route('products.slug', ['slug' => $cate->slug]) }}">{{ $cate->name }}</a></li>
            @endforeach
        </ul>
    </div>
    {{--    <div class="filter-widget">--}}
    {{--        <h4 class="fw-title">Brand</h4>--}}
    {{--        <div class="fw-brand-check">--}}
    {{--            <div class="bc-item">--}}
    {{--                <label for="bc-calvin">--}}
    {{--                    Calvin Klein--}}
    {{--                    <input type="checkbox" id="bc-calvin">--}}
    {{--                    <span class="checkmark"></span>--}}
    {{--                </label>--}}
    {{--            </div>--}}
    {{--            <div class="bc-item">--}}
    {{--                <label for="bc-diesel">--}}
    {{--                    Diesel--}}
    {{--                    <input type="checkbox" id="bc-diesel">--}}
    {{--                    <span class="checkmark"></span>--}}
    {{--                </label>--}}
    {{--            </div>--}}
    {{--            <div class="bc-item">--}}
    {{--                <label for="bc-polo">--}}
    {{--                    Polo--}}
    {{--                    <input type="checkbox" id="bc-polo">--}}
    {{--                    <span class="checkmark"></span>--}}
    {{--                </label>--}}
    {{--            </div>--}}
    {{--            <div class="bc-item">--}}
    {{--                <label for="bc-tommy">--}}
    {{--                    Tommy Hilfiger--}}
    {{--                    <input type="checkbox" id="bc-tommy">--}}
    {{--                    <span class="checkmark"></span>--}}
    {{--                </label>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <div class="filter-widget">
        <h4 class="fw-title">Giá</h4>
        <div class="filter-range-wrap custom_filter-price-range">
            <div class="range-slider custom_range-slider">
                <div class="price-input custom_price-input">
                    <input type="text" id="minamount">
                    <input type="text" id="maxamount">
                </div>
            </div>
            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                 data-min="50" data-max="500">
                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
            </div>
        </div>
        <a href="#" class="filter-btn">Lọc</a>
    </div>
    <div class="filter-widget">
        <h4 class="fw-title">Màu sắc</h4>
        <div class="fw-color-choose">
            <div class="cs-item">
                <input type="radio" id="cs-black">
                <label class="cs-black" for="cs-black">Đen</label>
            </div>
            <div class="cs-item">
                <input type="radio" id="cs-violet">
                <label class="cs-white" for="cs-white">Trắng</label>
            </div>
            {{--            <div class="cs-item">--}}
            {{--                <input type="radio" id="cs-blue">--}}
            {{--                <label class="cs-blue" for="cs-blue">Xanh</label>--}}
            {{--            </div>--}}
            <div class="cs-item">
                <input type="radio" id="cs-yellow">
                <label class="cs-yellow" for="cs-yellow">Vàng</label>
            </div>
            <div class="cs-item">
                <input type="radio" id="cs-red">
                <label class="cs-red" for="cs-red">Đỏ</label>
            </div>
            {{--            <div class="cs-item">--}}
            {{--                <input type="radio" id="cs-green">--}}
            {{--                <label class="cs-green" for="cs-green">Green</label>--}}
            {{--            </div>--}}
        </div>
    </div>
    <div class="filter-widget">
        <h4 class="fw-title">Size</h4>
        <div class="fw-size-choose">
            <div class="sc-item">
                <input type="radio" id="s-size">
                <label for="s-size">s</label>
            </div>
            <div class="sc-item">
                <input type="radio" id="m-size">
                <label for="m-size">m</label>
            </div>
            <div class="sc-item">
                <input type="radio" id="l-size">
                <label for="l-size">l</label>
            </div>
            <div class="sc-item">
                <input type="radio" id="xs-size">
                <label for="xs-size">xs</label>
            </div>
        </div>
    </div>
    {{--    <div class="filter-widget">--}}
    {{--        <h4 class="fw-title">Tags</h4>--}}
    {{--        <div class="fw-tags">--}}
    {{--            <a href="#">Towel</a>--}}
    {{--            <a href="#">Shoes</a>--}}
    {{--            <a href="#">Coat</a>--}}
    {{--            <a href="#">Dresses</a>--}}
    {{--            <a href="#">Trousers</a>--}}
    {{--            <a href="#">Men's hats</a>--}}
    {{--            <a href="#">Backpack</a>--}}
    {{--        </div>--}}
    {{--    </div>--}}
</div>
