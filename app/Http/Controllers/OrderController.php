<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::all();
        return view('frontend.orders', compact('orders'));
    }

    public function show($id) {
        $order = Order::findOrFail($id);

        return view('frontend.order', compact('order'));
    }
}
