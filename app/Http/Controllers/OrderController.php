<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Giả sử bạn có model Order

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng
    public function index()
    {
        $orders = Order::paginate(10); // Lấy tất cả đơn hàng từ DB
        return view('orders.index', compact('orders'));
    }

    // Nếu sau này muốn hiển thị chi tiết đơn hàng:
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status' => 'required|string',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('orders.edit', $order->id)->with('success', 'Cập nhật trạng thái thành công!');
    }

    public function confirmDelete($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.destroy', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status !== 'GIAO THÀNH CÔNG') {
            return redirect()->route('orders.index')->with('error', 'Chỉ được xóa đơn hàng đã giao thành công!');
        }

        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Đã xóa đơn hàng thành công!');
    }
}



