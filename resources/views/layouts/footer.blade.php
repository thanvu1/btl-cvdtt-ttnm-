<footer class="mt-auto py-4" style="background-color: #E2E8F5; font-family: 'Inter', sans-serif;">
    <style>
        /* CSS chỉ áp dụng trong footer này */
        footer {
            flex-shrink: 0;
        }
        footer address {
            font-style: normal; /* override mặc định italic của address */
        }
        footer a.text-secondary:hover,
        footer a.text-secondary:focus {
            text-decoration: underline;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-12 mb-3">
                <h2 class="fw-normal fs-3 text-dark">HEALTHCARE</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-4 mb-3">
                <h3 class="fw-bold fs-5 text-dark">SẢN PHẨM</h3>
                <ul class="list-unstyled text-secondary fs-6">
                    <li>Thuốc</li>
                    <li>Thực phẩm chức năng</li>
                    <li>Thiết bị y tế</li>
                    <li>Chăm sóc cá nhân</li>
                    <li>Dược - Mỹ phẩm</li>
                </ul>
            </div>
            <div class="col-sm-6 col-md-4 mb-3">
                <h3 class="fw-bold fs-5 text-dark">THÔNG TIN</h3>
                <ul class="list-unstyled text-secondary fs-6">
                    <li>Về chúng tôi</li>
                    <li>Điều khoản</li>
                    <li>Chính sách vận chuyển</li>
                    <li>Dịch vụ</li>
                </ul>
            </div>
            <div class="col-sm-12 col-md-4 mb-3">
                <h3 class="fw-bold fs-5 text-dark">LIÊN HỆ</h3>
                <address class="text-secondary fs-6 mb-0">
                    175 Tây Sơn, Đống Đa, Hà Nội<br>
                    Email: <a href="mailto:xxx@gmail.com" class="text-secondary text-decoration-none">xxx@gmail.com</a><br>
                    Điện thoại: <a href="tel:0123456789" class="text-secondary text-decoration-none">0123456789</a>
                </address>
            </div>
        </div>
    </div>
</footer>
