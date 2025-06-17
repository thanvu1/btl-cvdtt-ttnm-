<!doctype html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Nhà thuốc Health Care')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            font-family: 'Roboto', sans-serif;
        }

        main {
            flex: 1 0 auto;
        }

    </style>
    @stack('styles')
</head>
<body>
@include('layouts.customer.header')
@include('layouts.customer.navbar')
@include('layouts.breadcrumb')
<main style="position: relative; z-index: 1; top:200px">
    @yield('content')
    @stack('styles')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @stack('scripts')

</main>
<script>
    const CSRF_TOKEN = '{{ csrf_token() }}';
    const CART_UPDATE_URL = '{{ route('cart.update') }}';
    const CART_REMOVE_URL = '{{ route('cart.remove') }}';
    const CART_ADD_URL = '{{ route('cart.add') }}';
</script>
<script src="{{ asset('js/add-to-cart.js') }}"></script>
<script src="{{ asset('js/cart.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/swal-toast.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/9df8154260.js" crossorigin="anonymous"></script>
{{-- @include('layouts.footer') --}}
</body>
</html>
