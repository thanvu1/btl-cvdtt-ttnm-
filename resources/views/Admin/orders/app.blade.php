<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Thêm link icon/font/style nếu cần -->
</head>
<body class="bg-gray-100">

    {{--  HEADER --}}
    @include('layouts.admin.header')

    {{-- NAVBAR ADMIN --}}
    @include('layouts.admin.navbar')

    {{-- BREADCRUMB hoặc NAVIGATION nếu có --}}
    @include('layouts.navigation')

    {{-- NỘI DUNG CHÍNH --}}
    <main class="p-4">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('layouts.footer')



</body>
</html>
