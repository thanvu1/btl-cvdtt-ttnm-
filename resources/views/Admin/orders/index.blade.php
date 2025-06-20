@extends('layouts.admin.app')

@section('content')
<style>
    .order-filter-col {
        min-width: 240px;
        max-width: 280px;
    }
    @media (max-width: 991.98px) {
        .order-filter-col {
            max-width: 100%;
            min-width: unset;
            margin-bottom: 20px;
        }
    }
</style>

<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <!-- Bộ lọc bên trái -->
        <div class="col-lg-3 order-filter-col">
            <form method="GET" action="{{ route('orders.index') }}">
                <div class="card mb-3">
                    <div class="card-header fw-bold py-2">🔍 Tìm kiếm & Lọc</div>
                    <div class="card-body">
                        <!-- Số điện thoại -->
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="search" class="form-control form-control-sm" value="{{ request('search') }}" placeholder="Nhập SĐT...">
                        </div>

                        <!-- Tên người nhận -->
                        <div class="mb-3">
                            <label class="form-label">Người nhận</label>
                            <input type="text" name="username" class="form-control form-control-sm" value="{{ request('username') }}" placeholder="Tên người nhận...">
                        </div>

                        <!-- Trạng thái -->
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select name="status" class="form-select form-select-sm">
                                <option value="">Tất cả</option>
                                <option value="Đang xử lý" {{ request('status') == 'Đang xử lý' ? 'selected' : '' }}>Đang xử lý</option>
                                <option value="Đã xác nhận" {{ request('status') == 'Đã xác nhận' ? 'selected' : '' }}>Đã xác nhận</option>
                                <option value="Đã huỷ" {{ request('status') == 'Đã huỷ' ? 'selected' : '' }}>Đã huỷ</option>
                                <option value="Đang giao" {{ request('status') == 'Đang giao' ? 'selected' : '' }}>Đang giao</option>
                                <option value="Giao thành công" {{ request('status') == 'Giao thành công' ? 'selected' : '' }}>Giao thành công</option>
                            </select>
                        </div>

                        <!-- Ngày tạo -->
                        <div class="mb-3">
                            <label class="form-label">Từ ngày</label>
                            <input type="date" name="from_date" class="form-control form-control-sm" value="{{ request('from_date') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Đến ngày</label>
                            <input type="date" name="to_date" class="form-control form-control-sm" value="{{ request('to_date') }}">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-sm">Áp dụng</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Danh sách đơn hàng bên phải -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold mb-0">📦 Danh sách đơn hàng</h4>
                <span class="text-muted">Tổng: {{ $orders->total() }} đơn</span>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Mã</th>
                            <th>Người nhận</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Giảm giá</th>
                            <th>Thành tiền</th>
                            <th>Tạo lúc</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->shipping_address }}</td>
                            <td>{{ $order->discount_code_id ?? 'Không có' }}</td>
                            <td class="text-success fw-bold">{{ number_format($order->total_price, 0, ',', '.') }} đ</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge rounded-pill {{ $order->status === 'Giao thành công' ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xác nhận xoá?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">Không có đơn hàng phù hợp.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3 d-flex justify-content-end">
                {{ $orders->appends(request()->all())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
