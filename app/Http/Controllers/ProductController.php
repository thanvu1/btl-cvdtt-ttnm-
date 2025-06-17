<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\DiscountCode;
use App\Models\User;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($categoryId = null)
    {
        // Check if user is admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            $categories = Category::all();
            $countries = Product::select('country')->distinct()->pluck('country')->filter()->values();
            $query = Product::query();

            // Optional: filter by category or country
            if (request('category_id')) {
                $query->where('category_id', request('category_id'));
            }
            if (request('country')) {
                $query->where('country', request('country'));
            }
            if (request('search')) {
                $search = request('search');
                $query->where('name', 'like', "%$search%");
            }

            $products = $query->with('category')->paginate(15)->appends(request()->all());

            return view('admin.products.index', compact('products', 'categories', 'countries'));
        }

        // Customer view (default)
        $categories = Category::with('products')->get();
        return view('Customer.index', compact('categories'));
    }
    public function showByCategory($categoryId)
    {
        $category = Category::find($categoryId);
        $products = Product::where('category_id', $categoryId)->get();

        return view('Customer.category_product', compact('category', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword') ?? $request->input('q'); // Hỗ trợ cả 'q' và 'keyword'
        $priceRange = $request->input('price');

        $query = Product::query();

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

        return view('layouts.customer.search', compact('products', 'keyword'));
    }
}
