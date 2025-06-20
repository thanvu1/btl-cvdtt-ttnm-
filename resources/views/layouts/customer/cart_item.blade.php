@php
    $cart = session('cart', []);
@endphp
@if(session()->has('cart_backup'))
    <form action="{{ route('cart.undo') }}" method="POST" class="mb-3">
        @csrf
        <button type="submit" class="btn btn-warning btn-sm rounded-pill">
            <i class="bi bi-arrow-counterclockwise"></i> Hoàn tác thao tác gần nhất
        </button>
    </form>
@endif
@if(empty($cart))
    <p class="text-center text-muted mt-5">Chưa có sản phẩm nào trong giỏ.</p>
@else
    <script>
        window.initialCartData = @json($cart);
    </script>
    <form id="checkout-form" action="{{ route('checkout') }}" method="GET">
        @foreach($cart as $id => $item)
        <div class="cart-item d-flex align-items-center mb-3 p-2 bg-white rounded shadow-sm">
            <input type="checkbox" name="selected[]" value="{{ $id }}" class="form-check-input cart-checkbox me-2" style="flex-shrink:0;">
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
            <div class="d-flex justify-content-between fw-bold my-3">
                <span>Tổng cộng:</span>
                <span id="total-selected" class="text-danger">0 đ</span>
            </div>

        <button type="submit" class="btn btn-primary w-100 mt-3">Thanh toán</button>
    </form>   
@endif
