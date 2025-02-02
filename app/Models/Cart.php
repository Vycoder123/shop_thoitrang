<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * Các cột có thể gán giá trị hàng loạt
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    /**
     * Quan hệ với User
     * Mỗi giỏ hàng thuộc về một người dùng
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Quan hệ với Product
     * Mỗi giỏ hàng liên kết với một sản phẩm
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
