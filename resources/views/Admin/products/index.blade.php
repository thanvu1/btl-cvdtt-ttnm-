@extends('layouts.admin.app')

@section('content')
<style>
    .product-filter-col {
        min-width: 240px;
        max-width: 280px;
    }
    @media (max-width: 991.98px) {
        .product-filter-col {
            max-width: 100%;
            min-width: unset;
            margin-bottom: 20px;
        }
    }
</style>

<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <!-- Bộ lọc -->
        <div class="col-lg-3 product-filter-col">
            <form method="GET" action="{{ route('admin.products.index') }}">
                <div class="card mb-3">
                    <div class="card-header fw-bold py-2">Tìm kiếm & Lọc</div>
                    <div class="card-body">
                        <!-- Từ khoá -->
                        <div class="mb-2">
                            <label class="form-label">Từ khoá</label>
                            <input type="text" name="search" class="form-control form-control-sm" value="{{ request('search') }}" placeholder="Nhập tên sản phẩm...">
                        </div>

                        <!-- Danh mục -->
                        <div class="mb-2">
                            <label class="form-label">Danh mục</label>
                            <select class="form-select form-select-sm" name="category_id">
                                <option value="">Tất cả</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Quốc gia -->
                        <div class="mb-2">
                            <label class="form-label">Quốc gia</label>
                            <select class="form-select form-select-sm" name="country">
                                <option value="">Tất cả</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country }}" {{ request('country') == $country ? 'selected' : '' }}>{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Giá -->
                        <div class="mb-2">
                            <label class="form-label">Khoảng giá (VD: 10000-50000)</label>
                            <input type="text" name="price" class="form-control form-control-sm" value="{{ request('price') }}">
                        </div>

                        <!-- Tồn kho -->
                        <div class="mb-3">
                            <label class="form-label">Tồn kho</label>
                            <select name="in_stock" class="form-select form-select-sm">
                                <option value="">-- Tất cả --</option>
                                <option value="1" {{ request('in_stock') == '1' ? 'selected' : '' }}>Còn hàng</option>
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-sm">Áp dụng lọc</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="fw-bold flex-grow-1 text-center mb-0">QUẢN LÝ SẢN PHẨM</h3>
                <a href="{{ route('admin.products.create') }}" class="btn btn-success rounded-pill ms-3" style="white-space: nowrap; min-width:170px;">
                    <i class="fa fa-plus"></i> Thêm sản phẩm
                </a>
            </div>

            @if(session('success'))
                <div id="alert-success" class="alert alert-success">
                    <strong>Thành công!</strong> {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Tên</th>
                            <th>Danh mục</th>
                            <th>Quốc gia</th>
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th>Tồn kho</th>
                            <th>Hạn dùng</th>
                            <th>Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? '' }}</td>
                                <td>{{ $product->country }}</td>
                                <td>{{ Str::limit($product->description, 40) }}</td>
                                <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->expiration_date ? \Carbon\Carbon::parse($product->expiration_date)->format('d/m/Y') : '' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-outline-dark btn-sm">
                                        <i class="fa fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center">Không có sản phẩm phù hợp</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
