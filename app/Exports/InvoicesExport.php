<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class InvoicesExport implements FromView
{
    protected $userId;
    protected $startDate;
    protected $endDate;

    public function __construct($userId, $startDate = null, $endDate = null)
    {
        $this->userId = $userId;
        // $this->startDate = $startDate;
        // $this->endDate = $endDate;
    }

    public function view(): View
    {
        $query = Order::with('orderItems')
            ->where('user_id', $this->userId)
            ->orderBy('created_at', 'desc');

        // if ($this->startDate) {
        //     $query->whereDate('created_at', '>=', $this->startDate);
        // }

        // if ($this->endDate) {
        //     $query->whereDate('created_at', '<=', $this->endDate);
        // }

        $invoiceList = $query->get();

        return view('admin.pos.exports.invoice-list', [
            'invoiceList' => $invoiceList,
            // 'startDate' => $this->startDate,
            // 'endDate' => $this->endDate,
        ]);
    }
}
