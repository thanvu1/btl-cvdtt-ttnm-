    @extends('layouts.customer.app')

@section('title', 'Kết quả tìm kiếm')

@section('breadcrumb')
<li class="breadcrumb-item"><a class="text-black text-decoration-underline" href="{{ url('/') }}">Trang chủ</a></li>
<li class="breadcrumb-item active" aria-current="page">Tìm kiếm</li>
@endsection

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Kết quả tìm kiếm cho: "<span class="text-primary">{{ request('keyword') }}</span>"</h2>

    <div class="row">
        <!-- Filter Column -->
        <div class="col-md-3 mb-4">
            <form id="filter-form" method="GET" action="{{ route('search') }}">
                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                {{-- Mức giá --}}
                <div class="card mb-3">
                    <div class="card-header fw-bold">Mức giá</div>
                    <div class="card-body">
                        @php
                        $priceFilters = [
                        '0-0' => 'Tất cả',
                        '0-200000' => 'Dưới 200.000',
                        '200000-500000' => 'Từ 200.000 - 500.000',
                        '500000-1000000' => 'Từ 500.000 - 1 triệu',
                        '1000000-' => 'Trên 1 triệu'
                        ];
                        $selectedPrice = request('price'); // vì chỉ còn 1 giá trị
                        @endphp

                        @foreach($priceFilters as $value => $label)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="price" value="{{ $value }}" id="price_{{ $loop->index }}"
                                   {{ $selectedPrice === $value ? 'checked' : '' }}>
                            <label class="form-check-label" for="price_{{ $loop->index }}">{{ $label }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Tình trạng hàng --}}
                <div class="card mb-3">
                    <div class="card-header fw-bold">Mức giá</div>
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="stock_status" value="all" id="stock_all"
                                   {{ request('stock_status') === 'all' || request('stock_status') === null ? 'checked' : '' }}>
                            <label class="form-check-label" for="stock_all">Tất cả</label>
                        </div>
                        @foreach($stockOptions as $value => $label)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="stock_status" value="{{ $value }}" id="stock_{{ $loop->index }}"
                                   {{ request('stock_status') === $value ? 'checked' : '' }}>
                            <label class="form-check-label" for="stock_{{ $loop->index }}">{{ $label }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Xuất xứ --}}
                <div class="card mb-3">
                    <div class="card-header fw-bold">Xuất xứ</div>
                    <div class="card-body">
                        @php
                        $countries = \App\Models\Product::select('country')->distinct()->whereNotNull('country')->pluck('country')->toArray();
                        $selectedCountries = request('country', []);
                        @endphp
                        @foreach($countries as $country)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="country[]" value="{{ $country }}" id="country_{{ $loop->index }}"
                                   {{ is_array($selectedCountries) && in_array($country, $selectedCountries) ? 'checked' : '' }}>
                            <label class="form-check-label" for="country_{{ $loop->index }}">{{ $country }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Lọc</button>
            </form>
        </div>

        <!-- Search Results -->
        <div class="col-md-9">
            @if($products->count())
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
                @foreach($products as $product)
                <div class="col">
                    <div class="card h-100 position-relative" style="min-height: 350px;">
                        <img src="{{ $product->image ? asset('image/products/' . $product->image) : asset('image/Medical-Devices-Industry-2.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column p-3 pb-4">
                            <h6 class="card-title mb-1 text-truncate" title="{{ $product->name }}">{{ $product->name }}</h6>
                            <div class="mb-2" style="min-height: 38px;">
                                <span class="text-muted" style="font-size: 0.95rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $product->description }}
                                </span>
                            </div>
                            <div class="d-flex align-items-center mt-auto">
                                <span class="text-danger fw-bold" style="font-size: 1.1rem;">
                                    {{ number_format($product->price, 0, ',', '.') }} đ
                                </span>
                                @if(isset($product->old_price))
                                <span class="text-secondary text-decoration-line-through ms-2" style="font-size: 1rem;">
                                    {{ number_format($product->old_price, 0, ',', '.') }} đ
                                </span>
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-sm btn-success add-to-cart-btn position-absolute bottom-0 end-0 m-1 d-flex align-items-center justify-content-center rounded-circle"
                                style="width:40px; height:40px; overflow:hidden; transition:all 0.3s;"
                                data-product-id="{{ $product->id }}">
                            <i class="bi bi-cart-plus"></i>
                            <span class="add-to-cart-text ms-2" style="white-space:nowrap; opacity:0; width:0;">Thêm vào giỏ</span>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="alert alert-warning mt-4">
                Không tìm thấy sản phẩm nào phù hợp.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
@push('styles')
<style>
    .add-to-cart-btn {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        transition: width 0.3s, border-radius 0.3s;
        justify-content: center !important;
        align-items: center !important;
        padding: 0 !important;
    }
    .add-to-cart-btn .add-to-cart-text {
        opacity: 0;
        width: 0;
        transition: opacity 0.3s, width 0.3s;
        padding: 0;
        margin: 0;
        display: none;
    }
    .add-to-cart-btn:hover {
        width: 140px !important;
        border-radius: 40px !important;
        justify-content: flex-start !important;
        padding-left: 16px !important;
    }
    .add-to-cart-btn:hover .add-to-cart-text {
        opacity: 1 !important;
        width: auto !important;
        margin-left: 8px;
        display: inline;
    }
</style>
@endpush
