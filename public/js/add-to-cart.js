document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.add-to-cart-btn');

    buttons.forEach(btn => {
        btn.addEventListener('click', async function () {
            const productId = this.getAttribute('data-product-id');

            // Lưu trạng thái checked của các checkbox trước khi thêm sản phẩm
            const checkedIds = Array.from(document.querySelectorAll('.cart-checkbox:checked')).map(cb => cb.value);

            try {
                const response = await fetch(CART_ADD_URL, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF_TOKEN
                    },
                    body: JSON.stringify({ product_id: productId })
                });

                const result = await response.json();

                if (result.success) {
                    // Hiển thị toast thông báo thành công
                    showSwalToast('success', 'Đã thêm vào giỏ hàng!');

                    // Cập nhật số lượng hiển thị
                    const cartCount = document.querySelector('#cart-count');
                    if (cartCount) cartCount.innerText = result.totalQty;

                    // Cập nhật nội dung giỏ hàng
                    document.querySelector('#cart-content').innerHTML = result.html;

                    // Khôi phục trạng thái checked cho các checkbox còn tồn tại
                    checkedIds.forEach(id => {
                        const cb = document.querySelector('.cart-checkbox[value="' + id + '"]');
                        if (cb) cb.checked = true;
                    });

                    // Gắn lại sự kiện và cập nhật tổng giá
                    if (typeof rebindCheckboxes === 'function') rebindCheckboxes();
                    if (typeof updateTotalFromCheckboxes === 'function') updateTotalFromCheckboxes();

                    // Mở offcanvas nếu chưa mở
                    const offcanvasEl = document.getElementById('cartOffcanvas');
                    const bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
                    bsOffcanvas.show();
                }
            } catch (error) {
                console.error('Lỗi thêm sản phẩm:', error);
                showSwalToast('error', 'Lỗi thêm sản phẩm!');
            }
        });
    });
});
