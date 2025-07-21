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
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // current user ID

        // Get menus only for the logged-in user
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
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $menu_img->getClientOriginalExtension();
                $image = $manager->read($menu_img);
                $image->resize(740, 740);
                $save_url = '/uploads/menu/' . $name_gen;
                $image->toJpeg(80)->save(public_path($save_url));
                $menu->image = $save_url;
            }

            $menu->save();

            DB::commit();

            return redirect()->route('menu.index')->with('success', 'Menu created successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            // DEBUG: Return actual error message to see on page (development only)
            return redirect()->back()->with('error', 'Menu creation failed: ' . $th->getMessage());

            // In production, comment above line and use:
            // Log::error('Error creating menu: ' . $th->getMessage());
            // return redirect()->back()->with('error', 'Menu creation failed. Please try again!');
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
                if ($menu->image) {
                    $imagePath = public_path($menu->image);
                    if (file_exists($imagePath) && is_file($imagePath)) {
                        unlink($imagePath);
                    }
                }
                $menu_img = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $menu_img->getClientOriginalExtension();
                $image = $manager->read($menu_img);
                $image->resize(740, 740);
                $save_url = '/uploads/menu/' . $name_gen;
                $image->toJpeg(80)->save(public_path($save_url));
                $menu->image = $save_url;
            }

            $menu->save();

            DB::commit();

            return redirect()->route('menu.index')->with('success', 'Menu updated successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Menu update failed: ' . $th->getMessage());
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

            if ($menu->image) {
                $imagePath = public_path($menu->image);
                if (file_exists($imagePath) && is_file($imagePath)) {
                    unlink($imagePath);
                }
            }

            $menu->delete();

            DB::commit();

            return redirect()->route('menu.index')->with('success', 'Menu item deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Menu item deletion failed: ' . $th->getMessage());
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
                    if ($menu->image) {
                        $imagePath = public_path($menu->image);
                        if (file_exists($imagePath) && is_file($imagePath)) {
                            unlink($imagePath);
                        }
                    }
                    $menu->delete();
                }
            }

            DB::commit();

            return redirect()->route('menu.index')->with('success', 'Selected Menu deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Bulk delete failed: ' . $th->getMessage());
        }
    }


    // Menu Item Methods

    public function menuItemIndex()
    {
        $userId = Auth::id();

        $categories = Category::where('user_id', $userId)->orderBy('id', 'desc')->get();
        $menuItems = MenuItem::where('user_id', $userId)->orderBy('id', 'desc')->get();

        return view('admin.menu_item.menu_item_list', compact('menuItems', 'categories'));
    }

    public function menuItemStore(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validation->fails()) {
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
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $menu_img->getClientOriginalExtension();
                $image = $manager->read($menu_img);
                $image->resize(150, 150);
                $save_url = '/uploads/menu_item/' . $name_gen;
                $image->toJpeg(80)->save(public_path($save_url));
                $menu->image = $save_url;
            }

            $menu->save();
            dd($menu);

            DB::commit();

            return redirect()->route('menu.item.index')->with('success', 'Menu item created successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Menu item creation failed: ' . $th->getMessage());
        }
    }

    public function menuItemUpdate(Request $request)
    {
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
                if ($menu->image) {
                    $imagePath = public_path($menu->image);
                    if (file_exists($imagePath) && is_file($imagePath)) {
                        unlink($imagePath);
                    }
                }
                $menu_img = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $menu_img->getClientOriginalExtension();
                $image = $manager->read($menu_img);
                $image->resize(150, 150);
                $save_url = '/uploads/menu_item/' . $name_gen;
                $image->toJpeg(80)->save(public_path($save_url));
                $menu->image = $save_url;
            }

            $menu->save();

            DB::commit();

            return redirect()->route('menu.item.index')->with('success', 'Menu item updated successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Menu item update failed: ' . $th->getMessage());
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
        } catch (Exception $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Menu item deletion failed: ' . $th->getMessage());
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
        } catch (Exception $th) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Bulk delete failed: ' . $th->getMessage());
        }
    }
}
