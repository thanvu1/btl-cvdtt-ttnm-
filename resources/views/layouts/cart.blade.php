<div class="offcanvas offcanvas-end custom-cart-canvas"
     tabindex="-1"
     id="cartOffcanvas"
     aria-labelledby="cartOffcanvasLabel"
     data-bs-backdrop="false"
     data-bs-scroll="true">
    <div class="offcanvas-header">
        <h3 class="offcanvas-title" id="cartOffcanvasLabel">
            Giỏ hàng
        </h3>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Đóng"></button>
    </div>
    <div class="offcanvas-body custom-cart-body">
        {{-- Kiểm tra giỏ hàng --}}
        @php
            // Ví dụ dữ liệu giỏ hàng, thay bằng session hoặc biến thực tế
            $cart = [
                [
                    'id' => 1,
                    'name' => 'Paracetamol',
                    'desc' => 'Giảm đau, hạ sốt nhanh.',
                    'image' => 'https://placehold.co/60x60?text=Paracetamol',
                    'price' => 25000,
                    'old_price' => 30000,
                    'qty' => 1
                ],
                [
                    'id' => 2,
                    'name' => 'Vitamin C',
                    'desc' => 'Tăng sức đề kháng.',
                    'image' => 'https://placehold.co/60x60?text=Vitamin+C',
                    'price' => 20000,
                    'old_price' => 25000,
                    'qty' => 2
                ]
            ];
        @endphp

        <div id="cart-content">
            @if(empty($cart))
                <p class="text-center text-muted mt-5">Chưa có sản phẩm nào trong giỏ.</p>
            @else
                @foreach($cart as $item)
                <div class="cart-item d-flex align-items-center mb-3 p-2 bg-white rounded shadow-sm">
                    <input type="checkbox" class="form-check-input me-2" style="flex-shrink:0;">
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="me-3 rounded" width="60" height="60">
                    <div class="flex-grow-1">
                        <div class="fw-bold">{{ $item['name'] }}</div>
                        <div class="small text-muted">{{ $item['desc'] }}</div>
                        <div>
                            <span class="text-danger fw-bold">{{ number_format($item['price'], 0, ',', '.') }} đ</span>
                            <span class="text-secondary text-decoration-line-through ms-2">{{ number_format($item['old_price'], 0, ',', '.') }} đ</span>
                        </div>
                        <div class="mt-2 d-flex align-items-center">
                            <button class="btn btn-outline-secondary btn-sm px-2 py-0 me-1">-</button>
                            <span class="mx-1">{{ $item['qty'] }}</span>
                            <button class="btn btn-outline-secondary btn-sm px-2 py-0 ms-1">+</button>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-danger ms-3" title="Xóa sản phẩm">
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
        </div>
    </div>
</div>

@push('styles')
<style>
    .offcanvas.custom-cart-canvas {
        width: 400px !important;
        background: #f8fafc;
        /* border-left: 3px solid #2563eb; */
        box-shadow: 2px 0 4px 4px rgba(0,0,0,0.18);
        position: fixed !important;
        top: 125px !important;
        right: 30px !important;
        /* border-radius: 16px 0 0 16px; */
        height: auto !important;
        max-height: calc(100vh - 150px) !important;
        overflow: hidden;
        z-index: 1056;
    }
    /* .custom-cart-canvas .offcanvas-header {
        background: #2563eb;
        color: #fff;
        border-bottom: 1px solid #e5e7eb;
        border-radius: 16px 0 0 0;
    } */
    .custom-cart-canvas .offcanvas-title {
        font-size: 1.2rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    /* .custom-cart-canvas .btn-close {
        filter: invert(1);
    } */
    .custom-cart-body {
        max-height: calc(100vh - 250px);
        overflow-y: auto;
        padding-bottom: 16px;
    }
</style>
@endpush