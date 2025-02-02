<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Các cột có thể được gán giá trị hàng loạt
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
    ];

    /**
     * Mối quan hệ với model Category (Danh mục)
     * Một sản phẩm thuộc về một danh mục
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Mối quan hệ với model Cart
     * Một sản phẩm có thể nằm trong nhiều giỏ hàng
     */
    // public function carts()
    // {
    //     return $this->hasMany(Cart::class);
    // }

    /**
     * Mối quan hệ với model OrderItem
     * Một sản phẩm có thể xuất hiện trong nhiều đơn hàng
     */
    // public function orderItems()
    // {
    //     return $this->hasMany(OrderItem::class);
    // }
}
