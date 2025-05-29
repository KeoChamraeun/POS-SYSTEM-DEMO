<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.category.category_list', compact('categories'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate(
                [
                    'name' => 'required|string|max:255|unique:categories,name',
                    'status' => 'required|in:active,inactive',
                ],
                [
                    'name.unique' => 'The name has already been taken.',
                ],
            );

            $category = new Category();
            $category->name = $request->name;
            $category->status = $request->status;
            $category->save();

            DB::commit();

            return redirect()->route('category.index')->with('success', 'Category created successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error creating category: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Category created Failed. Please try again!');
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $category = Category::findOrFail($request->id);
            $category->name = $request->name;
            $category->status = $request->status;
            $category->save();

            DB::commit();

            return redirect()->route('category.index')->with('success', 'Category updated successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error updating category: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Category updated Failed. Please try again successfully.');
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $category = Category::findOrFail($request->id);
            $category->delete();

            DB::commit();

            return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error deleting category: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Category deleted Failed. Please try again!');
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

            Category::whereIn('id', $ids)->delete();

            DB::commit();

            return redirect()->route('category.index')->with('success', 'Categories deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error bulk deleting categories: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Bulk delete failed. Please try again!');
        }
    }
}
