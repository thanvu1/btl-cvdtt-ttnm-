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
            <div class="text-red-600 font-semibold mb-4">
                Không thể xóa đơn hàng này!
            </div>
            <a href="{{ route('orders.index') }}" class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded inline-block">
                Quay lại
            </a>
        @endif
    </div>
</div>
@endsection
