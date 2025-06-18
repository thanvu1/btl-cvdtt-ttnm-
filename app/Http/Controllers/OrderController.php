<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders (for admin or user history).
     */
    public function index()
    {
        // Hiển thị danh sách đơn hàng (nếu có)
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        // Form tạo đơn hàng thủ công (nếu cần)
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        // Xử lý lưu đơn hàng khi người dùng bấm "Đặt hàng"
        // Gồm thông tin người nhận + giỏ hàng + voucher (nếu có)
    }

    /**
     * Display the specified order.
     */
    public function show(string $id)
    {
        // Hiển thị chi tiết một đơn hàng cụ thể
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(string $id)
    {
        // Form cập nhật đơn hàng (cho admin)
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, string $id)
    {
        // Lưu thay đổi đơn hàng
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(string $id)
    {
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
        $vouchers = [
            (object)[ 'id' => 'KM0001', 'discount' => 10000, 'min_order' => 50000, 'expired_at' => '2025-06-30' ],
            (object)[ 'id' => 'KM0002', 'discount' => 15000, 'min_order' => 100000, 'expired_at' => '2025-06-30' ],
            (object)[ 'id' => 'KM0003', 'discount' => 20000, 'min_order' => 150000, 'expired_at' => '2025-06-30' ],
            (object)[ 'id' => 'KM0004', 'discount' => 25000, 'min_order' => 200000, 'expired_at' => '2025-06-30' ],
        ];

        return view('Customer.checkout', [
            'cart' => $selectedItems,
            'total' => $total,
            'vouchers' => $vouchers,
        ]);
    }
}
