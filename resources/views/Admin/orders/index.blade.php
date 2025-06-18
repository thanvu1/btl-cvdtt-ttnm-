@extends('layouts.admin.app')

@section('content')
<div class="p-6">
  <h2 class="text-lg font-semibold text-gray-700 mb-4">📦 Quản lý đơn hàng</h2>

  <!-- Search -->
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <span class="text-sm text-gray-500">Tổng số đơn hàng: {{ $orders->count() }}</span>
    <form method="get" class="input-group" style="width: 340px;">
    <input type="text" class="form-control" name="search" placeholder="Nhập số điện thoại.." value="{{ request('search') }}">
    <button class="btn btn-outline-secondary" type="submit">
        <i class="fa fa-search"></i>
    </button>
    @foreach(request()->except('search', 'page') as $key => $value)
        @if(is_array($value))
            @foreach($value as $v)
                <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
            @endforeach
        @else
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endif
    @endforeach
</form>
  </div>

  <!-- Table -->
  <div class="overflow-x-auto bg-white border rounded-lg shadow-sm">
    <table class="min-w-full text-sm">
      <thead class="bg-gray-200 text-left">
        <tr class="border-b">
          @foreach(['Mã đơn', 'Người nhận', 'Số điện thoại', 'Địa chỉ', 'Giảm giá', 'Thành tiền', 'Tạo lúc', 'Cập nhật', 'Trạng thái', 'Thao tác'] as $header)
            <th class="px-4 py-2">{{ $header }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @forelse ($orders as $order)
        <tr class="border-b hover:bg-gray-100">
          <td class="px-4 py-2">{{ $order->id }}</td>
          <td class="px-4 py-2">{{ $order->user->name }}</td>
          <td class="px-4 py-2">{{ $order->phone }}</td>
          <td class="px-4 py-2">{{ $order->shipping_address }}</td>
          <td class="px-4 py-2">{{ $order->discount_code_id ?? 'Không có' }}</td>
          <td class="px-4 py-2 font-bold text-green-600">{{ number_format($order->total_price, 0, ',', '.') }} đ</td>
          <td class="px-4 py-2">{{ $order->created_at->format('d/m/Y H:i') }}</td>
          <td class="px-4 py-2">{{ $order->updated_at->format('d/m/Y H:i') }}</td>
          <td class="px-4 py-2 text-center">
            <span class="text-sm font-semibold px-2 py-1 rounded {{ $order->status === 'Giao thành công' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
              {{ $order->status }}
            </span>
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
        @empty
        <tr>
          <td colspan="10" class="text-center py-4 text-gray-500">Không có đơn hàng nào.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Pagination (nếu có) -->
  <div class="mt-4">
    {{ $orders->links() }}
  </div>
</div>
@endsection
