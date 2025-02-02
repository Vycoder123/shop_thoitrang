<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Lấy tất cả sản phẩm
        return view('user.home', compact('products'));
    }

    public function home()
    {
        return view('user.home');
    }
}
