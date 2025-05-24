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

    public function addMenu($menuId) {
        $menu = Menu::with('items')->findOrFail($menuId);
        $existingMenu = collect($this->cart)->firstWhere('id', $menuId);
        if ($existingMenu) {
            $existingMenu['quantity']++;
        } else {
            $this->cart[] = [
                'type' => 'menu',
                'id' => $menu->id,
                'name' => $menu->name,
                'price' => $menu->price,
                'quantity' => 1
            ];
        }
    }

    public function addItem($itemId) {
        $existingItem = collect($this->cart)->firstWhere('id', $itemId);
        if ($existingItem) {
            $existingItem['quantity']++;
        } else {
            $item = MenuItem::findOrFail($itemId);
            $this->cart[] = [
                'type' => 'item',
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => 1
            ];
        }
    }

    public function increaseQty($index) {
        $this->cart[$index]['quantity']++;
    }

    public function decreaseQty($index) {
        if ($this->cart[$index]['quantity'] > 1) {
            $this->cart[$index]['quantity']--;
        } else {
            unset($this->cart[$index]);
            $this->cart = array_values($this->cart);
        }
    }

    public function getTotal() {
        return collect($this->cart)->sum(fn($i) => $i['price'] * $i['quantity']);
    }

    public function submitOrder() {
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
    }


    public function render() {
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
