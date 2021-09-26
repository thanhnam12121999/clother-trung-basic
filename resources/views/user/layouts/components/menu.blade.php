<div class="nav-item">
    <div class="container">
{{--        <div class="nav-depart">--}}
{{--            <div class="depart-btn">--}}
{{--                <i class="ti-menu"></i>--}}
{{--                <span>All departments</span>--}}
{{--                <ul class="depart-hover">--}}
{{--                    <li class="active"><a href="#">Women’s Clothing</a></li>--}}
{{--                    <li><a href="#">Men’s Clothing</a></li>--}}
{{--                    <li><a href="#">Underwear</a></li>--}}
{{--                    <li><a href="#">Kid's Clothing</a></li>--}}
{{--                    <li><a href="#">Brand Fashion</a></li>--}}
{{--                    <li><a href="#">Accessories/Shoes</a></li>--}}
{{--                    <li><a href="#">Luxury Brands</a></li>--}}
{{--                    <li><a href="#">Brand Outdoor Apparel</a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
        <nav class="nav-menu mobile-menu">
            <ul>
                <li @yield('active-home')><a href="{{ route('home') }}">Trang chủ</a></li>
                <li @yield('active-product')><a href="{{ route('products.index') }}">Shop</a></li>
                <li><a href="#">Catalog</a>
                    <ul class="dropdown">
                        <li><a href="#">Áo nữ</a></li>
                        <li><a href="#">Quần nữ</a></li>
                        <li><a href="#">Váy nữ</a></li>
                    </ul>
                </li>
{{--                <li><a href="./blog.html">Blog</a></li>--}}
                <li><a href="">Liên hệ</a></li>
{{--                <li><a href="#">Pages</a>--}}
{{--                    <ul class="dropdown">--}}
{{--                        <li><a href="./blog-details.html">Blog Details</a></li>--}}
{{--                        <li><a href="./shopping-cart.html">Shopping Cart</a></li>--}}
{{--                        <li><a href="./check-out.html">Checkout</a></li>--}}
{{--                        <li><a href="./faq.html">Faq</a></li>--}}
{{--                        <li><a href="./register.html">Register</a></li>--}}
{{--                        <li><a href="./login.html">Login</a></li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
    </div>
</div>
