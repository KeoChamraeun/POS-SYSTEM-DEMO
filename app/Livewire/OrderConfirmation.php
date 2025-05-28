<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class OrderConfirmation extends Component
{
    public $order;

    public function mount($orderId)
    {
        $this->order = Order::with('orderItems')->findOrFail($orderId);
    }

    public function render()
    {
        return view('livewire.order-confirmation', [
            'order' => $this->order
        ]);
    }
}
