<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        // Kiểm tra vai trò là admin
        if (Auth::check() && Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }
    }

    public function index()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalRevenue = Order::sum('total'); 
        $totalUsers = User::count();

        return view('admin.dashboard', compact('totalOrders', 'totalProducts', 'totalRevenue', 'totalUsers'));
    }
}
