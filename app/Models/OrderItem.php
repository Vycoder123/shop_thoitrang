<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    // Quan hệ với đơn hàng (Order)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Quan hệ với sản phẩm (Product)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
