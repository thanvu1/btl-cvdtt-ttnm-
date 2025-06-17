@extends('orders.app')

@section('content')
<div class="container mx-auto p-4">

    {{-- ✅ Thông báo khi cập nhật --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- ✅ Thông tin đơn hàng + trạng thái --}}
    <div class="flex justify-between items-center bg-blue-100 text-blue-800 px-4 py-2 rounded mb-4">
        <span class="font-semibold text-lg">Mã đơn hàng: {{ $order->code }}</span>

        {{-- Form cập nhật trạng thái --}}
        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
    @csrf
    @method('PUT')
    <select name="status" onchange="this.form.submit()">
        <option value="ĐANG XỬ LÝ" {{ $order->status == 'ĐANG XỬ LÝ' ? 'selected' : '' }}>ĐANG XỬ LÝ</option>
        <option value="ĐANG GIAO" {{ $order->status == 'ĐANG GIAO' ? 'selected' : '' }}>ĐANG GIAO</option>
        <option value="GIAO THÀNH CÔNG" {{ $order->status == 'GIAO THÀNH CÔNG' ? 'selected' : '' }}>GIAO THÀNH CÔNG</option>
        <option value="HỦY" {{ $order->status == 'HỦY' ? 'selected' : '' }}>HỦY</option>
    </select>
</form>
