<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $menus = Menu::where('user_id', $userId)->orderBy('id', 'desc')->get();
        return view('admin.menu.menu_list', compact('menus'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $menu = new Menu();
            $menu->name = $request->name;
            $menu->price = $request->price;
            $menu->status = $request->status;
            $menu->user_id = Auth::id();
            if ($request->file('image')) {
                $menu_img = $request->file('image');
                $name_gen = hexdec(uniqid()) . '.' . $menu_img->getClientOriginalExtension();
                $save_url = 'Uploads/menu/' . $name_gen;
                $menu_img->move(public_path('Uploads/menu'), $name_gen);
                $menu->image = $save_url;
            }
            $menu->save();
            DB::commit();
            return redirect()->route('menu.index')->with('success', 'Menu created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Menu creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Menu creation failed: ' . $e->getMessage());
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $menu = Menu::findOrFail($request->id);
            if ($menu->user_id !== Auth::id()) {
                return redirect()->route('menu.index')->with('error', 'Unauthorized action.');
            }
            $menu->name = $request->name;
            $menu->price = $request->price;
            $menu->status = $request->status;
            if ($request->file('image')) {
                if ($menu->image && file_exists(public_path($menu->image))) {
                    unlink(public_path($menu->image));
                }
                $menu_img = $request->file('image');
                $name_gen = hexdec(uniqid()) . '.' . $menu_img->getClientOriginalExtension();
                $save_url = 'Uploads/menu/' . $name_gen;
                $menu_img->move(public_path('Uploads/menu'), $name_gen);
                $menu->image = $save_url;
            }
            $menu->save();
            DB::commit();
            return redirect()->route('menu.index')->with('success', 'Menu updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Menu update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Menu update failed: ' . $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $menu = Menu::findOrFail($request->id);
            if ($menu->user_id !== Auth::id()) {
                return redirect()->route('menu.index')->with('error', 'Unauthorized action.');
            }
            if ($menu->image && file_exists(public_path($menu->image))) {
                unlink(public_path($menu->image));
            }
            $menu->delete();
            DB::commit();
            return redirect()->route('menu.index')->with('success', 'Menu item deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Menu deletion failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Menu deletion failed: ' . $e->getMessage());
        }
    }

    public function bulkDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $ids = $request->ids;
            if (!$ids || count($ids) === 0) {
                return redirect()->route('menu.index')->with('error', 'No Menu selected for deletion.');
            }
            foreach ($ids as $id) {
                $menu = Menu::find($id);
                if ($menu && $menu->user_id === Auth::id()) {
                    if ($menu->image && file_exists(public_path($menu->image))) {
                        unlink(public_path($menu->image));
                    }
                    $menu->delete();
                }
            }
            DB::commit();
            return redirect()->route('menu.index')->with('success', 'Selected Menu deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Menu bulk delete failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Menu bulk delete failed: ' . $e->getMessage());
        }
    }

    // Menu Item Methods
    public function menuItemIndex()
    {
        $userId = Auth::id();
        $categories = Category::where('user_id', $userId)->orderBy('id', 'desc')->get();
        $menuItems = MenuItem::where('user_id', $userId)->orderBy('id', 'desc')->get();
        if ($categories->isEmpty()) {
            return redirect()->route('category.index')->with('error', 'No categories found. Please create a category first.');
        }
        return view('admin.menu_item.menu_item_list', compact('menuItems', 'categories'));
    }

    public function menuItemStore(Request $request)
    {
        Log::info('menuItemStore called with data: ', $request->all());
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validation->fails()) {
            Log::error('Validation failed: ', $validation->errors()->toArray());
            return redirect()->back()->withErrors($validation)->withInput();
        }

        DB::beginTransaction();
        try {
            $menu = new MenuItem();
            $menu->name = $request->name;
            $menu->price = $request->price;
            $menu->status = $request->status;
            $menu->category = $request->category;
            $menu->user_id = Auth::id();

            if ($request->file('image')) {
                $menu_img = $request->file('image');
                $name_gen = hexdec(uniqid()) . '.' . $menu_img->getClientOriginalExtension();
                $save_url = 'Uploads/menu_item/' . $name_gen;
                $menu_img->move(public_path('Uploads/menu_item'), $name_gen);
                $menu->image = $save_url;
            }

            $menu->save();
            DB::commit();
            Log::info('Menu item created successfully: ', ['id' => $menu->id]);
            return redirect()->route('menu.item.index')->with('success', 'Menu item created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Menu item creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Menu item creation failed: ' . $e->getMessage());
        }
    }


    public function menuItemUpdate(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'id' => 'required|exists:menu_items,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        if ($validation->fails()) {
            Log::error('Validation failed: ', $validation->errors()->toArray());
            return redirect()->back()->withErrors($validation)->withInput();
        }

        DB::beginTransaction();
        try {
            $menu = MenuItem::findOrFail($request->id);
            if ($menu->user_id !== Auth::id()) {
                return redirect()->route('menu.item.index')->with('error', 'Unauthorized action.');
            }

            $menu->name = $request->name;
            $menu->price = $request->price;
            $menu->status = $request->status;
            $menu->category = $request->category;

            if ($request->file('image')) {
                if ($menu->image && file_exists(public_path($menu->image))) {
                    unlink(public_path($menu->image));
                }
                $menu_img = $request->file('image');
                $name_gen = hexdec(uniqid()) . '.' . $menu_img->getClientOriginalExtension();
                $save_url = 'Uploads/menu_item/' . $name_gen;
                $menu_img->move(public_path('Uploads/menu_item'), $name_gen);
                $menu->image = $save_url;
            }

            $menu->save();
            DB::commit();
            return redirect()->route('menu.item.index')->with('success', 'Menu item updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Menu item update failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Menu item update failed: ' . $e->getMessage());
        }
    }


    public function menuItemDestroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $menu = MenuItem::findOrFail($request->id);
            if ($menu->user_id !== Auth::id()) {
                return redirect()->route('menu.item.index')->with('error', 'Unauthorized action.');
            }
            if ($menu->image && file_exists(public_path($menu->image))) {
                unlink(public_path($menu->image));
            }
            $menu->delete();
            DB::commit();
            return redirect()->route('menu.item.index')->with('success', 'Menu item deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Menu item deletion failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Menu item deletion failed: ' . $e->getMessage());
        }
    }

    public function menuItemBulkDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $ids = $request->ids;
            if (!$ids || count($ids) === 0) {
                return redirect()->route('menu.item.index')->with('error', 'No menu item selected for deletion.');
            }
            foreach ($ids as $id) {
                $menuItem = MenuItem::find($id);
                if ($menuItem && $menuItem->user_id === Auth::id()) {
                    if ($menuItem->image && file_exists(public_path($menuItem->image))) {
                        unlink(public_path($menuItem->image));
                    }
                    $menuItem->delete();
                }
            }
            DB::commit();
            return redirect()->route('menu.item.index')->with('success', 'Selected items deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Menu item bulk delete failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Menu item bulk delete failed: ' . $e->getMessage());
        }
    }
}
