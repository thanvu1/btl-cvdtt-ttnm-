@php
    $cart = session('cart', []);
@endphp

@if(empty($cart))
    <p class="text-center text-muted mt-5">Chưa có sản phẩm nào trong giỏ.</p>
@else
    @foreach($cart as $id => $item)
    <div class="cart-item d-flex align-items-center mb-3 p-2 bg-white rounded shadow-sm">
        <input type="checkbox" class="form-check-input me-2" style="flex-shrink:0;">
            <img src="{{ asset('image/Medical-Devices-Industry-2.jpg') }}" alt="{{ $item['name'] }}" class="me-3 rounded" width="60" height="60">
        <div class="flex-grow-1">
            <div class="fw-bold">{{ $item['name'] }}</div>
            <div class="small text-muted">{{ $item['desc'] ?? $item['description'] ?? '' }}</div>
            <div>
                <span class="text-danger fw-bold">{{ number_format($item['price'], 0, ',', '.') }} đ</span>
                @if(isset($item['old_price']))
                <span class="text-secondary text-decoration-line-through ms-2">{{ number_format($item['old_price'], 0, ',', '.') }} đ</span>
                @endif
            </div>
            <div class="mt-2 d-flex align-items-center">
                <button class="btn btn-outline-secondary btn-sm px-2 py-0 me-1 cart-qty-btn" data-id="{{ $id }}" data-action="decrease">-</button>
                <span class="mx-1">{{ $item['qty'] }}</span>
                <button class="btn btn-outline-secondary btn-sm px-2 py-0 ms-1 cart-qty-btn" data-id="{{ $id }}" data-action="increase">+</button>
            </div>
        </div>
        <button class="btn btn-sm btn-danger ms-3 cart-remove-btn" data-id="{{ $id }}" title="Xóa sản phẩm">
            <i class="bi bi-trash"></i>
        </button>
    </div>
    @endforeach
    <hr>
    <div class="d-flex justify-content-between align-items-center fw-bold mb-3">
        <span>Tổng cộng</span>
        <span class="text-danger">
            {{ number_format(collect($cart)->sum(function($i){return $i['price']*$i['qty'];}), 0, ',', '.') }} đ
        </span>
    </div>
    <button class="btn btn-primary w-100">Thanh toán</button>
@endif
