<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Patterns\Singleton\Cart\Cart; // Assuming you have a Cart singleton pattern
use App\Patterns\Memento\CartCaretaker; // Assuming you have a CartCaretaker for Memento pattern
use App\Patterns\Memento\CartMemento; // Assuming you have a CartMemento

class CartController extends Controller
{
    protected function backupCart()
    {
        $cart = Cart::getInstance();
        $currentCart = $cart->all();

        // Nếu cart rỗng thì không cần backup (hoặc tùy bạn muốn vẫn lưu)
        if (empty($currentCart)) {
            return;
        }

        $memento = new CartMemento($currentCart);
        session(['cart_backup' => $memento->getState()]);
    }

    public function undo()
    {
        $cart = Cart::getInstance();

        if (session()->has('cart_backup')) {
            $memento = new CartMemento(session('cart_backup'));
            (new CartCaretaker())->restore($cart, $memento);

            session()->forget('cart_backup'); // clear sau khi dùng
            return redirect()->back()->with('success', 'Đã hoàn tác giỏ hàng.');
        }

        return redirect()->back()->with('error', 'Không có thay đổi nào để hoàn tác.');
    }


    public function add(Request $request)
    {
        $product_id = $request->input('product_id') ?? $request->json('product_id');
        if (!$product_id) {
            return response()->json(['success' => false, 'message' => 'Thiếu product_id!'], 400);
        }

        $product = Product::findOrFail($product_id);
        $cart = Cart::getInstance();
        $this->backupCart();
        $cart->add($product->id, $product->name, $product->price, 1, $product->image);

        return response()->json([
            'success' => true,
            'totalQty' => collect($cart->all())->sum('qty'),
            'html' => view('layouts.customer.cart_item', ['cart' => $cart->all()])->render(),
            'cart' => $cart->all()
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->input('id') ?? $request->json('id');
        $action = $request->input('action') ?? $request->json('action');

        $cart = Cart::getInstance();
        $items = $cart->all();

        if (isset($items[$id])) {
            $this->backupCart(); // Backup before updating
            $currentQty = $items[$id]['qty'];
            $newQty = $action === 'increase' ? $currentQty + 1 : max(1, $currentQty - 1);
            $cart->update($id, $newQty);
        }

        return response()->json([
            'html' => view('layouts.customer.cart_item', ['cart' => $cart->all()])->render(),
            'totalQty' => collect($cart->all())->sum('qty'),
            'cart' => $cart->all()
        ]);
    }

    public function remove(Request $request)
    {
        $id = $request->input('id') ?? $request->json('id');
        $cart = Cart::getInstance();
        if (isset($cart->all()[$id])) {
            $this->backupCart();
        }
        $cart->remove($id);

        return response()->json([
            'html' => view('layouts.customer.cart_item', ['cart' => $cart->all()])->render(),
            'totalQty' => collect($cart->all())->sum('qty'),
            'cart' => $cart->all()
        ]);
    }

    public function clear()
    {
        $cart = Cart::getInstance();
        $cart->clear();

        return response()->json([
            'success' => true,
            'message' => 'Đã xóa toàn bộ giỏ hàng.',
        ]);
    }
}
