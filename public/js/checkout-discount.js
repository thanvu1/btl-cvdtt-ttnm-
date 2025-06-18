document.addEventListener('DOMContentLoaded', function () {
    var applyVoucherBtn = document.getElementById('apply-voucher-btn');
    var discountAmountEl = document.getElementById('discount-amount');
    var totalAfterDiscountEl = document.getElementById('total-after-discount');
    var loadingEl = document.getElementById('voucher-loading');
    var errorEl = document.getElementById('voucher-error');

    if (applyVoucherBtn) {
        applyVoucherBtn.addEventListener('click', function (e) {
            e.preventDefault(); // Chặn submit/reload form
            var checked = document.querySelector('input[name="selected_voucher"]:checked');
            if (checked) {
                // Hiển thị loading
                if (loadingEl) loadingEl.style.display = 'block';
                if (errorEl) errorEl.style.display = 'none';

                let voucherInput = document.querySelector('input[name="voucher_id"]');
                if (!voucherInput) {
                    voucherInput = document.createElement('input');
                    voucherInput.type = 'hidden';
                    voucherInput.name = 'voucher_id';
                    document.getElementById('order-form').appendChild(voucherInput);
                }
                voucherInput.value = checked.value;

                fetch('/checkout/calculate-discount', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({voucher_id: checked.value})
                })
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        if (loadingEl) loadingEl.style.display = 'none';
                        if (data.error) {
                            if (errorEl) {
                                errorEl.textContent = data.error;
                                errorEl.style.display = 'block';
                            }
                            discountAmountEl.textContent = '-0đ';
                            totalAfterDiscountEl.textContent = data.totalAfterDiscountText || '0đ';
                        } else {
                            if (errorEl) errorEl.style.display = 'none';
                            discountAmountEl.textContent = '-' + (data.discountAmountText ?? '0đ');
                            totalAfterDiscountEl.textContent = data.totalAfterDiscountText ?? '0đ';
                        }
                    })
                    .catch(error => {
                        if (loadingEl) loadingEl.style.display = 'none';
                        if (errorEl) {
                            errorEl.textContent = 'Lỗi khi áp dụng mã giảm giá!';
                            errorEl.style.display = 'block';
                        }
                        discountAmountEl.textContent = '-0đ';
                        totalAfterDiscountEl.textContent = '0đ';
                    });
            }
        });
    }
});
