<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
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

}
