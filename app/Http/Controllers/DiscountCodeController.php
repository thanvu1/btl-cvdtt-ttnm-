<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiscountCode;
use App\Patterns\Strategies\DiscountCode\DiscountCodeContext;
use App\Patterns\Strategies\DiscountCode\CreateDiscountCodeStrategy;
use App\Patterns\Strategies\DiscountCode\EditDiscountCodeStrategy;
use App\Patterns\Strategies\DiscountCode\SearchDiscountCodeStrategy;
use App\Patterns\Strategies\DiscountCode\FilterDiscountCodeStrategy;
use App\Patterns\TemplateMethod\DiscountCode\DiscountTemplateFactory;
use App\Patterns\TemplateMethod\DiscountCode\FixedDiscount;
use App\Patterns\TemplateMethod\DiscountCode\PercentDiscount;

class DiscountCodeController extends Controller
{
    // Danh sách, tìm kiếm, lọc
    public function index(Request $request)
    {
        $context = new DiscountCodeContext();

        // Strategy tìm kiếm
        $context->setStrategy(new SearchDiscountCodeStrategy());
        $query = $context->execute($request);

        // Strategy lọc
        $context->setStrategy(new FilterDiscountCodeStrategy());
        $query = $context->execute($request, $query);

        $list = $query->orderBy('updated_at', 'desc')->paginate(6);

        return view('admin.discount_code.index', compact('list'));
    }

    // Show form thêm mới
    public function create()
    {
        return view('admin.discount_code.create');
    }

    // Lưu thêm mới
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|unique:discount_codes,code',
            'discount_amount' => 'required|numeric',
            'type' => 'required|in:percent,fixed',
            'min_order_value' => 'nullable|integer',
            'state' => 'required|in:active,inactive,expired',
            'started_at' => 'required|date',
            'expires_at' => 'nullable|date|after_or_equal:started_at',
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

        $context = new DiscountCodeContext();
        $context->setStrategy(new CreateDiscountCodeStrategy());
        $context->execute($request);

        return redirect()
            ->route('admin.discount-codes.index')
            ->with('success', 'Đã thêm mã giảm giá mới!');
    }

    // Show form sửa
    public function edit($id)
    {
        $discountCode = DiscountCode::findOrFail($id);
        return view('admin.discount_code.edit', compact('discountCode'));
    }

    // Lưu cập nhật
    public function update(Request $request, $id)
    {
        $discountCode = DiscountCode::findOrFail($id);

        $request->validate([
            'code' => 'required|string|unique:discount_codes,code,' . $id,
            'discount_amount' => 'required|numeric',
            'type' => 'required|in:percent,fixed',
            'min_order_value' => 'nullable|integer',
            'state' => 'required|in:active,inactive,expired',
            'started_at' => 'required|date',
            'expires_at' => 'nullable|date|after_or_equal:started_at',
        ]);

        $context = new DiscountCodeContext();
        $context->setStrategy(new EditDiscountCodeStrategy());
        $context->execute($request, $discountCode);

        return redirect()
            ->route('admin.discount-codes.index')
            ->with('success', 'Cập nhật mã giảm giá thành công!');
    }

    public function checkout(Request $request)
    {
        // Lấy cart từ session
        $cart = session()->get('cart', []);
        $cartItems = $cart;

        // Tính tổng tiền
        $orderTotal = collect($cartItems)->sum(function($item) {
            return $item['price'] * $item['qty'];
        });

        // Lấy voucher khách chọn (nếu có)
        $voucherId = $request->input('voucher_id');
        $discountAmount = 0;
        $selectedVoucher = null;

        if ($voucherId) {
            $selectedVoucher = DiscountCode::find($voucherId);
            if ($selectedVoucher) {
                // Factory tạo đúng strategy
                $strategy = DiscountTemplateFactory::make($selectedVoucher);
                // Tính số tiền giảm giá
                $discountAmount = $strategy->apply($orderTotal, $selectedVoucher, $cartItems);
            }
        }

        // Tổng tiền sau khi giảm
        $totalAfterDiscount = max(0, $orderTotal - $discountAmount);

        // Lấy danh sách voucher còn hiệu lực để show cho khách chọn (nếu muốn)
        $vouchers = DiscountCode::where('state', 'active')
            ->whereDate('started_at', '<=', now())
            ->where(function ($query) {
                $query->whereNull('expires_at')->orWhereDate('expires_at', '>=', now());
            })
            ->get();

        return view('Customer.checkout', [
            'cart' => $cartItems,
            'total' => $orderTotal,
            'discountAmount' => $discountAmount,
            'totalAfterDiscount' => $totalAfterDiscount,
            'selectedVoucher' => $selectedVoucher,
            'vouchers' => $vouchers,
        ]);
    }

    public function calculateDiscount(Request $request)
    {
        $cart = session()->get('cart', []);
        $orderTotal = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

        $voucherId = $request->input('voucher_id');
        $discountAmount = 0;
        $totalAfterDiscount = $orderTotal;
        $discountAmountText = '0đ';
        $totalAfterDiscountText = number_format($orderTotal, 0, ',', '.') . 'đ';

        if ($voucherId) {
            $selectedVoucher = DiscountCode::find($voucherId);
            if (!$selectedVoucher) {
                return response()->json([
                    'error' => 'Mã giảm giá không tồn tại.',
                    'discountAmount' => 0,
                    'discountAmountText' => $discountAmountText,
                    'totalAfterDiscount' => $orderTotal,
                    'totalAfterDiscountText' => $totalAfterDiscountText,
                ]);
            }
            $strategy = DiscountTemplateFactory::make($selectedVoucher);
            $discountAmount = $strategy->apply($orderTotal, $selectedVoucher, $cart);
            // Nếu không đủ điều kiện sử dụng mã
            if ($discountAmount <= 0) {
                return response()->json([
                    'error' => 'Mã giảm giá không hợp lệ hoặc không đủ điều kiện sử dụng.',
                    'discountAmount' => 0,
                    'discountAmountText' => $discountAmountText,
                    'totalAfterDiscount' => $orderTotal,
                    'totalAfterDiscountText' => $totalAfterDiscountText,
                ]);
            }
            $totalAfterDiscount = max(0, $orderTotal - $discountAmount);
            $discountAmountText = number_format($discountAmount, 0, ',', '.') . 'đ';
            $totalAfterDiscountText = number_format($totalAfterDiscount, 0, ',', '.') . 'đ';
        }

        return response()->json([
            'discountAmount' => $discountAmount,
            'discountAmountText' => $discountAmountText,
            'totalAfterDiscount' => $totalAfterDiscount,
            'totalAfterDiscountText' => $totalAfterDiscountText,
        ]);
    }
}
