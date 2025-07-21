<?php

namespace App\Http\Controllers\Backend;

use App\Exports\InvoicesExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
    public function InvoiceList(Request $request)
    {
        $userId = auth()->id();

        $query = Order::with('orderItems')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc');

        // Apply date filters
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        $invoiceList = $query->get();

        return view('admin.pos.invoice-list', compact('invoiceList', 'startDate', 'endDate'));
    }

    // Delete order if belongs to logged-in user
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

    // Export invoices filtered by date range or default to today
    public function exportInvoices()
    {
        $userId = auth()->id();


        return Excel::download(
            new InvoicesExport($userId),
            'invoices_' . date('Ymd_His') . '.xlsx'
        );
    }
}
