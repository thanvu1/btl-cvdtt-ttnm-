@extends('layouts.admin.app')

@section('content')
<!-- AlpineJS -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<div class="container mx-auto px-4 py-6">
    <!-- Breadcrumb -->
    <div class="mb-4 flex items-center text-gray-600">
        <span>Trang chủ &gt;</span>
        <a href="{{ url()->previous() }}" class="ml-1 text-black no-underline hover:underline hover:text-blue-600">
            Đơn hàng
        </a>
        <span class="mx-1">&gt;</span>
        <span class="font-semibold text-black">{{ $order->id }}</span>
    </div>

    <!-- Form cập nhật trạng thái -->
    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST"
          class="flex items-center bg-white rounded-full shadow px-4 py-2 w-max gap-4">
        @csrf
        @method('PUT')

        <span class="font-semibold">Mã đơn: {{ $order->id }}</span>

        <div class="col-md-6 mb-3">
            <label for="status" class="form-label fw-bold">Trạng thái đơn hàng</label>
            <select class="form-control" id="status" name="status">
                <option value="ĐANG XỬ LÝ" {{ old('status', $order->status) == 'ĐANG XỬ LÝ' ? 'selected' : '' }}>ĐANG XỬ LÝ</option>
                <option value="ĐANG GIAO" {{ old('status', $order->status) == 'ĐANG GIAO' ? 'selected' : '' }}>ĐANG GIAO</option>
                <option value="GIAO THÀNH CÔNG" {{ old('status', $order->status) == 'GIAO THÀNH CÔNG' ? 'selected' : '' }}>GIAO THÀNH CÔNG</option>
                <option value="ĐÃ HỦY" {{ old('status', $order->status) == 'ĐÃ HỦY' ? 'selected' : '' }}>ĐÃ HỦY</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>

    <!-- Thông báo thành công -->
    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- Địa chỉ nhận hàng -->
    <div class="bg-white rounded-xl shadow p-5 my-4">
        <div class="flex items-center mb-2">
            <span class="text-2xl mr-2">📍</span>
            <span class="font-semibold text-lg">Địa chỉ nhận hàng:</span>
        </div>
        <div class="ml-8">
            <div><span class="font-semibold">Tên người nhận:</span> {{ $order->user->name }}</div>
            <div><span class="font-semibold">Số điện thoại:</span> {{ $order->phone }}</div>
            <div><span class="font-semibold">Địa chỉ:</span> {{ $order->shipping_address }}</div>
        </div>
    </div>

    <!-- Danh sách sản phẩm -->
    @foreach($order->items as $item)
        <div class="flex bg-white rounded-xl shadow p-5 mb-4">
            <img src="{{ $item->product->image_url }}" alt="product" class="w-32 h-32 object-contain rounded-lg border mr-6">
            <div class="flex-1 flex flex-col justify-between">
                <div class="flex justify-between items-end">
                    <div class="text-sm">Số lượng: <span class="font-semibold">{{ $item->quantity }}</span></div>
                    <div class="text-right">
                        <div class="line-through text-gray-400 text-xs">{{ number_format($item->product->price) }}₫</div>
                        <div class="text-lg font-semibold text-black">{{ number_format($order->total_price) }}₫</div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Chi tiết tổng tiền -->
    <div x-data="{ open: false }" class="bg-white rounded-xl shadow p-5 mb-4">
        <div class="flex justify-between items-center cursor-pointer" @click="open = !open">
            <span class="font-semibold text-lg">Thành tiền:</span>
            <div class="flex items-center gap-1">
                <span class="font-bold text-lg text-blue-700">{{ number_format($order->total_price) }}₫</span>
                <svg :class="{'rotate-180': open}" class="w-5 h-5 transform transition-transform duration-300"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        </div>

        <div x-show="open" x-transition class="mt-4 text-sm space-y-2">
            <div class="flex justify-between">
                <span>Tổng tiền hàng:</span>
                <span>{{ number_format($order->total_product_price ?? $order->total_price) }}₫</span>
            </div>
            <div class="flex justify-between">
                <span>Phí vận chuyển:</span>
                <span>{{ number_format(30000, 0, ',', '.') }}₫</span>
            </div>
            <div class="flex justify-between">
                <span>Ưu đãi vận chuyển:</span>
                <span class="text-green-600">-{{ number_format(30000, 0, ',', '.') }}₫</span>
            </div>
            <div class="flex justify-between">
                <span>Mã giảm giá:</span>
                <span class="text-green-600">0₫</span>
            </div>
        </div>
    </div>

    <!-- Ghi chú và phương thức thanh toán -->
    <div class="bg-white rounded-xl shadow p-5 mb-4">
        <div class="mb-2"><span class="font-semibold">GHI CHÚ:</span></div>
        <div class="mb-2"><span class="font-semibold">Mã đơn hàng:</span> {{ $order->id }}</div>
        <div class="mb-2"><span class="font-semibold">Phương thức thanh toán:</span> Tài khoản liên kết ngân hàng</div>
    </div>
</div>
@endsection
