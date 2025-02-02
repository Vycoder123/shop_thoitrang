<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Các thuộc tính có thể gán (mass assignable)
    protected $fillable = ['name'];

    // Quan hệ với model Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
