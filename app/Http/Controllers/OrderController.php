<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
use Illuminate\Http\Request;
use App\Models\Order; // Giả sử bạn có model Order

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng

    public function index(Request $request)
    {
        $query = Order::query();

        // Tìm kiếm theo mã đơn hàng
        if ($request->filled('search')) {
            $query->where('phone', 'LIKE', '%' . $request->search . '%');
        }

        $orders = $query->paginate(7);

        return view('Admin.orders.index', compact('orders'));
    }

    // Nếu sau này muốn hiển thị chi tiết đơn hàng:
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('Admin.orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('Admin.orders.edit', compact('order'));
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
        'status' => 'required'
    ]);
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Cập nhật trạng thái thành công!');
    }

    public function confirmDelete($id)
    {
        $order = Order::findOrFail($id);
        return view('Admin.orders.destroy', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'GIAO THÀNH CÔNG') {
            return redirect()->route('orders.index')->with('error', 'Không thể xóa đơn hàng!');
        }

        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Xóa đơn hàng thành công!');
        // Xóa đơn hàng
    }

    /**
     * Trang checkout - hiển thị thông tin giỏ hàng và form đặt hàng
     */
    public function checkout(Request $request)
    {

        $selectedIds = $request->input('selected', []); // ID sản phẩm được chọn (nếu có)
        $cart = session()->get('cart', []);

        // Nếu người dùng chọn sản phẩm cụ thể -> lọc ra, ngược lại dùng toàn bộ giỏ hàng
        $selectedItems = $selectedIds ? collect($cart)->only($selectedIds)->toArray() : $cart;

        // Tính tổng tiền
        $total = collect($selectedItems)->sum(fn($item) => $item['price'] * $item['qty']);

        // Giả lập danh sách voucher
        $vouchers = DiscountCode::where('state', 'active')
            ->whereDate('started_at', '<=', now())
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhereDate('expires_at', '>=', now());
            })
            ->get();

        return view('Customer.checkout', [
            'cart' => $selectedItems,
            'total' => $total,
            'vouchers' => $vouchers,
        ]);
    }
}
