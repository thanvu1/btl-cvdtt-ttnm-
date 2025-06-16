document.addEventListener('DOMContentLoaded', function () {
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
                    document.querySelector('#cart-content').innerHTML = response.html;

                    if (response.totalQty !== undefined) {
                        const cartCount = document.querySelector('#cart-count');
                        if (cartCount) cartCount.innerText = response.totalQty;
                    }
                });
        }
    });

    // Xóa sản phẩm khỏi giỏ hàng
    document.addEventListener('click', function (e) {
        if (e.target.closest('.cart-remove-btn')) {
            e.preventDefault();

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

                    if (response.totalQty !== undefined) {
                        const cartCount = document.querySelector('#cart-count');
                        if (cartCount) cartCount.innerText = response.totalQty;
                    }

                    showSwalToast('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
                })
                .catch(() => {
                    showSwalToast('error', 'Lỗi khi xóa sản phẩm!');
                });
        }
    });
});
