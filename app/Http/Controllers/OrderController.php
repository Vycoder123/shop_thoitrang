<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        // Lấy danh sách đơn hàng
        $orders = Order::all();

        // Trả về view và truyền dữ liệu
        return view('orders.index', compact('orders'));
    }
    public function show(Order $order)
    {
        // Ensure the order has its items and products loaded
        $order->load('orderItems.product');

        // You can check if the logged-in user owns the order, if needed
        if ($order->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'Unauthorized access to this order.');
        }

        return view('orders.show', compact('order'));
    }
}
