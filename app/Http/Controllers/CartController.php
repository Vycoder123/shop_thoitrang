<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        $cartItems = \App\Models\Cart::where('user_id', Auth::user()->id)
            ->with('product')
            ->get();

        return view('cart.index', compact('cartItems'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = \App\Models\Product::find($request->product_id);

        // Kiểm tra nếu sản phẩm đã hết hàng
        if ($product->stock == 0) {
            return redirect()->back()->with('error', 'Sản phẩm đã hết hàng!');
        }

        $cart = \App\Models\Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cart) {
            // Kiểm tra nếu tổng số lượng vượt quá stock
            if ($cart->quantity + $request->quantity > $product->stock) {
                return redirect()->back()->with('error', 'Không đủ hàng trong kho!');
            }

            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            \App\Models\Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }





    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = \App\Models\Cart::where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->firstOrFail();
        $product = $cart->product;

        // Kiểm tra nếu số lượng vượt quá kho
        if ($request->quantity > $product->stock + $cart->quantity) {
            return redirect()->route('cart.index')->with('error', 'Không đủ hàng trong kho!');
        }

        // Cập nhật số lượng tồn kho
        $product->increment('stock', $cart->quantity - $request->quantity);

        $cart->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')->with('success', 'Đã cập nhật giỏ hàng!');
    }






    public function destroy($id)
    {
        $cart = \App\Models\Cart::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        $product = $cart->product;

        // Tăng lại số lượng sản phẩm về kho
        $product->increment('stock', $cart->quantity);

        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }
}
