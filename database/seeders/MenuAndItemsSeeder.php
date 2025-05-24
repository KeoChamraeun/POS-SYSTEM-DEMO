<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuAndItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create menu
        $menu = Menu::create(['name' => 'Lunch Set', 'price' => 250]);

        // Create menu items
        $item1 = MenuItem::create(['name' => 'Chicken Curry', 'price' => 100]);
        $item2 = MenuItem::create(['name' => 'Rice', 'price' => 50]);
        $item3 = MenuItem::create(['name' => 'Salad', 'price' => 40]);

        // Attach items to menu
        $menu->items()->attach([$item1->id, $item2->id, $item3->id]);
    }
}
