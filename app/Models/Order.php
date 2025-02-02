<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'status',
    ];

    // Quan hệ với người dùng (User)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với order_items (chi tiết đơn hàng)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Quan hệ với sản phẩm qua order_items
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
