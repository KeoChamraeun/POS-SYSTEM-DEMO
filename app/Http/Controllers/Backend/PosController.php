<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PosController extends Controller
{
    // Show POS page
    public function POS()
    {
        return view('admin.pos.pos_page');
    }

    // Show order confirmation for logged-in user's order
    public function OrderConfirmed($orderId)
    {
        $userId = auth()->id();

        $order = Order::with('orderItems')
            ->where('id', $orderId)
            ->where('user_id', $userId)
            ->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found or you do not have permission to view it.');
        }

        return view('admin.pos.order-confirmation', compact('order'));
    }

    // Show invoice list for logged-in user only
    public function InvoiceList()
    {
        $userId = auth()->id();

        $invoiceList = Order::with('orderItems')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pos.invoice-list', compact('invoiceList'));
    }

    // Delete order if it belongs to logged-in user
    public function OrderDelete($id)
    {
        $userId = auth()->id();

        $order = Order::where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if ($order) {
            $order->delete();
            return redirect()->back()->with('success', 'Invoice deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Invoice not found or you do not have permission to delete it.');
        }
    }
}
