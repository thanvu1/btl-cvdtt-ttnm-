<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Patterns\Commands\UpdateOrderStatusCommand;
use App\Helpers\OrderHelper;
use Illuminate\Http\Request;

// Giả sử bạn có model Order

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

        $command = new UpdateOrderStatusCommand($order, $request->status);
        $command->execute();

        // Không cần set session ở đây, Observer đã làm rồi
        return back();
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
    }


}



