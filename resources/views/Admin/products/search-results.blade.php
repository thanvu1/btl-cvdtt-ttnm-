<h2 class="mb-4">Kết quả tìm kiếm</h2>

@if($products->count())
<div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Quốc gia</th>
                <th>Mô tả</th>
                <th>Giá</th>
                <th>Tồn kho</th>
                <th>Hạn sử dụng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? '-' }}</td>
                    <td>{{ $product->country }}</td>
                    <td>{{ Str::limit($product->description, 40) }}</td>
                    <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->expiration_date ? \Carbon\Carbon::parse($product->expiration_date)->format('d/m/Y') : '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-3 d-flex justify-content-end">
    {{ $products->withQueryString()->links() }}
</div>
@else
    <p class="text-muted">Không tìm thấy sản phẩm nào phù hợp.</p>
@endif
