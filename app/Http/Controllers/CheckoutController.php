<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $totalAmount = 0;
        // dd($cartItems[1]->products->price * $cartItems[1]->quantity);
        foreach ($cartItems as $cart) {
            $totalAmount += $cart->products->price * $cart->quantity;
        }

        // dd($totalAmount);
        return view('frontend.checkout', compact('totalAmount'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "fullname" => "required|string|max:121",
            "email" => "required|email|max:121",
            "phone" => "required|string|max:11|min:10",
            "pincode" => "required|string|max:6|min:6",
            "address" => "required|string|max:500",
        ]);

        try {
            
        $order = Order::create([
            'user_id' => Auth::id(),
            'tracking_no' => 'SHP-' . Str::random(10),
            "fullname" => $validatedData['fullname'],
            "email" => $validatedData['email'],
            "phone" => $validatedData['phone'],
            "pincode" => $validatedData['pincode'],
            "address" => $validatedData['address'],
            'status_message' => 'in progress'
        ]);

        $carts = Cart::where('user_id', Auth::id())->get();

        foreach ($carts as $cart) {
            OrderItem::create([
                'user_id' => Auth::id(),
                'product_id' => $cart->products->id,
                'price' => $cart->products->price,
                'quantity' => $cart->quantity,
            ]);

            $product = Product::findOrFail($cart->product_id);
            $product->quantity -= $cart->quantity;
            $product->save();
        }


        if ($order) {
            Cart::where('user_id', Auth::id())->delete();
        }

        return redirect('/');
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Failed to place order. Please try again.'], 500);
        }

    }
}
