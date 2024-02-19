<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{

    public function index() {
        $cart = Cart::where('user_id', auth()->user()->id)->get();
        // dd($cart[0]->products);
        return view('frontend.cart', [
            'cart' => $cart
        ]);
    }

    public function store(Request $request)
    {
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_quantity');

        // return dd($product_qty);
        if (Auth::check()) {
            $product_check = Product::where('id', $product_id)->first();

            if ($product_check) {
                if (Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                    return response()->json(['status' => $product_check->name . ", Already added to cart!", 'type' => 'warning']);
                } else {
                    $cartItem = new Cart();
                    $cartItem->product_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->quantity = $product_qty;
                    $cartItem->save();

                    return response()->json(['status' => $product_check->name . "Added to cart!", 'type' => 'success']);
                }
            }
        } else {
            return response()->json(['status' => "Login to continue"]);
        }
    }

    public function updateCart(Request $request) {
        $product_id = $request->input('product_id');
        $product_quantity = $request->input('quantity');

        if(Auth::check()) {
            if (Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                $cart = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $cart->quantity = $product_quantity;
                $cart->update();

                return response()->json(['status' => "Quantity cart updated!", 'type' => 'success']);
            }
        }
    }

    public function destroyProduct(Request $request) {
        $product_id = $request->input('product_id');
        if (Auth::check()) {
            if (Cart::where('product_id', $product_id)->where('user_id', Auth::id())->exists()) {
                $cartItem = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();

                return response()->json(['status' => "Product deleted from cart!", 'type' => 'success']);
            }

            
        } else {
            return response()->json(['status' => "Login to continue"]);
        }
    }
}
