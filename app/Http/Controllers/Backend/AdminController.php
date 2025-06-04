<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $todaysOrder = Order::whereDate('created_at', now())->count();
        $totalSales = Order::whereDate('created_at', now())->sum('total');
        $totalPurchase = 0; // Assuming you will calculate total purchase from a different model or logic
        $totalProfit = $totalSales - $totalPurchase;
        $totalExpense = Expense::sum('amount'); 
        return view('admin.index', compact('todaysOrder','totalSales', 'totalPurchase', 'totalProfit', 'totalExpense'));
    }
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
