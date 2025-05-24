<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];

    public function items() {
        return $this->belongsToMany(MenuItem::class, 'menu_menu_item');
    }
}
