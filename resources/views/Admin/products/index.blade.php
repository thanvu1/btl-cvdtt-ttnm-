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
        <!-- Filter Column -->
        <div class="col-lg-3 product-filter-col">
            <div class="mb-3">
                <div class="card">
                    <div class="card-header fw-bold py-2">Lọc theo danh mục</div>
                    <div class="card-body">
                        <form id="categoryForm" method="get">
                            <select class="form-select form-select-sm mb-2" name="category_id" onchange="this.form.submit()">
                                <option value="">Tất cả</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @foreach(request()->except('category_id', 'page') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header fw-bold py-2">Lọc theo quốc gia</div>
                    <div class="card-body">
                        <form id="countryForm" method="get">
                            <select class="form-select form-select-sm mb-2" name="country" onchange="this.form.submit()">
                                <option value="">Tất cả</option>
                                @foreach($countries as $country)
                                <option value="{{ $country }}" {{ request('country') == $country ? 'selected' : '' }}>{{ $country }}</option>
                                @endforeach
                            </select>
                            @foreach(request()->except('country', 'page') as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Table -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="fw-bold flex-grow-1 text-center mb-0">QUẢN LÝ SẢN PHẨM</h3>
            </div>
            <div class="d-flex align-items-center mb-3" style="gap: 1rem;">
                <form method="get" class="input-group" style="width: 340px;">
                    <input type="text" class="form-control" name="search" placeholder="Nhập tên sản phẩm" value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                    @foreach(request()->except('search', 'page') as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                </form>
                <a href="{{ route('admin.products.create') }}" class="btn btn-success ms-auto rounded-pill" style="white-space:nowrap; min-width:170px;">
                    <i class="fa fa-plus"></i> Thêm sản phẩm
                </a>
            </div>
            @if(session('success'))
            <div id="alert-success" class="alert" style="background: #80ff80; color: #226200; border-radius: 4px; border: none; position: relative;">
                <span style="font-weight: bold;">Thành công!</span><br>
                {{ session('success') }}
                <button type="button" onclick="this.parentElement.style.display='none'"
                        style="position: absolute; right: 8px; top: 2px; background: none; border: none;
                font-size: 1.3em; cursor: pointer; color: #226200; line-height: 1;">×</button>
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Quốc gia</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Tồn kho</th>
                        <th>Hạn sử dụng</th>
                        <th>Tác vụ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? '' }}</td>
                        <td>{{ $product->country }}</td>
                        <td>{{ Str::limit($product->description, 40) }}</td>
                        <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            {{ $product->created_at ? $product->created_at->format('d/m/Y') : '' }}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-outline-dark btn-sm" title="Sửa">
                                <i class="fa fa-pen-to-square fa-lg"></i>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger btn-sm" title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Không có dữ liệu</td>
                    </tr>
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
