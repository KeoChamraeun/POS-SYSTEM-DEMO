<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PosController extends Controller
{

     public function POS(){
        return view('admin.pos.pos_page');
    }
    public function OrderConfirmed($orderId)
    {
        $order = Order::findOrFail($orderId)->with('orderItems')->first();
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Check if the order is already confirmed
        return view('admin.pos.order-confirmation', compact('order'));
    }
}
