@extends('layouts.customer.app')
@section('title', 'Thanh toán')
@section('breadcrumb')
    <li class="breadcrumb-item"><a class="text-black text-decoration-underline" href="{{ url('/') }}">Trang chủ</a></li>
    <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
@endsection
@section('content')
<div class="container py-4">
    <div class="row">
        {{-- Bên trái --}}
        <div class="col-md-8">
            {{-- Thông tin sản phẩm --}}
            <div class="card mb-4">
                <h4 class="card-header text-black">Thông tin đơn hàng</h4>

                {{-- Tiêu đề cột --}}
                <div class="px-3 py-2 d-none d-md-flex fw-bold border-bottom">
                    <div class="col-6">Sản phẩm</div>
                    <div class="col-2 text-center">Đơn giá</div>
                    <div class="col-2 text-center">Số lượng</div>
                    <div class="col-2 text-end">Thành tiền</div>
                </div>

                {{-- Danh sách sản phẩm --}}
                <ul class="list-group list-group-flush">
                    @forelse($cart as $item)
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-6 d-flex align-items-center">
                                    <img src="{{ $item['image'] ? asset('image/products/' . $item['image']) : asset('image/Medical-Devices-Industry-2.jpg') }}"
                                        alt="{{ $item['name'] }}" class="img-thumbnail me-2" style="width: 60px; height: 60px; object-fit: cover;">
                                    <div>{{ $item['name'] }}</div>
                                </div>
                                <div class="col-2 text-center text-muted">
                                    {{ number_format($item['price'], 0, ',', '.') }} đ
                                </div>
                                <div class="col-2 text-center">
                                    {{ $item['qty'] }}
                                </div>
                                <div class="col-2 text-end fw-bold text-danger">
                                    {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }} đ
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item">Không có sản phẩm nào trong giỏ.</li>
                    @endforelse
                </ul>
            </div>

            {{-- Form thông tin người nhận --}}
            <div class="card mb-4">
                <h4 class="card-header text-black">Thông tin giao hàng</h4>
                <div class="card-body">
                    <form action="" method="POST" id="order-form" class="p-4 bg-white shadow-sm rounded">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Họ tên</label>
                                <input type="text" name="name" class="form-control custom-input" placeholder="VD: Nguyễn Văn A" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control custom-input" placeholder="VD: 0979370806" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Tỉnh/Thành phố</label>
                                <select name="province" id="province" class="form-select custom-input" required>
                                    <option value="">Vui lòng chọn</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Quận/Huyện</label>
                                <select name="district" id="district" class="form-select custom-input" required>
                                    <option value="">Vui lòng chọn</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Phường/Xã</label>
                                <select name="ward" id="ward" class="form-select custom-input" required>
                                    <option value="">Vui lòng chọn</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Số nhà/Đường</label>
                            <input type="text" name="street" class="form-control custom-input" placeholder="VD: Số nhà 09, đường Hà Huy Tập" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Ghi chú</label>
                            <textarea name="note" class="form-control custom-input" placeholder="Note:"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div> {{-- END col-md-8 --}}

        {{-- Bên phải --}}
        <div class="col-md-4">
    {{-- Mã giảm giá + Tổng thanh toán --}}
    <div class="card p-3">
        {{-- Chọn mã giảm giá --}}
        <div class="mb-3 position-relative">
            <!-- Nút mở modal -->
            <button type="button" class="form-control text-start position-relative" data-bs-toggle="modal" data-bs-target="#voucherModal" data-bs-backdrop="true">
                Áp dụng ưu đãi để giảm giá
                <span class="position-absolute top-50 end-0 translate-middle-y me-3 text-muted">&gt;</span>
            </button>

            <!-- Modal Voucher Chuẩn Bootstrap -->
            <div class="modal" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Header -->
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold mx-auto" id="voucherModalLabel">Voucher giảm giá</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                        </div>

                        <!-- Body -->
                        <div class="modal-body">
                            <div class="list-group" id="voucher-list">
                                @foreach ($vouchers as $voucher)
                                <label class="list-group-item d-flex align-items-center gap-3 voucher-item" style="cursor:pointer;">
                                    <input type="radio" name="selected_voucher" value="{{ $voucher->id }}" class="form-check-input mt-0">
                                    <img src="{{ asset('image/logo.png') }}" alt="icon" style="width: 50px; height: 50px;">
                                    <div class="flex-grow-1">
                                        <div class="fw-bold">Mã giảm giá {{ $voucher->code ?? $voucher->id }}</div>
                                        <div>Giảm tối đa {{ number_format($voucher->discount, 0, ',', '.') }}đ</div>
                                        <div>Đơn tối thiểu {{ number_format($voucher->min_order, 0, ',', '.') }}đ</div>
                                        <div class="text-muted">HSD: {{ \Carbon\Carbon::parse($voucher->expired_at)->format('d/m/Y') }}</div>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-primary px-4 rounded-pill" id="apply-voucher-btn" data-bs-dismiss="modal">Đồng ý</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Chi tiết thanh toán --}}
        <ul class="list-unstyled mb-3">
            <li class="d-flex justify-content-between py-1">
                <span>Tổng tiền</span>
                <span>xxxxxxxxxxxxđ</span>
            </li>
            <li class="d-flex justify-content-between py-1">
                <span>Giảm giá voucher</span>
                <span>0đ</span>
            </li>
            <li class="d-flex justify-content-between py-1 border-bottom">
                <span>Phí vận chuyển</span>
                <span>miễn phí</span>
            </li>
            <li class="d-flex justify-content-between py-2 fw-bold">
                <span>Thành tiền</span>
                <span>xxxxxxxxxxxxđ</span>
            </li>
        </ul>

        {{-- Nút đặt hàng --}}
        <button type="submit" form="order-form" class="btn btn-primary w-100 rounded-pill fw-bold">
            Đặt Hàng
        </button>
    </div>
