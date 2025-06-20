@extends('layouts.admin.app')

@section('content')
<style>
    .order-filter-col {
        min-width: 240px;
        max-width: 280px;
    }
    @media (max-width: 991.98px) {
        .order-filter-col {
            max-width: 100%;
            min-width: unset;
            margin-bottom: 20px;
        }
    }
</style>

<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <!-- Bộ lọc bên trái -->
        <div class="col-lg-3 order-filter-col">
            <form method="GET" action="{{ route('orders.index') }}">
                <div class="card mb-3">
                    <div class="card-header fw-bold py-2">🔍 Tìm kiếm & Lọc</div>
                    <div class="card-body">
                        <!-- Số điện thoại -->
                        <div class="mb-2">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="search" class="form-control form-control-sm" value="{{ request('search') }}" placeholder="Nhập SĐT...">
                        </div>

                        <!-- Tên người nhận -->
                        <div class="mb-2">
                            <label class="form-label">Tên người nhận</label>
                            <input type="text" name="user_name" class="form-control form-control-sm" value="{{ request('user_name') }}" placeholder="Nhập tên...">
                        </div>

                        <!-- Trạng thái đơn -->
                        <div class="mb-2">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-select form-select-sm" name="status">
                                <option value="">Tất cả</option>
                                @foreach(['Chờ xử lý', 'Đang giao', 'Giao thành công', 'Đã huỷ'] as $status)
                                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Ngày tạo -->
                        <div class="mb-2">
                            <label class="form-label">Từ ngày</label>
                            <input type="date" name="start_date" class="form-control form-control-sm" value="{{ request('start_date') }}">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Đến ngày</label>
                            <input type="date" name="end_date" class="form-control form-control-sm" value="{{ request('end_date') }}">
                        </div>

                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-primary btn-sm">Áp dụng lọc</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Danh sách đơn hàng bên phải -->
        <div class="col-lg-9">
            @include('Admin.orders._table', ['orders' => $orders])
        </div>
    </div>
</div>
@endsection
