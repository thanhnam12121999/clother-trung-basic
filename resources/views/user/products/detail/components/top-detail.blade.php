<div class="row">
    <div class="col-lg-6">
        @php
            $isFeatureImageUrl = filter_var($product->feature_image, FILTER_VALIDATE_URL);
        @endphp
        <div class="product-pic-zoom">
            <img class="product-big-img" src="{{ $isFeatureImageUrl ? $product->feature_image : asset("admin/products/images/$product->feature_image") }}" alt="">
            <div class="zoom-icon">
                <i class="fa fa-search-plus"></i>
            </div>
        </div>
        <div class="product-thumbs">
            <div class="product-thumbs-track ps-slider owl-carousel">
                <div class="pt active" data-imgbigurl="{{ $isFeatureImageUrl ? $product->feature_image : asset("admin/products/images/$product->feature_image") }}">
                    <img src="{{ $isFeatureImageUrl ? $product->feature_image : asset("admin/products/images/$product->feature_image") }}" alt="">
                </div>
                @if (!empty($product->images))
                @foreach ($product->images as $productImg)
                    @php
                        $isImageUrl = filter_var($productImg->image, FILTER_VALIDATE_URL);
                    @endphp
                    <div class="pt" data-imgbigurl="{{ $isImageUrl ? $productImg->image : asset("admin/products/images/$productImg->image") }}">
                        <img src="{{ $isImageUrl ? $productImg->image : asset("admin/products/images/$productImg->image") }}" alt="">
                    </div>
                @endforeach
                @endif
                {{-- <div class="pt" data-imgbigurl="{{ asset('user/img/product-single/product-3.jpg') }}"><img
                        src="{{ asset('user/img/product-single/product-3.jpg') }}" alt=""></div>
                <div class="pt" data-imgbigurl="{{ asset('user/img/product-single/product-3.jpg') }}"><img
                        src="{{ asset('user/img/product-single/product-3.jpg') }}" alt=""></div> --}}
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="product-details">
            <div class="pd-title">
{{--                <span>oranges</span>--}}
                <h3>{{ $product->name }}</h3>
                <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a>
            </div>
            <div class="pd-rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
                <span>(5)</span>
            </div>
            <div class="pd-desc">
                <p>{{ $product->summary }}</p>
                <h4>200.000đ {{--<span>629.99</span>--}}</h4>
            </div>
            {{-- <div class="pd-color">
                <h6>Màu sắc</h6>
                <div class="pd-color-choose">
                    <div class="cc-item">
                        <input type="radio" id="cc-black">
                        <label for="cc-black"></label>
                    </div>
                    <div class="cc-item">
                        <input type="radio" id="cc-yellow">
                        <label for="cc-yellow" class="cc-yellow"></label>
                    </div>
                    <div class="cc-item">
                        <input type="radio" id="cc-violet">
                        <label for="cc-violet" class="cc-violet"></label>
                    </div>
                </div>
            </div>
            <div class="pd-size-choose">
                <div class="sc-item">
                    <input type="radio" id="sm-size">
                    <label for="sm-size">s</label>
                </div>
                <div class="sc-item">
                    <input type="radio" id="md-size">
                    <label for="md-size">m</label>
                </div>
                <div class="sc-item">
                    <input type="radio" id="lg-size">
                    <label for="lg-size">l</label>
                </div>
                <div class="sc-item">
                    <input type="radio" id="xl-size">
                    <label for="xl-size">xs</label>
                </div>
            </div> --}}
            <div class="quantity">
                <form action="{{ route('cart.add', ['slug' => $product->slug]) }}" method="post">
                    @csrf
                    <div class="pro-qty">
                        <input type="text" min="1" max="100" value="1" name="quantity">
                    </div>
                    <button style="border: none" type="submit" class="primary-btn pd-cart">Thêm giỏ hàng</button>
                </form>
            </div>
{{--            <ul class="pd-tags">--}}
{{--                <li><span>CATEGORIES</span>: More Accessories, Wallets & Cases</li>--}}
{{--                <li><span>TAGS</span>: Clothing, T-shirt, Woman</li>--}}
{{--            </ul>--}}
            <div class="pd-share">
{{--                <div class="p-code">Sku : 00012</div>--}}
                <div class="pd-social">
                    <a href="#"><i class="ti-facebook"></i></a>
                    <a href="#"><i class="ti-twitter-alt"></i></a>
                    <a href="#"><i class="ti-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
