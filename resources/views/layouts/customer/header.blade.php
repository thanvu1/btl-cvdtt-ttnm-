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
        <form action="" method="GET" class="d-flex align-items-center mx-auto flex-grow-1" style="max-width: 400px;">
            <input type="text" name="q" class="form-control" placeholder="Tìm kiếm..." style="border-radius: 20px 0 0 20px; border: none; height: 38px;">
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
            <a href="" class="d-flex align-items-center px-4 py-2 mx-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-person me-2" viewBox="0 0 16 16" style="font-weight: bold;">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                </svg>
                <span class="text-white" style="font-size: 1.17rem; font-family: Inter, sans-serif; font-weight: 400;">
                    {{ Auth::user()->name ?? 'username' }}
                </span>
            </a>
            <!-- Giỏ hàng -->
            <a href="javascript:void(0);" 
               class="d-flex align-items-center text-white px-4 py-2 mx-2 position-relative" 
               style="text-decoration: none;"
               data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="cartOffcanvas">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-cart2 me-2" viewBox="0 0 16 16" style="font-weight: bold; position: relative;">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                </svg>
                <span class="position-absolute bottom-0 end-5 translate-end badge rounded-pill bg-danger" style="font-size: 0.75rem; transform: translate(50%, 50%);">
                    {{ session('cart_total', 0) }}
                </span>
                <span style="font-size: 1rem;">Giỏ hàng</span>
            </a>
        </div>
    </div>
</div>

<!-- Offcanvas giỏ hàng -->

@include('layouts.cart')
