<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $guarded = [];
    public function menus() {
        return $this->belongsToMany(Menu::class, 'menu_menu_item');
    }
}
