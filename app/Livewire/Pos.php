<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Vat;
use Livewire\Component;

class Pos extends Component
{
    public $cart = [];
    public $selectedCategory = null;
    public $searchTerm = '';
    public $table = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    public $tableNo;
    public $orderNumber;
    public $customerName = '';
    public $customers;
    public $status = 'pending';
    public $paymentMethod = 'cash';
    public $subTotal = 0;
    public $discount = 0;
    public $discountType = '';
    public $discountValue = 0;
    public $vat = 0;

    public function mount()
    {
        $userId = auth()->id();

        $this->tableNo = rand($this->table[0], $this->table[count($this->table) - 1]);
        $this->orderNumber = 'ORDER-' . date('Ymd') . '-' . rand(1, 1000);
        $this->paymentMethod = 'cash';

        // Load customers filtered by user_id
        $this->customers = Customer::where('status', 'active')
            ->where('user_id', $userId)
            ->get(['id', 'name']);

        if ($this->customers->isNotEmpty() && empty($this->customerName)) {
            $this->customerName = $this->customers->first()->name;
        }
    }

    public function addMenu($menuId)
    {
        foreach ($this->cart as $index => $cartItem) {
            if ($cartItem['id'] === $menuId && $cartItem['type'] === 'menu') {
                $this->cart[$index]['quantity']++;
                return;
            }
        }

        $menu = Menu::where('user_id', auth()->id())->findOrFail($menuId);

        $this->cart[] = [
            'type' => 'menu',
            'id' => $menu->id,
            'name' => $menu->name,
            'price' => $menu->price,
            'image' => $menu->image,
            'quantity' => 1,
        ];

        session()->flash('success', 'Menu added successfully!');
    }

    public function addItem($itemId)
    {
        foreach ($this->cart as $index => $cartItem) {
            if ($cartItem['id'] === $itemId && $cartItem['type'] === 'item') {
                $this->cart[$index]['quantity']++;
                return;
            }
        }

        $item = MenuItem::where('user_id', auth()->id())->findOrFail($itemId);

        $this->cart[] = [
            'type' => 'item',
            'id' => $item->id,
            'name' => $item->name,
            'price' => $item->price,
            'image' => $item->image,
            'quantity' => 1,
        ];

        session()->flash('success', 'Item added successfully!');
    }

    public function increaseQty($index)
    {
        if (isset($this->cart[$index])) {
            $this->cart[$index]['quantity']++;
        }
    }

    public function decreaseQty($index)
    {
        if (isset($this->cart[$index])) {
            if ($this->cart[$index]['quantity'] > 1) {
                $this->cart[$index]['quantity']--;
            } else {
                unset($this->cart[$index]);
                $this->cart = array_values($this->cart);
            }
        }
    }

    public function getSubTotal()
    {
        return collect($this->cart)->sum(fn($i) => $i['price'] * $i['quantity']);
    }

    public function getTotal()
    {
        return $this->getSubTotal();
    }

    public function getDiscount()
    {
        if ($this->discountValue < 0) {
            session()->flash('error', 'Discount cannot be negative.');
            return 0;
        }

        $this->subTotal = $this->getSubTotal();
        if ($this->discountType === 'percentage') {
            $this->discount = ($this->subTotal * $this->discountValue) / 100;
        } elseif ($this->discountType === 'flat') {
            $this->discount = $this->discountValue;
        } else {
            $this->discount = 0;
        }

        $this->dispatch('closeDiscountModal');
        return $this->discount;
    }

    public function submitOrder()
    {
        if (empty($this->cart)) {
            session()->flash('error', 'Cart is empty. Please add items before submitting an order.');
            return;
        }
        if (empty($this->customerName)) {
            session()->flash('error', 'Please select a customer.');
            return;
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'table_no' => $this->tableNo,
            'order_number' => $this->orderNumber,
            'customer_name' => $this->customerName,
            'status' => $this->status,
            'payment_method' => $this->paymentMethod,
            'discount' => $this->getDiscount(),
            'vat' => ($this->getTotal() * ($this->vat / 100)),
            'sub_total' => $this->getTotal(),
            'adjustment' => 0,
            'total' => $this->getTotal() - $this->getDiscount() + ($this->getTotal() * ($this->vat / 100)),
        ]);

        foreach ($this->cart as $entry) {
            OrderItem::create([
                'order_id' => $order->id,
                'item_type' => $entry['type'],
                'item_id' => $entry['id'],
                'quantity' => $entry['quantity'],
                'price' => $entry['price'],
            ]);
        }

        $this->cart = [];

        session()->flash('success', 'Order submitted successfully!');

        return redirect()->route('order.confirmation', $order->id);
    }

    public function clearCart()
    {
        $this->cart = [];
        session()->flash('success', 'Cart cleared successfully!');
    }

    public function render()
    {
        $userId = auth()->id();

        $items = $this->selectedCategory
            ? MenuItem::where('category', $this->selectedCategory)
            ->where('user_id', $userId)
            ->get()
            : MenuItem::where('name', 'like', '%' . $this->searchTerm . '%')
            ->where('user_id', $userId)
            ->get();

        $numberOfItems = MenuItem::where('user_id', $userId)->count();

        return view('livewire.pos', [
            'menus' => Menu::where('user_id', $userId)->get(),
            'items' => $items,
            'categories' => Category::where('status', 'active')
                ->whereHas('menuItems', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                })
                ->get(),
            'vats' => Vat::where('status', 'active')->get(),
            'numberOfItems' => $numberOfItems,
        ]);
    }
}
