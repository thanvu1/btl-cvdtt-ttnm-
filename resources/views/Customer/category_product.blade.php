@extends('layouts.customer.app')

@section('title', 'Trang chủ')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Trang chủ</li>
@endsection

@section('content')

<div class="container py-4">
    @foreach($categories as $category)
        <h2 class="mb-1">{{ $category->name }}</h2>
        <hr style="border: 2px solid rgb(0, 0, 0);">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-5 mb-4">
            @foreach($category->products->take(5) as $product)
                <div class="col">
                    <div class="card h-100 position-relative" style="min-height: 350px;">
                        <img src="{{ $product->image ?? 'https://placehold.co/200x200?text=No+Image' }}" class="card-img-top" alt="{{ $product->name }}">
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
                                style="width:40px; height:40px; overflow:hidden; transition:all 0.3s;">
                            <i class="bi bi-cart-plus"></i>
                            <span class="add-to-cart-text ms-2" style="white-space:nowrap; opacity:0; width:0; transition:opacity 0.3s, width 0.3s;">Thêm vào giỏ</span>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mb-5 mt-4">
            <a href="{{ route('showByCategory', ['id' => $category->id]) }}" class="btn btn-primary px-4">
                Xem thêm <i class="bi bi-chevron-double-right"></i>
            </a>
        </div>
    @endforeach

    {{-- Mục Thuốc --}}
    {{-- <h2 class="mb-1">Thuốc</h2>
    <hr style="border: 2px solid rgb(0, 0, 0);">
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-5">
        @foreach($thuocs as $thuoc)
            <div class="col">
                <div class="card h-100 position-relative" style="min-height: 350px;">
                    <img src="{{ $thuoc->image }}" class="card-img-top" alt="{{ $thuoc->name }}">
                    <div class="card-body d-flex flex-column p-3 pb-4">
                        <h6 class="card-title mb-1 text-truncate" title="{{ $thuoc->name }}">{{ $thuoc->name }}</h6>
                        <div class="mb-2" style="min-height: 38px;">
                            <span class="text-muted" style="font-size: 0.95rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $thuoc->desc }}</span>
                        </div>
                        <div class="d-flex align-items-center mt-auto">
                            <span class="text-danger fw-bold" style="font-size: 1.1rem;">
                                {{ number_format($thuoc->price, 0, ',', '.') }} đ
                            </span>
                            <span class="text-secondary text-decoration-line-through ms-2" style="font-size: 1rem;">
                                {{ number_format($thuoc->old_price, 0, ',', '.') }} đ
                            </span>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-success add-to-cart-btn position-absolute bottom-0 end-0 m-1 d-flex align-items-center justify-content-center rounded-circle"
                            style="width:40px; height:40px; overflow:hidden; transition:all 0.3s;">
                        <i class="bi bi-cart-plus"></i>
                        <span class="add-to-cart-text ms-2" style="white-space:nowrap; opacity:0; width:0; transition:opacity 0.3s, width 0.3s;">Thêm vào giỏ</span>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="text-center mb-5 mt-4">
        <a href="{{ url('/thuoc') }}" class="btn btn-primary px-4">
            Xem thêm <i class="bi bi-chevron-double-right"></i>
        </a>
    </div> --}}

    {{-- Sản phẩm bán chạy nhất --}}
    {{-- <h2 class="mt-5 mb-3">Sản phẩm bán chạy nhất</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 g-5">
        @foreach($bestSellers as $product)
            <div class="col">
                <div class="card h-100 position-relative" style="min-height: 370px;">
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column p-3 pb-4">
                        <h6 class="card-title mb-1 text-truncate" title="{{ $product->name }}">{{ $product->name }}</h6>
                        <div class="mb-2" style="min-height: 38px;">
                            <span class="text-muted" style="font-size: 0.95rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $product->desc }}</span>
                        </div>
                        <div class="d-flex align-items-center mt-auto">
                            <span class="text-danger fw-bold" style="font-size: 1.1rem;">
                                {{ number_format($product->price, 0, ',', '.') }} đ
                            </span>
                            <span class="text-secondary text-decoration-line-through ms-2" style="font-size: 1rem;">
                                {{ number_format($product->old_price, 0, ',', '.') }} đ
                            </span>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-success add-to-cart-btn position-absolute bottom-0 end-0 m-1 d-flex align-items-center justify-content-center rounded-circle"
                            style="width:40px; height:40px; overflow:hidden; transition:all 0.3s;">
                        <i class="bi bi-cart-plus"></i>
                        <span class="add-to-cart-text ms-2" style="white-space:nowrap; opacity:0; width:0; transition:opacity 0.3s, width 0.3s;">Thêm vào giỏ</span>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    <div class="text-center mb-5 mt-4">
        <a href="{{ url('/ban-chay') }}" class="btn btn-primary px-4">
            Xem thêm <i class="bi bi-chevron-double-right"></i>
        </a>
    </div> --}}

    {{-- Mục Thực phẩm chức năng --}}
    {{-- <h2 class="mt-5 mb-3">Thực phẩm chức năng</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 g-5">
        @foreach($tpcns as $tp)
            <div class="col">
                <div class="card h-100 position-relative" style="min-height: 370px;">
                    <img src="{{ $tp->image }}" class="card-img-top" alt="{{ $tp->name }}">
                    <div class="card-body d-flex flex-column p-3 pb-4">
                        <h6 class="card-title mb-1 text-truncate" title="{{ $tp->name }}">{{ $tp->name }}</h6>
                        <div class="mb-2" style="min-height: 38px;">
                            <span class="text-muted" style="font-size: 0.95rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $tp->desc }}</span>
                        </div>
                        <div class="d-flex align-items-center mt-auto">
                            <span class="text-danger fw-bold" style="font-size: 1.1rem;">
                                {{ number_format($tp->price, 0, ',', '.') }} đ
                            </span>
                            <span class="text-secondary text-decoration-line-through ms-2" style="font-size: 1rem;">
                                {{ number_format($tp->old_price, 0, ',', '.') }} đ
                            </span>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-success add-to-cart-btn position-absolute bottom-0 end-0 m-1 d-flex align-items-center justify-content-center rounded-circle"
                            style="width:40px; height:40px; overflow:hidden; transition:all 0.3s;">
                        <i class="bi bi-cart-plus"></i>
                        <span class="add-to-cart-text ms-2" style="white-space:nowrap; opacity:0; width:0; transition:opacity 0.3s, width 0.3s;">Thêm vào giỏ</span>
                    </button>
                </div>
            </div>
        @endforeach
    </div> --}}
    {{-- <div class="text-center mb-5 mt-4">
        <a href="{{ url('/thuc-pham-chuc-nang') }}" class="btn btn-primary px-4">
            Xem thêm <i class="bi bi-chevron-double-right"></i>
        </a>
    </div> --}}
</div>
@endsection

{{-- Thêm đoạn CSS sau vào file hoặc trong <style> --}}
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
