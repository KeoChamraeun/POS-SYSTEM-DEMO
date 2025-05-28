<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class Invoice extends Component
{
    public $order;

    public function mount($id)
    {
        dd($id);
        $this->order = Order::with('orderItems')->findOrFail($orderId);
    }
    public function render()
    {
        return view('livewire.invoice', [
            'invoice' => $this->order
        ]);
    }
}
