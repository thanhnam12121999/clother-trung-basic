<div class="col-md-3">
    <ul class="nav flex-column">
        {{-- <li class="nav-item bg-profile-cus mb-2"> --}}
        <a class="nav-link w-100 @yield('active-profile-info')" href="{{ route('profile') }}"><i class="fa fa-user"></i>&nbsp;Tài khoản của tôi</a>
        {{-- </li> --}}
        {{-- <li class="nav-item bg-profile-cus mb-2"> --}}
        <a class="nav-link w-100 @yield('active-profile-order')" href="{{ route('profile.order') }}"><i class="fa fa-file"></i>&nbsp;Đơn mua</a>
        {{-- </li> --}}
        {{-- <li class="nav-item bg-profile-cus mb-2"> --}}
        <a class="nav-link w-100 @yield('active-profile-notify')" href="#"><i class="fa fa-bell"></i>&nbsp;Thông báo</a>
        {{-- </li> --}}
    </ul>
</div>
