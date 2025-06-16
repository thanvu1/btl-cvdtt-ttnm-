@extends('layouts.admin')

@section('content')
<div class="p-6">
  <h2 class="text-lg text-gray-600 mb-4">Trang chủ > Đơn hàng</h2>

  <!-- Search -->
  <div class="flex justify-end mb-3">
    <input type="text" placeholder="Search..." class="border px-3 py-1 rounded shadow-sm">
  </div>

  <!-- Table -->
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white border rounded shadow text-sm">
      <thead class="bg-gray-100 text-left">
        <tr class="border-b">
          <th class="px-4 py-2">Mã đơn hàng</th>
          <th class="px-4 py-2">Người nhận</th>
          <th class="px-4 py-2">Số điện thoại</th>
          <th class="px-4 py-2">Địa chỉ</th>
          <th class="px-4 py-2">Mã giảm giá</th>
          <th class="px-4 py-2">Thành tiền</th>
          <th class="px-4 py-2">Thời gian tạo </th> 
          <th class="px-4 py-2">Thời gian cập nhật</th>
          <th class="px-4 py-2">Trạng thái</th>
          <th class="px-4 py-2 text-center">Thao tác</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $order)
        <tr class="border-b hover:bg-gray-50">
          <td class="px-4 py-2">{{ $order->id }}</td>
          <td class="px-4 py-2">{{ $order->user->name }}</td>
          <td class="px-4 py-2">{{ $order->phone }}</td>
          <td class="px-4 py-2">{{ $order->shipping_address }}</td>
          <td class="px-4 py-2">{{ $order->discount_code_id ?? 'Không có' }}</td>
          <td class="px-4 py-2">{{ number_format($order->total_amount, 0, ',', '.') }} đ</td>
          <td class="px-4 py-2">
            <span class="text-sm font-semibold">
              {{ $order->status }}
            </span>
          </td>
          <td class="px-4 py-2">{{ $order->created_at->format('Y-m-d H:i:s') }}</td> 
          <td class="px-4 py-2">{{ $order->updated_at->format('Y-m-d H:i:s') }}</td> 
          <td class="px-4 py-2 text-center">
            @if ($order->status === 'Giao thành công')
            {{-- Không cho click, màu xám --}}
            <i class="bi bi-check-square-fill text-gray-400 cursor-not-allowed"></i>
             @else
            {{-- Cho click (ví dụ gọi modal đổi trạng thái) --}}
            <button onclick="openStatusModal('{{ $order->id }}')">
                <i class="bi bi-check-square-fill text-green-600 hover:text-green-800"></i>
            </button>
            @endif
        </td>
          <td class="px-4 py-2 flex gap-2 justify-center">
            <a href="{{ route('orders.edit', $order->id) }}" class="text-blue-600 hover:text-blue-800"><i class="bi bi-pencil-square"></i></a>
            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa đơn hàng này?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 hover:text-red-800"><i class="bi bi-trash"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Pagination (nếu có) -->
  <div class="mt-4">
    {{ $orders->links() }}
  </div>
</div>
@endsection
