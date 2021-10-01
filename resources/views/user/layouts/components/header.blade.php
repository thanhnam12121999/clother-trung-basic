<!-- Header Section Begin -->
<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service">
                    <i class=" fa fa-envelope"></i>
                    holalady@gmail.com
                </div>
                <div class="phone-service">
                    <i class=" fa fa-phone"></i>
                    1800 2010
                </div>
            </div>
            <div class="ht-right">
                @php
                $checkMemberLoggedIn = auth('accounts')->check() && isAccountType(\App\Models\Member::class);
                @endphp
                @if($checkMemberLoggedIn)
                    <div class="member-info-dropdown">
                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ getLoggedInUser()->username ?? getLoggedInUser()->email }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">Thông tin tài khoản</a>
                            <a class="dropdown-item" href="#">Đơn mua</a>
                            <a class="dropdown-item" href="{{ route('auth.logout') }}">Đăng xuất</a>
                        </div>
                    </div>
                @else
                    <a href="{{ route('auth.sign-in') }}" class="login-panel"><i class="fa fa-user"></i>Đăng nhập</a>
                @endif
{{--                <div class="lan-selector">--}}
{{--                    <select class="language_drop" name="countries" id="countries" style="width:300px;">--}}
{{--                        <option value='yt' data-image="{{ asset('user/img/flag-1.jpg') }}" data-imagecss="flag yt"--}}
{{--                                data-title="English">English</option>--}}
{{--                        <option value='yu' data-image="{{ asset('user/img/flag-2.jpg') }}" data-imagecss="flag yu"--}}
{{--                                data-title="Bangladesh">German </option>--}}
{{--                    </select>--}}
{{--                </div>--}}
                <div class="top-social">
                    <a href="#"><i class="ti-facebook"></i></a>
                    <a href="#"><i class="ti-twitter-alt"></i></a>
                    <a href="#"><i class="ti-linkedin"></i></a>
                    <a href="#"><i class="ti-pinterest"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="inner-header">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="{{ route('home') }}">
{{--                            <img src="{{ asset('user/img/logo.png') }}" alt="">--}}
                            <h3 style="font-weight: 600;">Holalady</h3>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="advanced-search">
{{--                        <button type="button" class="category-btn">All Categories</button>--}}
                        <div class="input-group custom_input-group">
                            <input type="text" placeholder="Tìm kiếm">
                            <button type="button"><i class="ti-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 text-right col-md-3">
                    <ul class="nav-right">
{{--                        <li class="heart-icon">--}}
{{--                            <a href="#">--}}
{{--                                <i class="icon_heart_alt"></i>--}}
{{--                                <span>1</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        <li class="cart-icon">
                            <a href="">
                                <i class="icon_bag_alt"></i>
                                @if (getCart()->isNotEmpty())
                                    <span>{{ getCart()->count() }}</span>
                                @endif
                            </a>
                            <div class="cart-hover" style="right: -100px; width: 400px;">
                                <div class="select-items" style="max-height: 300px; overflow-y: auto;">
                                    <table>
                                        <tbody>
                                        @if (getCart()->isNotEmpty())
                                        @foreach (getCart() as $item)
                                            @php
                                                $productImage = getProductImageInCart($item->id);
                                                $isImageUrl = filter_var($productImage, FILTER_VALIDATE_URL);
                                            @endphp
                                            <tr>
                                                <td class="si-pic" width="40%">
                                                    <img class="w-100" src="{{ $isImageUrl ? $productImage : asset("admin/products/images/$productImage") }}" alt="">
                                                </td>
                                                <td class="si-text" width="50%">
                                                    <div class="product-selected">
                                                        <p>{{ number_format($item->price, 0, ',', '.') }}đ x {{ $item->qty }}</p>
                                                        <h6>{{ $item->name }}</h6>
                                                    </div>
                                                </td>
                                                <td class="si-close" width="10%">
                                                    <a href="{{ route('cart.remove', ['rowId' => $item->rowId]) }}">
                                                        <i class="ti-close"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3">
                                                    <p class="text-center">Không có sản phẩm nào</p>
                                                </td>
                                            </tr>
                                        @endif
                                        {{-- <tr>
                                            <td class="si-pic"><img src="{{ asset('user/img/select-product-2.jpg') }}" alt=""></td>
                                            <td class="si-text">
                                                <div class="product-selected">
                                                    <p>$60.00 x 1</p>
                                                    <h6>Kabino Bedside Table</h6>
                                                </div>
                                            </td>
                                            <td class="si-close">
                                                <i class="ti-close"></i>
                                            </td>
                                        </tr> --}}
                                        </tbody>
                                    </table>
                                </div>
                                <div class="select-total">
                                    <span>tổng:</span>
                                    <h5>{{ getCartTotal() }}đ</h5>
                                </div>
                                <div class="select-button">
                                    <a href="{{ route('cart.index') }}" class="primary-btn view-card">XEM GIỎ HÀNG</a>
                                    <a href="{{ route('payment.index') }}" class="primary-btn checkout-btn">THANH TOÁN</a>
                                </div>
                            </div>
                        </li>
                        <li class="cart-price">{{ getCartTotal() }}đ</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('user.layouts.components.menu')
</header>
<!-- Header End -->
