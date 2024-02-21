<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $orders = Order::when($request->date != NULL, function ($q) use ($request) {
            $q->whereDate('created_at', $request->date);
        }, function ($q) use ($todayDate) {
            $q->whereDate('created_at', $todayDate);
        })
            ->when($request->status != NULL, function ($q) use ($request) {
                $q->where('status_message', $request->status);
            })

            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        if ($order) {
            return view('admin.orders.view', compact('order'));
        } else {
            return redirect('/admin/orders')->with('message', "Order not found");
        }
    }

    public function updateOrderStatus(Request $request, $id)
    {
        // dd($request->all());
        $order = Order::findOrFail($id);

        if ($order) {
            $order->update([
                'status_message' => $request->status_message
            ]);
            return redirect('/admin/orders/' . $id)->with('status', "Order status updated");
        } else {
            return redirect('/admin/orders/' . $id)->with('status', "Order not found");
        }
    }

    public function viewInvoice($id) {
        $order = Order::findOrFail($id);

        return view('admin.invoice.view', compact('order'));
    }

    public function generateInvoice($id) {
        $order = Order::findOrFail($id);
        $data = ['order' => $order];
        $todayDate = Carbon::now()->format('d-m-Y');

        $pdf = Pdf::loadView('admin.invoice.view', $data);
        return $pdf->download('invoice-' . $order->id . '-' . $todayDate . '.pdf');
    }
}
