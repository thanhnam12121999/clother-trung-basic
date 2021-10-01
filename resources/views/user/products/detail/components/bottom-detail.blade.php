<div class="product-tab">
    <div class="tab-item">
        <ul class="nav" role="tablist">
            <li>
                <a class="active" data-toggle="tab" href="#tab-1" role="tab">Mô tả sản phẩm</a>
            </li>
            <li>
                <a data-toggle="tab" href="#tab-2" role="tab">Chi tiết</a>
            </li>
            <li>
                <a data-toggle="tab" href="#tab-3" role="tab">Đánh giá (02)</a>
            </li>
        </ul>
    </div>
    <div class="tab-item-content">
        <div class="tab-content">
            <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                <div class="product-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div>{!! $product->description !!}</div>
                        </div>
                        {{-- <div class="col-lg-5">
                            <img src="{{ asset('user/img/product-single/tab-desc.jpg') }}" alt="">
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-2" role="tabpanel">
                <div class="product-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div>{!! $product->detail !!}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-3" role="tabpanel">
                <div class="customer-review-option">
                    <h4>2 Comments</h4>
                    <div class="comment-option">
                        <div class="co-item">
                            <div class="avatar-pic">
                                <img src="{{ asset('user/img/product-single/avatar-1.png') }}" alt="">
                            </div>
                            <div class="avatar-text">
                                <div class="at-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>Brandon Kelley <span>27 Aug 2019</span></h5>
                                <div class="at-reply">Nice !</div>
                            </div>
                        </div>
                        <div class="co-item">
                            <div class="avatar-pic">
                                <img src="{{ asset('user/img/product-single/avatar-2.png') }}" alt="">
                            </div>
                            <div class="avatar-text">
                                <div class="at-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <h5>Roy Banks <span>27 Aug 2019</span></h5>
                                <div class="at-reply">Nice !</div>
                            </div>
                        </div>
                    </div>
                    <div class="personal-rating">
                        <h6>Your Ratind</h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                    </div>
                    <div class="leave-comment">
                        <h4>Leave A Comment</h4>
                        <form action="#" class="comment-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Name">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Email">
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Messages"></textarea>
                                    <button type="submit" class="site-btn">Send message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
