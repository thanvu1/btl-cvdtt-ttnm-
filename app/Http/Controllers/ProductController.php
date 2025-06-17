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
        // $categories = Category::with('products')->get();
        // // $products = Product::where('category_id', $categoryId)->get();

        // return view('Customer.index', compact('categories'));
    }

    public function showByCategory($categoryId)
    {
    //     $category = Category::find($categoryId);
    //     $products = Product::where('category_id', $categoryId)->get();

    //     return view('Customer.category_product', compact('category', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('Admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->route('admin.products.create')->with('success', 'Thêm sản phẩm thành công!');
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
        return view('Admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

    $request->validate([
        // Không cần validate code nữa
        'name'        => 'required|string|max:255',
        'price'       => 'required|numeric|min:0',
        'stock'       => 'required|integer|min:0',
        'expiry_date' => 'nullable|date',
        'category_id' => 'required|exists:categories,id',
        'country'     => 'nullable|string|max:255',
    ]);

    $product->update($request->except('code'));
    return redirect()->route('admin.products.edit', $product->id)->with('success', 'Cập nhật sản phẩm thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
