<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SupplierController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $suppliers = Supplier::where('user_id', $userId)->orderBy('id', 'desc')->get();
        return view('admin.supplier.supplier_list', compact('suppliers'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $supplier = new Supplier();
            $supplier->user_id = Auth::id(); // Save session user ID
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->status = $request->status;

            if ($request->file('image')) {
                $supplier_img = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $supplier_img->getClientOriginalExtension();
                $image = $manager->read($supplier_img);
                $image->resize(740, 740);
                $image->toJpeg(80)->save(public_path('uploads/supplier/' . $name_gen));
                $supplier->image = 'uploads/supplier/' . $name_gen;
            }

            $supplier->save();
            DB::commit();

            return redirect()->route('supplier.index')->with('success', 'Supplier created successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error creating supplier: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Supplier creation failed. Please try again!');
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $supplier = Supplier::where('id', $request->id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->status = $request->status;

            if ($request->file('image')) {
                if ($supplier->image && file_exists(public_path($supplier->image))) {
                    unlink(public_path($supplier->image));
                }

                $supplier_img = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $supplier_img->getClientOriginalExtension();
                $image = $manager->read($supplier_img);
                $image->resize(740, 740);
                $image->toJpeg(80)->save(public_path('uploads/supplier/' . $name_gen));
                $supplier->image = 'uploads/supplier/' . $name_gen;
            }

            $supplier->save();
            DB::commit();

            return redirect()->route('supplier.index')->with('success', 'Supplier updated successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error updating supplier: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Supplier update failed. Please try again!');
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $supplier = Supplier::where('id', $request->id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            if ($supplier->image && file_exists(public_path($supplier->image))) {
                unlink(public_path($supplier->image));
            }

            $supplier->delete();
            DB::commit();

            return redirect()->route('supplier.index')->with('success', 'Supplier deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error deleting supplier: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Supplier deletion failed. Please try again!');
        }
    }

    public function bulkDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $ids = $request->ids;
            if (!$ids || count($ids) === 0) {
                return redirect()->route('supplier.index')->with('error', 'No suppliers selected for deletion.');
            }

            foreach ($ids as $id) {
                $supplier = Supplier::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->first();
                if ($supplier) {
                    if ($supplier->image && file_exists(public_path($supplier->image))) {
                        unlink(public_path($supplier->image));
                    }
                    $supplier->delete();
                }
            }

            DB::commit();
            return redirect()->route('supplier.index')->with('success', 'Suppliers deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error deleting suppliers: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Bulk deletion failed. Please try again!');
        }
    }
}
