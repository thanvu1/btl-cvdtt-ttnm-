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
