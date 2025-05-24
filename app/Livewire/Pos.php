<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class Pos extends Component
{
    public $cart = [];
    public $selectedCategory = null;

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
            'quantity' => 1,
        ];
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
            'quantity' => 1,
        ];
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

        $order = Order::create(['total' => $this->getTotal()]);

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
    }

    public function render()
    {
        $items = $this->selectedCategory
            ? MenuItem::where('category', $this->selectedCategory)->get()
            : MenuItem::all();

        return view('livewire.pos', [
            'menus' => Menu::all(),
            'items' => $items,
            'categories' => MenuItem::select('category')->distinct()->pluck('category'),
        ]);
    }
}
