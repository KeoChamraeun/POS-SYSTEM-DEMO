<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $categories = Category::where('user_id', $userId)->orderBy('id', 'desc')->get();

        return view('admin.category.category_list', compact('categories'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate inputs and ensure unique category name per user
            $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    function ($attribute, $value, $fail) {
                        $exists = Category::where('name', $value)
                            ->where('user_id', Auth::id())
                            ->exists();
                        if ($exists) {
                            $fail('The category name already exists.');
                        }
                    },
                ],
                'status' => 'required|in:active,inactive',
            ]);

            $category = new Category();
            $category->name = $request->name;
            $category->status = $request->status;
            $category->user_id = Auth::id();
            $category->save();

            DB::commit();

            return redirect()->route('category.index')->with('success', 'Category created successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error creating category: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Category creation failed. Please try again!');
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'id' => 'required|exists:categories,id',
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    function ($attribute, $value, $fail) use ($request) {
                        $exists = Category::where('name', $value)
                            ->where('user_id', Auth::id())
                            ->where('id', '!=', $request->id)
                            ->exists();
                        if ($exists) {
                            $fail('The category name already exists.');
                        }
                    },
                ],
                'status' => 'required|in:active,inactive',
            ]);

            $category = Category::findOrFail($request->id);

            if ($category->user_id !== Auth::id()) {
                return redirect()->route('category.index')->with('error', 'Unauthorized update attempt.');
            }

            $category->name = $request->name;
            $category->status = $request->status;
            $category->save();

            DB::commit();

            return redirect()->route('category.index')->with('success', 'Category updated successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error updating category: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Category update failed. Please try again!');
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'id' => 'required|exists:categories,id',
            ]);

            $category = Category::findOrFail($request->id);

            if ($category->user_id !== Auth::id()) {
                return redirect()->route('category.index')->with('error', 'Unauthorized delete attempt.');
            }

            $category->delete();

            DB::commit();

            return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error deleting category: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Category deletion failed. Please try again!');
        }
    }

    public function bulkDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $ids = $request->ids;

            if (!$ids || count($ids) === 0) {
                return redirect()->route('category.index')->with('error', 'No categories selected for deletion.');
            }

            $userId = Auth::id();
            Category::whereIn('id', $ids)->where('user_id', $userId)->delete();

            DB::commit();

            return redirect()->route('category.index')->with('success', 'Categories deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error bulk deleting categories: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Bulk delete failed. Please try again!');
        }
    }
}
