<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
   use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name'];

    public function menus() {
        return $this->belongsToMany(Menu::class, 'menu_menu_item');
    }

    public function menuItems() {
        return $this->hasMany(MenuItem::class,'category', 'id');
    }

}
