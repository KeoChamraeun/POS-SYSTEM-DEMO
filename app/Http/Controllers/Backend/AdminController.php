<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminLogout()
    {
        Auth::logout();
        $notification = [
            'message' => 'Admin logout Successfully',
            'alert-type' => 'success'
        ];
        return redirect('/login')->with($notification);
    }



    public function POSTable(){
        $menus = Menu::all();
        $menuItems = MenuItem::all();
        $categories = MenuItem::get('category');
        return view('admin.pos.pos_table', compact('menus','menuItems','categories'));
    }
}
