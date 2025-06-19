<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
        return view('admin.index', compact('todaysOrder', 'totalSales', 'totalPurchase', 'totalProfit', 'totalExpense'));
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



    public function POSTable()
    {
        $menus = Menu::all();
        $menuItems = MenuItem::all();
        $categories = MenuItem::get('category');
        return view('admin.pos.pos_table', compact('menus', 'menuItems', 'categories'));
    }


    public function AdminProfile()
    {
        $user = Auth::user();
        return view('admin.admin_profile', compact('user'));
    }

    public function AdminProfileUpdate(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = Auth::id();
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            if ($request->hasFile('thumbnail')) {
                // Delete old image if exists
                if ($user->thumbnail && file_exists(public_path($user->thumbnail))) {
                    unlink(public_path($user->thumbnail));
                }
                // Store new image
                $image = $request->file('thumbnail');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/admin_images'), $imageName);
                $user->thumbnail = 'uploads/admin_images/' . $imageName;
            }
            $user->save();

            DB::commit();
            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Profile update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Profile update failed.');
        }
    }


    public function AdminPassword()
    {
        return view('admin.admin_change_password');
    }

    public function AdminPasswordUpdate(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = User::findOrFail(Auth::id());
        // Check if the current password matches
        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
        return back()->with('success', 'Password updated successfully.');
    }
}
