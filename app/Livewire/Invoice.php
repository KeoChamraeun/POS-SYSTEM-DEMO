<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class InvoiceList extends Component
{
    public $invoiceList;

    public function mount()
    {
        $userId = auth()->id();

        // Load orders for the logged-in user only
        $this->invoiceList = Order::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.invoice-list', [
            'invoiceList' => $this->invoiceList,
        ]);
    }
}
