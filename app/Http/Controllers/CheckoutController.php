<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // Get the products in the user's cart
        $cartItems = Cart::where('user_id', Auth::user()->id)
            ->with('product') // Eager load products
            ->get();

        // Calculate the total order price
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('checkout.index', compact('cartItems', 'total'));
    }

    // In CheckoutController
    public function store(Request $request)
    {
        // Get the products in the user's cart
        $cartItems = Cart::where('user_id', Auth::user()->id)
            ->with('product') // Eager load products
            ->get();

        // Calculate the total order price
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Create a new order
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'total' => $total,
            'status' => 'pending',
        ]);

        // Add products to the order_items table
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);

            // Giảm số lượng sản phẩm trong kho sau khi thanh toán
            $item->product->decrement('stock', $item->quantity);
        }

        // Delete items from the user's cart
        $cartItems->each->delete();

        // Redirect to the order show page
        return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
    }
}
