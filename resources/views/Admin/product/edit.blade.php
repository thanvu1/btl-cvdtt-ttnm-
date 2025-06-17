@extends('layouts.admin.app')

@section('content')
    <div class="container mt-4">
        <div class="bg-white rounded shadow p-4 mt-4">
            <h2 class="text-center fw-bold mb-3" style="letter-spacing: 1px;">CẬP NHẬT SẢN PHẨM</h2>
            <div class="border p-3 mb-4">
                <div class="fw-bold mb-3" style="font-size: 1.25rem; letter-spacing: 1px;">THÔNG TIN CHUNG</div>
                <form action="{{ route('admin.products.edit', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Mã sản phẩm -->
                        <div class="col-md-6 mb-3">
                            <label for="code" class="form-label fw-bold">Mã sản phẩm <span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $product->code) }}" readonly>
                            @error('code')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Tên sản phẩm -->
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label fw-bold">Tên sản phẩm <span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên sản phẩm"
                                   value="{{ old('name', $product->name) }}">
                            @error('name')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Giá bán -->
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label fw-bold">Giá bán <span class="text-danger">*</span>:</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="VD: 150000"
                                   value="{{ old('price', $product->price) }}">
                            @error('price')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Số lượng -->
                        <div class="col-md-6 mb-3">
                            <label for="stock" class="form-label fw-bold">Số lượng <span class="text-danger">*</span>:</label>
                            <input type="number" class="form-control" id="stock" name="stock" placeholder="VD: 100"
                                   value="{{ old('stock', $product->stock) }}">
                            @error('stock')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Hạn sử dụng -->
                        <div class="col-md-6 mb-3">
                            <label for="expiry_date" class="form-label fw-bold">Hạn sử dụng <span class="text-danger">*</span>:</label>
                            <input type="date" class="form-control" id="expiry_date" name="expiry_date"
                                   value="{{ old('expiry_date', optional($product->expiry_date)->format('Y-m-d')) }}">
                            @error('expiry_date')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Mô tả -->
                        <div class="col-md-6 mb-3">
                            <label for="description" class="form-label fw-bold">Mô tả:</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Mô tả chi tiết">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Loại sản phẩm -->
                        <div class="col-md-6 mb-3">
                            <label for="category_id" class="form-label fw-bold">Loại sản phẩm <span class="text-danger">*:</span></label>
                            <select class="form-control" id="category_id" name="category_id">
                                <option value="" disabled>-- Chọn loại --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Xuất xứ -->
                        <div class="col-md-6 mb-3">
                            <label for="country" class="form-label fw-bold">Xuất xứ <span class="text-danger">*</span>:</label>
                            <input type="text" class="form-control" id="country" name="country" placeholder="VD: Việt Nam"
                                   value="{{ old('country', $product->country) }}">
                            @error('country')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-4 rounded-pill">Cập nhật</button>
                        <a href="{{ url('/') }}" class="btn btn-secondary px-4 ms-2 rounded-pill">
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