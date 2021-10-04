@extends('admin.layouts.master')
@section('custom-css')
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
@endsection
@section('my-css')
    <link rel="stylesheet" href="{{ asset('admin/products/detail/product-detail.css') }}">
@endsection
@section('breadcrumb', 'Chi tiết Sản Phẩm')
@section('contents')
<div class="pd-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @php
                    $isFeatureImageUrl = filter_var($product->feature_image, FILTER_VALIDATE_URL);
                @endphp
                <div id="slider" class="owl-carousel product-slider">
                    <div class="item">
                        <img src="{{ $isFeatureImageUrl ? $product->feature_image : asset("storage/images/products/$product->feature_image") }}" />
                    </div>
                    @foreach ($product->images as $productImg)
                    @php
                        $isImageUrlSlider = filter_var($productImg->image, FILTER_VALIDATE_URL);
                    @endphp
                    <div class="item">
                        <img src="{{ $isImageUrlSlider ? $productImg->image : asset("storage/images/products/$productImg->image") }}" />
                    </div>
                    @endforeach
                </div>
                <div id="thumb" class="owl-carousel product-thumb">
                    <div class="item">
                        <img src="{{ $isFeatureImageUrl ? $product->feature_image : asset("storage/images/products/$product->feature_image") }}" />
                    </div>
                    @foreach ($product->images as $productImg)
                    @php
                        $isImageUrlCarousel = filter_var($productImg->image, FILTER_VALIDATE_URL);
                    @endphp
                    <div class="item">
                        <img src="{{ $isImageUrlCarousel ? $productImg->image : asset("storage/images/products/$productImg->image") }}" />
                    </div>
                    @endforeach
                </div>

            </div>
            <div class="col-md-6">
                <div class="product-dtl">
                    <div class="product-info">
                        <div class="product-name" style="color: blueviolet;">{{$product->name}}</div>
                        <div class="reviews-counter">
                            <div class="rate">
                                <input type="radio" id="star5" name="rate" value="5" checked />
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" id="star4" name="rate" value="4" checked />
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" name="rate" value="3" checked />
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" name="rate" value="2" />
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" name="rate" value="1" />
                                <label for="star1" title="text">1 star</label>
                                </div>
                            <span>3 Reviews</span>
                        </div>
                        @php
                        $price = 0;
                        foreach ($product->variants as $variant) {
                            $price += $variant->unit_price;
                        }
                        @endphp
                        <div class="product-price-discount">
                            <span>{{number_format($price)}}&nbsp;</span><span style="font-size: 13px">vnđ</span>
                        </div>
                    </div>
                    <p>{{$product->summary}}</p>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="size">Size</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="color">Color</label>
                            <input type="text" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="product-count row">
                        <div class="col-md-6">
                            <label for="size">Quantity</label>
                            <input type="text" class="form-control" placeholder="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-info-tabs">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Mô tả sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Chi tiết sản phẩm</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                    {!! $product->description !!}
                </div>
                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="review-heading">Chi tiết</div>
                    <div>
                        {!! $product->detail !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
@endsection
@section('my-script')
    <script src="{{ asset('admin/products/detail/product-detail.js') }}"></script>
    <script>
        CKEDITOR.editorConfig = function( config ) {
        config.entities_latin = false;
        config.entities_greek = false;
        config.entities = false;
        config.basicEntities = false;
    };
    </script>
@endsection
