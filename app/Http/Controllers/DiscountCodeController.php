<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiscountCode;


class DiscountCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DiscountCode::query();

        // Tìm kiếm tên
        if ($request->filled('search')) {
            $query->where('code', 'LIKE', '%' . $request->search . '%');
        }
        // Lọc trạng thái
        if ($request->has('state')) {
            $query->whereIn('state', $request->state); // state là mảng ['active', ...]
        }
        // Lọc ngày bắt đầu
        if ($request->filled('start_date')) {
            $query->whereDate('started_at', '>=', $request->start_date);
        }
        // Lọc ngày kết thúc
        if ($request->filled('end_date')) {
            $query->whereDate('expires_at', '<=', $request->end_date);
        }

        $list = $query->orderBy('updated_at', 'desc')->paginate(8);

        return view('Admin.discount_code.index', [
            'list' => $list,
            'request' => $request,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Admin.discount_code.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'code' => 'required|unique:discount_codes,code',
            'discount_amount' => 'required|numeric|min:0',
            'type' => 'required|in:percent,fixed',
            'min_order_value' => 'nullable|integer|min:0',
            'state' => 'required|in:active,inactive,expired',
            'started_at' => 'required|date',
            'expires_at' => 'nullable|date|after_or_equal:started_at',
            'description' => 'nullable|string',
        ], [
            'code.required' => 'Mã giảm giá là bắt buộc.',
            'code.unique' => 'Mã giảm giá đã tồn tại.',
            'discount_amount.required' => 'Số tiền giảm giá là bắt buộc.',
            'discount_amount.numeric' => 'Số tiền giảm giá phải là số.',
            'discount_amount.min' => 'Số tiền giảm giá phải lớn hơn hoặc bằng 0.',
            'type.required' => 'Loại giảm giá là bắt buộc.',
            'type.in' => 'Loại giảm giá không hợp lệ.',
            'min_order_value.integer' => 'Giá trị đơn hàng tối thiểu phải là số nguyên.',
            'min_order_value.min' => 'Giá trị đơn hàng tối thiểu phải lớn hơn hoặc bằng 0.',
            'state.required' => 'Trạng thái là bắt buộc.',
            'state.in' => 'Trạng thái không hợp lệ.',
            'started_at.required' => 'Ngày bắt đầu là bắt buộc.',
            'started_at.date' => 'Ngày bắt đầu không hợp lệ.',
            'expires_at.date' => 'Ngày hết hạn không hợp lệ.',
            'expires_at.after_or_equal' => 'Ngày hết hạn phải sau hoặc bằng ngày bắt đầu.',
            'description.string' => 'Mô tả phải là chuỗi ký tự.',
        ]);

        DiscountCode::create($request->all());
        return redirect()->route('admin.discount-codes.index')->with('success', 'Tạo một mã giảm giá mới thành công!');
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
        $discountCode = DiscountCode::findOrFail($id);
        return view('Admin.discount_code.edit', compact('discountCode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $discountCode = DiscountCode::findOrFail($id);

        $request->validate([
            'discount_amount' => 'required|numeric|min:0',
            'type' => 'required|in:percent,fixed',
            'min_order_value' => 'nullable|integer|min:0',
            'state' => 'required|in:active,inactive,expired',
            'started_at' => 'required|date',
            'expires_at' => 'nullable|date|after_or_equal:started_at',
            'description' => 'nullable|string',
        ], [
            'min_order_value.integer' => 'Giá trị đơn hàng tối thiểu phải là số nguyên.',
            'min_order_value.min' => 'Giá trị đơn hàng tối thiểu phải lớn hơn hoặc bằng 0.',
        ]);

        $discountCode->update($request->all());
        return redirect()->route('admin.discount-codes.index')->with('success', 'Cập nhật mã giảm giá thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
