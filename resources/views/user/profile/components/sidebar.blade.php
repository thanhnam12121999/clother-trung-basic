<div class="col-md-3 profile-sidebar">
    <ul class="nav flex-column">
        {{-- <li class="nav-item bg-profile-cus mb-2"> --}}
        <a class="nav-link w-100 @yield('active-profile-info')" href="{{ route('profile') }}"><i class="fa fa-user"></i>&nbsp;Tài khoản của tôi</a>
        {{-- </li> --}}
        {{-- <li class="nav-item bg-profile-cus mb-2"> --}}
        <a class="nav-link w-100 @yield('active-profile-order')" href="{{ route('profile.order') }}"><i class="fa fa-file"></i>&nbsp;Đơn mua</a>
        {{-- </li> --}}
        {{-- <li class="nav-item bg-profile-cus mb-2"> --}}
        <a class="nav-link w-100 @yield('active-profile-notify')" href="{{ route('profile.notification') }}">
            <i class="fa fa-bell"></i>&nbsp;
            <span>Thông báo @if($unreadMemberNoti->count())<sup>{{ $unreadMemberNoti->count() }}</sup>@endif</span>
        </a>
        {{-- </li> --}}
    </ul>
</div>
