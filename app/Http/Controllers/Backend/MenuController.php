<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('id', 'desc')->get();

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

            if ($request->file(key: 'image')) {
                $menu_img = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $menu_img->getClientOriginalExtension();
                $image = $manager->read($menu_img);
                $image->resize(740, 740);
                $image->toJpeg(80)->save(base_path('public/uploads/menu/' . $name_gen));
                $menu->image = 'uploads/menu/' . $name_gen;
            }

            $menu->save();

            DB::commit();

            return redirect()->route('menu.index')->with('success', 'menu created successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error creating menu: ' . $th->getMessage());

            return redirect()->back()->with('error', 'menu created Failed. Please try again!');
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $menu = Menu::findOrFail($request->id);
            $menu->name = $request->name;
            $menu->price = $request->price;
            $menu->status = $request->status;

            if ($request->file(key: 'image')) {
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
                $image->toJpeg(80)->save(base_path('public/uploads/menu/' . $name_gen));
                $menu->image = 'uploads/menu/' . $name_gen;
            }

            $menu->save();

            DB::commit();

            return redirect()->route('menu.index')->with('success', 'Menu updated successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error updating menu: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Menu update failed. Please try again!');
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $menu = Menu::findOrFail($request->id);
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

            Log::error('Error deleting menu item: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Menu item deletion failed. Please try again!');
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
                if ($menu && $menu->image) {
                    $imagePath = public_path($menu->image);
                    if (file_exists($imagePath) && is_file($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }

            Menu::whereIn('id', $ids)->delete();

            DB::commit();

            return redirect()->route('menu.index')->with('success', 'Selected Menu deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error bulk deleting menu: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Bulk delete failed. Please try again!');
        }
    }


    // Menu Item Methods
     public function menuItemIndex()
    {
        $menus = Menu::orderBy('id', 'desc')->get();
        $menuItems = MenuItem::orderBy('id', 'desc')->get();

        return view('admin.menu_item.menu_item_list', compact('menuItems', 'menus'));
    }

    public function menuItemStore(Request $request)
    {
        DB::beginTransaction();
        try {

            $menu = new MenuItem();
            $menu->name = $request->name;
            $menu->price = $request->price;
            $menu->status = $request->status;
            $menu->category = $request->menu;

            if ($request->file(key: 'image')) {
                $menu_img = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $menu_img->getClientOriginalExtension();
                $image = $manager->read($menu_img);
                $image->resize(150, 150);
                $image->toJpeg(80)->save(base_path('public/uploads/menu_item/' . $name_gen));
                $menu->image = 'uploads/menu_item/' . $name_gen;
            }

            $menu->save();

            DB::commit();

            return redirect()->route('menu.item.index')->with('success', 'menu item created successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error creating menu: ' . $th->getMessage());

            return redirect()->back()->with('error', 'menu item created Failed. Please try again!');
        }
    }

    public function menuItemUpdate(Request $request)
    {
        DB::beginTransaction();
        try {
            $menu = MenuItem::findOrFail($request->id);
            $menu->name = $request->name;
            $menu->price = $request->price;
            $menu->status = $request->status;
            $menu->category = $request->menu;

            if ($request->file(key: 'image')) {
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
                $image->toJpeg(80)->save(base_path('public/uploads/menu_item/' . $name_gen));
                $menu->image = 'uploads/menu_item/' . $name_gen;
            }

            $menu->save();

            DB::commit();

            return redirect()->route('menu.item.index')->with('success', 'Menu Item updated successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error updating menu item: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Menu Item update failed. Please try again!');
        }
    }

    public function menuItemDestroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $menu = MenuItem::findOrFail($request->id);
            $menu->delete();

            DB::commit();

            return redirect()->route('menu.item.index')->with('success', 'Menu item deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error deleting menu item: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Menu item deletion failed. Please try again!');
        }
    }

    public function menuItemBulkDelete(Request $request)
    {

         DB::beginTransaction();
        try {
            $ids = $request->ids;

            if (!$ids || count($ids) === 0) {
                return redirect()->route('menu.item.index')->with('error', 'No Menu item selected for deletion.');
            }

            MenuItem::whereIn('id', $ids)->delete();

            DB::commit();

            return redirect()->route('menu.item.index')->with('success', 'Selected Menu deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error bulk deleting menu: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Bulk delete failed. Please try again!');
        }
    }
}
