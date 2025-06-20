document.addEventListener('DOMContentLoaded', function () {
    // Biến toàn cục lưu giỏ hàng hiện tại
    let cartData = {};

    function updateTotalFromCheckboxes() {
        const checkboxes = document.querySelectorAll('.cart-checkbox');
        const totalDisplay = document.getElementById('total-selected');
        let total = 0;

        checkboxes.forEach(cb => {
            if (cb.checked) {
                const id = cb.value;
                const item = cartData[id];
                if (item) {
                    total += item.price * item.qty;
                }
            }
        });

        if (totalDisplay) {
            totalDisplay.textContent = total.toLocaleString('vi-VN') + ' đ';
        }
    }

    function rebindCheckboxes() {
        const checkboxes = document.querySelectorAll('.cart-checkbox');
        checkboxes.forEach(cb => {
            cb.removeEventListener('change', updateTotalFromCheckboxes);
            cb.addEventListener('change', updateTotalFromCheckboxes);
        });
        updateTotalFromCheckboxes();
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('cart-qty-btn')) {
            e.preventDefault();

            const id = e.target.dataset.id;
            const action = e.target.dataset.action;

            fetch(CART_UPDATE_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                body: JSON.stringify({ id, action })
            })
                .then(res => res.json())
                .then(response => {
                    // Lưu trạng thái checked
                    const checkedIds = Array.from(document.querySelectorAll('.cart-checkbox:checked')).map(cb => cb.value);

                    // Cập nhật lại HTML
                    document.querySelector('#cart-content').innerHTML = response.html;

                    // Khôi phục trạng thái checked
                    checkedIds.forEach(id => {
                        const cb = document.querySelector('.cart-checkbox[value="' + id + '"]');
                        if (cb) cb.checked = true;
                    });

                    if (response.totalQty !== undefined) {
                        const cartCount = document.querySelector('#cart-count');
                        if (cartCount) cartCount.innerText = response.totalQty;
                    }

                    cartData = response.cart || {};
                    rebindCheckboxes();
                });
        }
    });

    // Xóa sản phẩm khỏi giỏ hàng
    document.addEventListener('click', function (e) {
        if (e.target.closest('.cart-remove-btn')) {
            e.preventDefault();

            // Lưu trạng thái checked trước khi xóa
            const checkedIds = Array.from(document.querySelectorAll('.cart-checkbox:checked')).map(cb => cb.value);

            const button = e.target.closest('.cart-remove-btn');
            const id = button.dataset.id;

            fetch(CART_REMOVE_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                body: JSON.stringify({ id })
            })
                .then(res => res.json())
                .then(response => {
                    document.querySelector('#cart-content').innerHTML = response.html;

                    // Khôi phục trạng thái checked
                    checkedIds.forEach(id => {
                        const cb = document.querySelector('.cart-checkbox[value="' + id + '"]');
                        if (cb) cb.checked = true;
                    });

                    if (response.totalQty !== undefined) {
                        const cartCount = document.querySelector('#cart-count');
                        if (cartCount) cartCount.innerText = response.totalQty;
                    }

                    cartData = response.cart || {};
                    rebindCheckboxes(); // <-- Đảm bảo gọi lại hàm này sau khi render lại HTML

                    // Gọi lại hàm tính tổng để cập nhật tổng giá ngay lập tức
                    updateTotalFromCheckboxes();

                    showSwalToast('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
                })
                .catch(() => {
                    showSwalToast('error', 'Lỗi khi xóa sản phẩm!');
                });
        }
    });

    // Load lần đầu
    cartData = window.initialCartData || {}; // dùng biến global nếu có
    rebindCheckboxes();
});

