@extends('orders.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white p-6 rounded-lg shadow-md max-w-md mx-auto">
        <h2 class="text-xl font-semibold mb-4">XÁC NHẬN</h2>

        <p class="mb-6 text-gray-700">
            Bạn có chắc muốn xóa đơn hàng không?
        </p>

        @if ($order->status === 'GIAO THÀNH CÔNG')
            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="flex justify-end gap-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Xác nhận
                </button>
                <a href="{{ route('orders.index') }}" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">
                    Hủy
                </a>
            </form>
        @else
            <div class="p-4 bg-red-100 border border-red-400 text-red-700 rounded-md mb-4">
                <strong>Lỗi:</strong> Không thể xóa đơn hàng này! Vui lòng kiểm tra điều kiện hoặc liên hệ quản trị viên.
            </div>
            <div class="text-center">
                <a href="{{ route('orders.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
            ⬅ Quay lại danh sách đơn hàng
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
