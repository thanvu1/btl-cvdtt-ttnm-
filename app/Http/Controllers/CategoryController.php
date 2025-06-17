<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);

        $products = Product::where('category_id', $id);

        // Lọc theo giá nếu có
        if ($price = request()->price) {
            [$min, $max] = explode('-', $price);
            $products->whereBetween('price', [(int)$min, (int)$max]);
        }

        $products = $products->get();

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
}
