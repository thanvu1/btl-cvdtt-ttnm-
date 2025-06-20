<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    // Chỉ định tên bảng nếu không theo chuẩn Laravel (số nhiều snake_case)
    protected $table = 'discount_codes';

    protected $fillable = [
        'code',
        'discount_amount',
        'type',
        'min_order_value',
        'state',
        'started_at',
        'expires_at',
        'description',
    ];
    protected $casts = [
        'discount_amount' => 'decimal:2',
        'type' => 'string', // Enum: 'percent' or 'fixed'
        'state' => 'string', // Enum: 'active', 'inactive', 'expired'
        'started_at' => 'date',
        'expires_at' => 'date',
    ];



    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
