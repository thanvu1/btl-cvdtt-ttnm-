<?php

namespace App\Http\Controllers;
use App\Patterns\Repository\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\DiscountCode;
use App\Models\User;
use App\Patterns\Factory\Product\ProductFactory;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected ProductRepositoryInterface $repo;

    //REPOSITORY
    public function __construct(ProductRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
    public function index($categoryId = null)
    {
        // Check if user is admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            $categories = Category::all();
            $countries = Product::select('country')->distinct()->pluck('country')->filter()->values();

            $products = $this->repo->filterAndPaginate(request()->all());

            return view('admin.products.index', compact('products', 'categories', 'countries'));
        }

        // Customer view (default)
        $categories = Category::with('products')->get();
        return view('Customer.index', compact('categories'));
    }

    //Bộ lọc cũ không dùng REPOSITORY
    // public function showByCategory($categoryId)
    // {
    // //     $category = Category::find($categoryId);
    // //     $products = Product::where('category_id', $categoryId)->get();

    // //     return view('Customer.category_product', compact('category', 'products'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('Admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'type'         => 'required|in:medicine,equipment,supplement,personal_care,pharmaceutical_cosmetic',  // thêm dòng này
        'name'         => 'required|string|max:255',
        'price'        => 'required|numeric|min:0',
        'stock'        => 'required|integer|min:0',
        'expiration_date' => 'nullable|date',
        //'category_id'  => 'required|exists:categories,id',
        'country'      => 'required|string|max:255',
        'description'  => 'nullable|string',
        'dosage'       => 'nullable|string',   // chỉ dùng nếu là thuốc
        'model'        => 'nullable|string',   // chỉ dùng nếu là thiết bị y tế
        'usage'        => 'nullable|string',   // chỉ dùng nếu là thực phẩm chức năng
        'skin_type'    => 'nullable|string', // riêng cho personal care
        'effect'       => 'nullable|string', // riêng cho dược - mỹ phẩm
    ]);

    //dd($request->input('type'));
    // Gọi Factory
    $productEntity = ProductFactory::create($request->input('type'), [
        'name'   => $request->input('name'),
        'price'  => $request->input('price'),
        'dosage' => $request->input('dosage'),
        'model'  => $request->input('model'),
        'usage'  => $request->input('usage'),
    ]);

    //dd($productEntity);
    // Tạo Eloquent model từ entity
    Product::create([
        'name'         => $productEntity->getName(),
        'price'        => $productEntity->getPrice(),
        'stock'        => $request->input('stock'),
        'expiration_date' => $request->input('expiration_date'),
        //'category_id'  => $request->input('category_id'),
        'country'      => $request->input('country'),
        'description'  => $request->input('description'),
    ]);

    return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('Admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'name'        => 'required|string|max:255',
        'price'       => 'required|numeric|min:0',
        'stock'       => 'required|integer|min:0',
        'expiration_date' => 'required|date',
        'category_id' => 'required|exists:categories,id',
        'country'     => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $product->update($request->all());

    return redirect()->route('admin.products.index', $product->id)->with('success', 'Cập nhật sản phẩm thành công!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Xoá sản phẩm thành công!');
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword') ?? $request->input('q'); // Hỗ trợ cả 'q' và 'keyword'
        $priceRange = $request->input('price');

        $query = Product::query()->orderBy('created_at', 'desc');

        // Tìm theo tên hoặc mô tả
        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        // Lọc theo giá nếu có
        if (!empty($priceRange) && strpos($priceRange, '-') !== false) {
            [$min, $max] = explode('-', $priceRange);
            $query->whereBetween('price', [(int)$min, (int)$max]);
        }

        // Phân trang (ví dụ: 12 sản phẩm/trang)
        $products = $query->paginate(12)->appends($request->all());
        $stockOptions = [
            'in_stock' => 'Còn hàng',
            'out_of_stock' => 'Hết hàng',
        ];

        return view('layouts.customer.search', compact('products', 'keyword', 'stockOptions'));
    }
}
