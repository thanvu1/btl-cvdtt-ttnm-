@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">
        <div class="bg-white rounded shadow p-4 mt-4">
            <h2 class="text-center fw-bold mb-3" style="letter-spacing: 1px;">THÊM MÃ GIẢM GIÁ</h2>
            <div class="border p-3 mb-4">
                <div class="fw-bold mb-3" style="font-size: 1.25rem; letter-spacing: 1px;">THÔNG TIN CHUNG</div>
                <form action="{{ route('admin.discount-codes.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Tên mã giảm -->
                        <div class="col-md-6 mb-3">
                            <label for="code" class="form-label fw-bold">Tên mã giảm</label>
                            <input type="text" class="form-control" id="code" name="code" placeholder="VD: KM0001" value="{{ old('code') }}">
                            @error('code')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Trạng thái -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold d-block">Trạng Thái</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="state" id="active" value="active" {{ old('state') == 'active' ? 'checked' : '' }}>
                                <label class="form-check-label" for="active">Kích hoạt</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="state" id="inactive" value="inactive" {{ old('state', 'inactive') == 'inactive' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inactive">Không kích hoạt</label>
                            </div>
                            @error('state')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Ngày bắt đầu -->
                        <div class="col-md-6 mb-3">
                            <label for="started_at" class="form-label fw-bold">Ngày bắt đầu</label>
                            <input type="date" class="form-control" id="started_at" name="started_at" value="{{ old('started_at') }}">
                            @error('started_at')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Ngày kết thúc -->
                        <div class="col-md-6 mb-3">
                            <label for="expires_at" class="form-label fw-bold">Ngày kết thúc</label>
                            <input type="date" class="form-control" id="expires_at" name="expires_at" value="{{ old('expires_at') }}">
                            @error('expires_at')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Loại khuyến mãi -->
                        <div class="col-md-6 mb-3">
                            <label for="type" class="form-label fw-bold">Loại khuyến mãi</label>
                            <select class="form-control" id="type" name="type">
                                <option value="" disabled {{ old('type') == null ? 'selected' : '' }}>-- Chọn loại --</option>
                                <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Phần trăm</option>
                                <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Số tiền cụ thể</option>
                            </select>
                            @error('type')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Mô tả -->
                        <div class="col-md-6 mb-3">
                            <label for="description" class="form-label fw-bold">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Mô tả chi tiết">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Giá trị giảm giá -->
                        <div class="col-md-6 mb-3">
                            <label for="discount_amount" class="form-label fw-bold">Giảm giá</label>
                            <input type="text" class="form-control" id="discount_amount" name="discount_amount" placeholder="VD: 10%" value="{{ old('discount_amount') }}">
                            @error('discount_amount')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Giá trị đơn hàng tối thiểu -->
                        <div class="col-md-6 mb-3">
                            <label for="min_order_value" class="form-label fw-bold">Giá trị đơn hàng tối thiểu</label>
                            <input type="number" class="form-control" id="min_order_value" name="min_order_value" placeholder="VD: 200000" value="{{ old('min_order_value') }}">
                            @error('min_order_value')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-4 rounded-pill">Tạo</button>
                        <a href="{{ route('admin.discount-codes.index') }}" class="btn btn-secondary px-4 ms-2 rounded-pill">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" style="margin-right: 6px; margin-top: -2px;" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H3.707l4.147 4.146a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 1 1 .708.708L3.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
                            </svg>
                            Quay lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
