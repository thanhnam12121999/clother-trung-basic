<div class="row">
    <div class="col-lg-6">
        @php
            $isFeatureImageUrl = filter_var($product->feature_image, FILTER_VALIDATE_URL);
        @endphp
        <div class="product-pic-zoom">
            <img class="product-big-img" src="{{ $isFeatureImageUrl ? $product->feature_image : $product->feature_image_path }}" alt="">
            <div class="zoom-icon">
                <i class="fa fa-search-plus"></i>
            </div>
        </div>
        <div class="product-thumbs">
            <div class="product-thumbs-track ps-slider owl-carousel">
                <div class="pt active" data-imgbigurl="{{ $isFeatureImageUrl ? $product->feature_image : $product->feature_image_path }}">
                    <img src="{{ $isFeatureImageUrl ? $product->feature_image : $product->feature_image_path }}" alt="">
                </div>
                @if (!empty($product->images))
                @foreach ($product->images as $productImg)
                    @php
                        $isImageUrl = filter_var($productImg->image, FILTER_VALIDATE_URL);
                    @endphp
                    <div class="pt" data-imgbigurl="{{ $isImageUrl ? $productImg->image : $productImg->image_path }}">
                        <img src="{{ $isImageUrl ? $productImg->image : $productImg->image_path }}" alt="">
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
        <form action="{{ route('cart.add', ['slug' => $product->slug]) }}" method="post">
        @csrf
            <div class="product-details">
                <div class="pd-title">
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
                    <h4 id="pd-price">{{ number_format($minPrice, 0, ",", ".") }}đ - {{ number_format($maxPrice, 0, ",", ".") }}đ {{--<span>629.99</span>--}}</h4>
                    <input type="hidden" id="variantPrice" name="variant_price" value="">
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
                </div> --}}
                <div class="mb-2 product-attributes">
                    @php
                        $attrIds = array_keys($productAttributes->toArray());
                        $attrIdsEncode = json_encode($attrIds);
                    @endphp
                    @foreach ($productAttributes as $attrId => $productAttr)
                        <div class="product-attributes__option">
                            <h5 class="mb-2 product-attributes__title">{{ $productAttr }}</h5>
                            <div class="product-attributes__values">
                                @php
                                    $productAttrValues = $attrValues->get($attrId)->all();
                                @endphp
                                @foreach ($productAttrValues as $attrValueId => $attrValue)
                                    <div class="attribute-value">
                                        <input type="radio" id="value--{{$attrValueId}}" data-attr-id="{{$attrId}}" name="attributes[{{$attrId}}]" value="{{$attrValueId}}">
                                        <label for="value--{{$attrValueId}}">{{ $attrValue }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    <input type="hidden" id="attrIds" name="attr_ids" value="{{$attrIdsEncode}}">
                </div>
                <div class="pd-amount">
                    <p class="pd-amount__text">{{$totalAmountProduct}} sản phẩm có sẵn</p>
                    <input type="hidden" name="variant_amount" id="variantAmount" value="">
                </div>
                <div class="quantity">
                    <div class="pro-qty">
                        <input type="number" min="1" value="1" name="quantity">
                    </div>
                    <button style="border: none" type="submit" class="primary-btn pd-cart">Thêm giỏ hàng</button>
                </div>
            {{-- <ul class="pd-tags">
                <li><span>CATEGORIES</span>: More Accessories, Wallets & Cases</li>
                <li><span>TAGS</span>: Clothing, T-shirt, Woman</li>
            </ul> --}}
                <div class="pd-share">
                    {{-- <div class="p-code">Sku : 00012</div> --}}
                    <div class="pd-social">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"><i class="ti-twitter-alt"></i></a>
                        <a href="#"><i class="ti-linkedin"></i></a>
                    </div>
                </div>
                <input type="hidden" id="productId" name="product_id" value="{{$product->id}}">
                <input type="hidden" id="variantId" name="variant_id" value="">
            </div>
        </form>
    </div>
</div>
