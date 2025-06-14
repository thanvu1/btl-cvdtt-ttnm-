@extends('layouts.admin-app')
@section('content')
    <div class="container">
        <h1>Quản lý mã giảm giá</h1>
        <a href="{{ route('admin.discount-codes.create') }}" class="btn btn-primary">Thêm mới</a>
        <table class="table">
            <thead>
            <tr>
                <th>Tên mã giảm giá</th>
                <th>Loại khuyến mãi</th>
                <th>Giảm giá</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Trạng thái</th>
                <th>Mô tả</th>
                <th>Tác vụ</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($list as $comp)
                <tr>
                    <td>{{ $comp->code }}</td>
                    <td>
                        @if($comp->type === 'percent')
                            Giảm theo phần trăm
                        @elseif($comp->type === 'fixed')
                            Giảm theo số tiền
                        @endif
                    </td>
                    <td>
                        @if($comp->type === 'percent')
                            {{ $comp->discount_amount }}%
                        @elseif($comp->type === 'fixed')
                            {{ number_format($comp->discount_amount, 0, ',', '.') }} đ
                        @endif
                    </td>
                    <td>{{ $comp->started_at }}</td>
                    <td>{{ $comp->expires_at }}</td>
                    <td>
                        @if($comp->state === 'active')
                            <span>Kích hoạt</span>
                        @elseif($comp->state === 'inactive')
                            <span>Chưa kích hoạt</span>
                        @elseif($comp->state === 'expired')
                            <span>Hết hạn</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.discount-codes.edit', $comp->id) }}" class="btn btn-warning">Sửa</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
