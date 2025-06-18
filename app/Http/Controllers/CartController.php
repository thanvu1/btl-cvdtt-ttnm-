<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function update(Request $request)
    {
        $id = $request->json('id') ?? $request->input('id');
        $action = $request->json('action') ?? $request->input('action');
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($action === 'increase') {
                $cart[$id]['qty'] += 1;
            } elseif ($action === 'decrease') {
                $cart[$id]['qty'] = max(1, $cart[$id]['qty'] - 1);
            }
        }

        session()->put('cart', $cart);

        $html = view('layouts.customer.cart_item', ['cart' => $cart])->render();
        $totalQty = array_sum(array_column($cart, 'qty'));

        return response()->json([
            'html' => $html,
            'totalQty' => $totalQty,
            'cart' => $cart
        ]);
    }


    public function remove(Request $request)
    {
        $id = $request->json('id') ?? $request->input('id');
        $cart = session()->get('cart', []);

        unset($cart[$id]);
        session()->put('cart', $cart);

        $html = view('layouts.customer.cart_item', ['cart' => $cart])->render();

        return response()->json([
            'html' => $html,
            'totalQty' => array_sum(array_column($cart, 'qty')),
            'cart' => $cart
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function add(Request $request)
    {
        // Nhận product_id từ JSON hoặc form-data
        $product_id = $request->json('product_id') ?? $request->input('product_id');
        if (!$product_id) {
            return response()->json(['success' => false, 'message' => 'Thiếu product_id!'], 400);
        }

        $product = Product::findOrFail($product_id);

        $cart = session()->get('cart', []);
        if(isset($cart[$product->id])) {
            $cart[$product->id]['qty']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image ?? '',
                "qty" => 1
            ];
        }
        session(['cart' => $cart]);
        $html = view('layouts.customer.cart_item', ['cart' => $cart])->render();
        return response()->json([
            'success' => true,
            'totalQty' => array_sum(array_column($cart, 'qty')),
            'html' => $html,
            'cart' => $cart
        ]);
    }

}
