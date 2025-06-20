@extends('layouts.admin.app')

@section('content')
    <div class="container py-3" style="max-width: 1400px;">
        {{-- Header điều hướng: Mã đơn hàng trái/phải và trạng thái --}}
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="d-flex align-items-center gap-3">
                <span class="fw-normal fs-5" style="font-family: 'Inter', sans-serif;">
                    Trang chủ &gt; Đơn hàng &gt;
                </span>
                <span class="fw-bold fs-5 ms-2" style="font-family: 'Inter', sans-serif;">
                    {{ $order->id }}
                </span>
            </div>
            <form method="POST" action="{{ route('orders.updateStatus', $order->id) }}" class="d-flex align-items-center gap-3 mb-0">
                @csrf
                @method('PUT')
                <span class="fw-bold me-2" style="font-size:1.15rem;">{{ $order->id }}</span>
                <select name="status"
                        class="form-select shadow-sm border rounded-4 fw-semibold"
                        style="min-width:160px; background: #f4f6fd; font-size: 1rem;"
                        onchange="this.form.submit()">
                    <option value="ĐANG XỬ LÝ" {{ $order->status == 'ĐANG XỬ LÝ' ? 'selected' : '' }}>ĐANG XỬ LÝ</option>
                    <option value="ĐÃ XÁC NHẬN" {{ $order->status == 'ĐÃ XÁC NHẬN' ? 'selected' : '' }}>ĐÃ XÁC NHẬN</option>
                    <option value="ĐANG GIAO" {{ $order->status == 'ĐANG GIAO' ? 'selected' : '' }}>ĐANG GIAO</option>
                    <option value="GIAO THÀNH CÔNG" {{ $order->status == 'GIAO THÀNH CÔNG' ? 'selected' : '' }}>GIAO THÀNH CÔNG</option>
                    <option value="ĐÃ HUỶ" {{ $order->status == 'ĐÃ HUỶ' ? 'selected' : '' }}>ĐÃ HUỶ</option>
                </select>
            </form>
        </div>

        {{-- Thông báo trạng thái thay đổi --}}
        {{-- Thông báo trạng thái thay đổi (do observer đẩy lên) --}}
        @if(session('order_status_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>
                {{ session('order_status_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
            </div>
        @endif


        {{-- Form thông tin đơn hàng (không còn nút lưu, chỉ hiển thị/thay đổi các trường khác) --}}
        <form>
            <div class="row g-4">

                {{-- Địa chỉ nhận hàng --}}
                <div class="col-12 col-md-6">
                    <div class="bg-white rounded-4 shadow-sm border p-4 h-100">
                        <div class="d-flex align-items-center mb-3">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle me-2"
                                  style="width:44px;height:44px; background:#e8f0fe;">
                                <i class="fa-solid fa-location-dot text-primary" style="font-size:1.6rem;"></i>
                            </span>
                            <span class="fw-bold fs-5">Địa chỉ nhận hàng</span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tên người nhận</label>
                            <input name="receiver_name" value="{{ $order->user->name }}" class="form-control rounded-3" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Số điện thoại</label>
                            <input name="phone" value="{{ $order->phone }}" class="form-control rounded-3" readonly>
                        </div>
                        <div>
                            <label class="form-label fw-semibold">Địa chỉ</label>
                            <input name="shipping_address" value="{{ $order->shipping_address }}" class="form-control rounded-3" readonly>
                        </div>
                    </div>
                </div>

                {{-- Phương thức thanh toán, ghi chú --}}
                <div class="col-12 col-md-6">
                    <div class="bg-white rounded-4 shadow-sm border p-4 h-100">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Phương thức thanh toán</label>
                            <input name="payment_method" value="{{ $order->payment_method ?? 'Tài khoản liên kết ngân hàng' }}" class="form-control rounded-3" readonly>
                        </div>
                        <div>
                            <label class="form-label fw-semibold">Ghi chú</label>
                            <textarea name="note" rows="2" class="form-control rounded-3" readonly>{{ $order->note }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sản phẩm trong đơn --}}
            <div class="bg-white rounded-4 shadow-sm border px-4 py-3 mt-4">
                <div class="fw-bold fs-5 mb-3">Sản phẩm trong đơn hàng</div>
                @foreach($order->items as $item)
                    <div class="d-flex align-items-center mb-3 flex-wrap">
                        <img src="{{ $item->product->image ?? asset('image/dizigone.png') }}"
                             class="rounded-3 me-4"
                             style="width:70px; height:90px; object-fit:cover;"
                             alt="Ảnh sản phẩm" />
                        <div class="flex-grow-1">
                            <div class="fw-semibold" style="font-family:'Inter',sans-serif;">{{ $item->product->name ?? 'Sản phẩm không xác định' }}</div>
                            <div class="text-muted">Dạng tuýp</div>
                        </div>
                        <div class="text-end" style="min-width:130px;">
                            <div class="text-muted">Số lượng: {{ $item->quantity }}</div>
                            <div>
                                @if($item->old_price && $item->old_price > $item->price)
                                    <span class="text-decoration-line-through opacity-50">đ{{ number_format($item->old_price) }}</span>
                                @endif
                                <span class="fw-bold text-primary ms-2">đ{{ number_format($item->price) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Tổng tiền & nút quay lại --}}
            <div class="d-flex align-items-center justify-content-between py-4">
                <div class="fs-5">
                    <span class="fw-bold">Mã đơn hàng:</span> {{ $order->id }}
                </div>
                <div>
                    <span class="fs-5">Thành tiền:</span>
                    <span class="fs-4 fw-bold ms-2 text-primary">đ{{ number_format($order->total_price) }}</span>
                </div>
                <a href="{{ route('orders.index') }}" class="btn btn-secondary rounded-4 px-5 py-2 fs-5">
                    Quay lại
                </a>
            </div>
        </form>
    </div>
@endsection
