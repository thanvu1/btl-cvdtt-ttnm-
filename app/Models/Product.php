<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Thiếu: Quan hệ với OrderItem (sản phẩm có thể thuộc nhiều đơn hàng)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
