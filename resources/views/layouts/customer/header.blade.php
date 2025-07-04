<div class="w-100 fixed-top" style="height: 75px; background: linear-gradient(to top, #a78bfa, #2563eb); overflow: hidden; z-index: 1030; padding-left: 40px; padding-right: 40px;">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <!-- Logo bên trái -->
        <a href="">
            <img
            src="{{ asset('image/logo.png') }}"
            class="rounded-3 mt-1 "
            style="width: 98px; height: 65px;"
            alt="Logo"
            />
        </a>

        <!-- Search box bên cạnh logo -->
        <form action="{{ route('search') }}" method="GET" class="d-flex align-items-center mx-auto flex-grow-1" style="max-width: 400px;">
            <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm..." style="border-radius: 20px 0 0 20px; border: none; height: 38px;" value="{{ request('keyword') }}">
            <button type="submit" class="btn btn-light" style="border-radius: 0 20px 20px 0; height: 38px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.415l-3.85-3.85zm-5.442 1.398a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z"/>
                </svg>
            </button>
        </form>
        <!-- Phần admin bên phải (icon + tên user + đơn hàng + giỏ hàng) -->
        <div class="d-flex align-items-center ms-auto">
            <!-- Đơn hàng -->
            <a href="" class="d-flex align-items-center text-white px-4 py-2 mx-2" style="text-decoration: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-bag me-2" viewBox="0 0 16 16" style="font-weight: bold;">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                </svg>
                <span style="font-size: 1rem;">Đơn hàng</span>
            </a>
            <!-- User -->
            <!-- Giỏ hàng -->
            @include('layouts.customer.cart')
        </div>
    </div>
</div>

<!-- Offcanvas giỏ hàng -->

@include('layouts.customer.cart_content')
