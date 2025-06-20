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

    public function show($id, Request $request)
    {
        $category = Category::findOrFail($id);
        $query = Product::where('category_id', $id);

        // Lọc theo nhiều mức giá
        if ($request->filled('price')) {
            $range = $request->input('price');
            if (is_array($range)) {
                $range = $range[0]; // lấy phần tử đầu nếu form vẫn gửi mảng
            }

            if ($range !== '0-0') { // bỏ qua "Tất cả"
                [$min, $max] = explode('-', $range . '-');
                $min = (int) $min;
                $max = $max !== '' ? (int) $max : null;

                if ($max !== null) {
                    $query->whereBetween('price', [$min, $max]);
                } else {
                    $query->where('price', '>=', $min);
                }
            }
        }

        // Tình trạng hàng
        if ($request->filled('stock_status') && $request->input('stock_status') !== 'all') {
            $status = $request->input('stock_status');
            if ($status === 'in_stock') {
                $query->where('stock', '>', 0);
            } elseif ($status === 'out_of_stock') {
                $query->where('stock', '<=', 0);
            }
        }

        // Xuất xứ
        if ($request->filled('country')) {
            $countries = (array) $request->input('country');
            $query->whereIn('country', $countries);
        }

        $products = $query->paginate(12)->appends($request->all());

        $stockOptions = [
            'in_stock' => 'Còn hàng',
            'out_of_stock' => 'Hết hàng',
        ];

        return view('Customer.category_product', compact('category', 'products', 'stockOptions'));
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
