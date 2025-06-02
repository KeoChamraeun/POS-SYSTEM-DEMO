<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $guarded = [];
    public function menus() {
        return $this->belongsToMany(Menu::class, 'menu_menu_item');
    }

    public function menu() {
        return $this->belongsTo(Menu::class, '', 'id');
    }

    public function categoryName() {
        return $this->belongsTo(Category::class,'category', 'id');
    }
}
