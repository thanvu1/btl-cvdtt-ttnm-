@extends('layouts.customer.app')
@section('title', 'Thanh toán')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Thanh toán đơn hàng</h2>
    <div class="row">
        {{-- Bên trái --}}
        <div class="col-md-8">
            {{-- Thông tin sản phẩm --}}
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    Sản phẩm trong giỏ hàng
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($cart as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $item['name'] }}</strong><br>
                                <small>{{ number_format($item['price'], 0, ',', '.') }} đ x {{ $item['qty'] }}</small>
                            </div>
                            <span class="fw-bold text-danger">
                                {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }} đ
                            </span>
                        </li>
                    @empty
                        <li class="list-group-item">Không có sản phẩm nào trong giỏ.</li>
                    @endforelse
                </ul>
            </div>

            {{-- Form thông tin người nhận --}}
            <div class="card">
                <div class="card-header bg-dark text-white">Thông tin đặt hàng</div>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ tên</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Đặt hàng</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Bên phải --}}
        <div class="col-md-4">
            {{-- Mã khuyến mãi --}}
            <div class="card mb-3">
                <div class="card-header">Mã giảm giá</div>
                <div class="card-body">
                    <input type="text" class="form-control mb-2" placeholder="Nhập mã khuyến mãi">
                    <button class="btn btn-outline-secondary w-100">Áp dụng</button>
                </div>
            </div>

            {{-- Tổng thanh toán --}}
            <div class="card">
                <div class="card-header bg-dark text-white">Tổng cộng</div>
                <div class="card-body">
                    <h5 class="fw-bold">Tổng tiền: 
                        <span class="text-danger float-end">
                            {{ number_format($total, 0, ',', '.') }} đ
                        </span>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
