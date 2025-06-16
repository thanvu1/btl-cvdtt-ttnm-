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
        <div id="cart-content">
           @include('layouts.customer.cart_item')
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).on('click', '.cart-qty-btn', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var action = $(this).data('action');
    $.ajax({
        url: '{{ route('cart.update') }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            id: id,
            action: action
        },
        success: function(response) {
            $('#cart-content').html(response.html);
            if (response.totalQty !== undefined) {
                const cartCount = document.querySelector('#cart-count');
                if (cartCount) cartCount.innerText = response.totalQty;
            }
        }
    });
});

$(document).on('click', '.cart-remove-btn', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '{{ route('cart.remove') }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            id: id
        },
        success: function(response) {
            $('#cart-content').html(response.html);
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Đã xóa sản phẩm khỏi giỏ hàng!',
                showConfirmButton: false,
                timer: 1500
            });
                if (response.totalQty !== undefined) {
                    const cartCount = document.querySelector('#cart-count');
                    if (cartCount) cartCount.innerText = response.totalQty;
                }
        },
        error: function() {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Lỗi khi xóa sản phẩm!',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
});
</script>
@endpush

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