</div>
    </div> {{-- END row --}}
</div> {{-- END container --}}

@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const provinceSelect = document.getElementById('province');
    const districtSelect = document.getElementById('district');
    const wardSelect = document.getElementById('ward');

    fetch('https://provinces.open-api.vn/api/?depth=3')
        .then(res => res.json())
        .then(data => {
            data.forEach(province => {
                const opt = new Option(province.name, province.code);
                provinceSelect.add(opt);
            });

            provinceSelect.addEventListener('change', function () {
                districtSelect.innerHTML = '<option value="">Vui lòng chọn</option>';
                wardSelect.innerHTML = '<option value="">Vui lòng chọn</option>';

                const selectedProvince = data.find(p => p.code == this.value);
                selectedProvince?.districts.forEach(d => {
                    const opt = new Option(d.name, d.code);
                    districtSelect.add(opt);
                });
            });

            districtSelect.addEventListener('change', function () {
                wardSelect.innerHTML = '<option value="">Vui lòng chọn</option>';

                const selectedProvince = data.find(p => p.code == provinceSelect.value);
                const selectedDistrict = selectedProvince?.districts.find(d => d.code == this.value);
                selectedDistrict?.wards.forEach(w => {
                    const opt = new Option(w.name, w.code);
                    wardSelect.add(opt);
                });
            });
        });

    // Xử lý chọn voucher
    document.getElementById('apply-voucher-btn').addEventListener('click', function () {
        const checked = document.querySelector('input[name="selected_voucher"]:checked');
        if (checked) {
            // Gán giá trị voucher vào 1 input hidden trong form nếu cần
            let voucherInput = document.querySelector('input[name="voucher_id"]');
            if (!voucherInput) {
                voucherInput = document.createElement('input');
                voucherInput.type = 'hidden';
                voucherInput.name = 'voucher_id';
                document.getElementById('order-form').appendChild(voucherInput);
            }
            voucherInput.value = checked.value;

            // Có thể cập nhật lại phần giảm giá/tổng tiền bằng JS nếu muốn (AJAX)
        }
    });
});
</script>
@endpush

@push('styles')
<style>
select.form-select {
    padding-right: 2rem;
}

.custom-input {
    border-radius: 25px;
    padding: 10px 20px;
    border: 1px solid #ddd;
    box-shadow: 0 2px 5px rgba(0,0,0,0.03);
    background-color: #fdfdfd;
}
.custom-input:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

/* Đặt lại vị trí modal để không bị che bởi header */
.modal-dialog {
    margin-top: 150px !important; /* hoặc giá trị lớn hơn nếu header cao hơn */
    
}

.modal {
    z-index: 100 !important;
}
.modal-backdrop {
    z-index: 99 !important;
}
</style>
@endpush