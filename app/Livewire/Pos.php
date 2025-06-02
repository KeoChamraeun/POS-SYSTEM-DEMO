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

/**
 * Class Pos
 * @package App\Livewire
 *
 * This class handles the Point of Sale (POS) functionality, including managing the cart,
 * adding items, calculating totals, and submitting orders.
 */

class Pos extends Component
{
    public $cart = [];
    public $selectedCategory = null;
    public $searchTerm = '';
    public $table = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    public $tableNo; // fixed, initialized in mount()
    public $orderNumber; // fixed, initialized in mount()
    public $customerName = '';
    public $customers;
    public $status = 'pending';
    public $paymentMethod = 'cash';
    public $subTotal = 0;
    public $discount = 0;
    public $discountType = 'percentage'; // Default discount type
    public $discountValue = 0; // Default discount value
    public $vat = 0; // Default VAT value


    public function mount()
    {
        $this->tableNo = rand($this->table[0], $this->table[count($this->table) - 1]);
        $this->orderNumber = 'ORDER-' . date('Ymd') . '-' . rand(1, 1000);
        $this->paymentMethod = 'cash'; // Default payment method

        $this->customers = Customer::where('status', 'active')->get(['id', 'name']);
        if ($this->customers->isNotEmpty() && empty($this->customerName)) {
            $this->customerName = $this->customers->first()->name;
        }
    }


    public function addMenu($menuId)
    {

        // Check if menu already in cart (matching both id and type)
        foreach ($this->cart as $index => $cartItem) {
            if ($cartItem['id'] === $menuId && $cartItem['type'] === 'menu') {
                $this->cart[$index]['quantity']++;
                return;
            }
        }

        // If not in cart, add new menu
        $menu = Menu::findOrFail($menuId);
        $this->cart[] = [
            'type' => 'menu',
            'id' => $menu->id,
            'name' => $menu->name,
            'price' => $menu->price,
            'image' => $menu->image,
            'quantity' => 1,
        ];

        $this->dispatch('toast.success', 'Menu Added successfully!');

        session()->flash('success', 'Cart Added successfully!');
    }

    public function addItem($itemId)
    {
        // Check if item already in cart (matching both id and type)
        foreach ($this->cart as $index => $cartItem) {
            if ($cartItem['id'] === $itemId && $cartItem['type'] === 'item') {
                $this->cart[$index]['quantity']++;
                return;
            }
        }

        // If not in cart, add new item
        $item = MenuItem::findOrFail($itemId);
        $this->cart[] = [
            'type' => 'item',
            'id' => $item->id,
            'name' => $item->name,
            'price' => $item->price,
            'image' => $item->image,
            'quantity' => 1,
        ];

        session()->flash('success', 'Cart Added successfully!');
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
                $this->cart = array_values($this->cart); // Reindex array
            }
        }
    }

    public function getSubTotal()
    {
        return collect($this->cart)->sum(fn($i) => $i['price'] * $i['quantity']);
    }

    public function getTotal()
    {
        return collect($this->cart)->sum(fn($i) => $i['price'] * $i['quantity']);
    }

    public function submitOrder()
    {

        if (empty($this->cart)) {
            session()->flash('error', 'Cart is empty. Please add items before submitting an order.');
            return;
        }
        if (empty($this->customerName)) {
            session()->flash('error', 'Please enter a customer name.');
            return;
        }
        $order = Order::create([
            'table_no' => $this->tableNo,
            'order_number' => $this->orderNumber,
            'customer_name' => $this->customerName,
            'status' => $this->status,
            'payment_method' => $this->paymentMethod,
            'discount' => $this->getDiscount(), // Default discount
            'vat' => ($this->getTotal() * ($this->vat / 100)),
            'sub_total' => $this->getTotal(),
            'adjustment' => 0, // Default adjustment
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
        // Clear the cart after submitting the order
        $this->cart = [];

        session()->flash('success', 'Order submitted successfully!');
        // $this->dispatch('printReceiptShow');

        return redirect()->route('order.confirmation', $order->id);
    }


    public function clearCart()
    {
        $this->cart = [];
        session()->flash('success', 'Cart cleared successfully!');
    }


    public function getDiscount()
    {
        if ($this->discountValue < 0) {
            session()->flash('error', 'Discount cannot be negative.');
            return;
        }

        $this->subTotal = $this->getSubTotal();
        if ($this->discountType == 'percentage') {
            $this->discount = $this->subTotal * $this->discountValue / 100;
        } else {
            $this->discount = $this->discountValue;
        }

        $this->dispatch('closeDiscountModal');
        return $this->discount;
    }
    public function render()
    {
        $items = $this->selectedCategory
            ? MenuItem::where('category', $this->selectedCategory)->get()
            : MenuItem::where('name', 'like', '%' . $this->searchTerm . '%')
            ->get();
        $numberOfItems = MenuItem::count();
        return view('livewire.pos', [
            'menus' => Menu::all(),
            'items' => $items,
            'categories' => Category::where('status', 'active')->get(),
            'vats' => Vat::where('status', 'active')->get(),
            'numberOfItems' => $numberOfItems
        ]);
    }
}
