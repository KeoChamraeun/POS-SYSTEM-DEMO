<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'item_id', 'id');
    }
    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, 'item_id', 'id');
    }
}
