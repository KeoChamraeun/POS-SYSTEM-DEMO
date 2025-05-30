<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SupplierController extends Controller
{
     public function index()
    {
        $suppliers = Supplier::orderBy('id', 'desc')->get();
        return view('admin.supplier.supplier_list', compact('suppliers'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->status = $request->status;

            if ($request->file(key: 'image')) {
                $supplier_img = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $supplier_img->getClientOriginalExtension();
                $image = $manager->read($supplier_img);
                $image->resize(740, 740);
                $image->toJpeg(80)->save(base_path('public/uploads/supplier/' . $name_gen));
                $supplier->image = 'uploads/supplier/' . $name_gen;
            }

            $supplier->updated_at = null;
            $supplier->save();

            DB::commit();

            return redirect()->route('supplier.index')->with('success', 'supplier created successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error creating supplier: ' . $th->getMessage());

            return redirect()->back()->with('error', 'supplier created Failed. Please try again!');
        }
    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $supplier = Supplier::findOrFail($request->id);
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->status = $request->status;

            if ($request->file(key: 'image')) {
                if ($supplier->image) {
                    $imagePath = public_path($supplier->image);
                    if (file_exists($imagePath) && is_file($imagePath)) {
                        unlink($imagePath);
                    }
                }
                $supplier_img = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $supplier_img->getClientOriginalExtension();
                $image = $manager->read($supplier_img);
                $image->resize(740, 740);
                $image->toJpeg(80)->save(base_path('public/uploads/supplier/' . $name_gen));
                $supplier->image = 'uploads/supplier/' . $name_gen;
            }

            $supplier->save();

            DB::commit();

            return redirect()->route('supplier.index')->with('success', 'supplier updated successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error updating supplier: ' . $th->getMessage());

            return redirect()->back()->with('error', 'supplier updated Failed. Please try again!');
        }
    }
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $supplier = Supplier::findOrFail($request->id);
            if ($supplier->image ) {
                $imagePath = public_path($supplier->image);
                if (file_exists($imagePath) && is_file($imagePath)) {
                    unlink($imagePath);
                }
            }
            $supplier->delete();

            DB::commit();

            return redirect()->route('supplier.index')->with('success', 'supplier deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error deleting supplier: ' . $th->getMessage());

            return redirect()->back()->with('error', 'supplier deletion failed. Please try again!');
        }
    }
    public function bulkDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $ids = $request->ids;

            if (!$ids || count($ids) === 0) {
                return redirect()->route('supplier.index')->with('error', 'No supplier selected for deletion.');
            }

            foreach ($ids as $id) {
                $supplier = Supplier::findOrFail($id);
                if ($supplier->image) {
                    $imagePath = public_path($supplier->image);
                    if (file_exists($imagePath) && is_file($imagePath)) {
                        unlink($imagePath);
                    }
                }
                $supplier->delete();
            }
            DB::commit();
            return redirect()->route('supplier.index')->with('success', 'suppliers deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error deleting suppliers: ' . $th->getMessage());

            return redirect()->back()->with('error', 'suppliers deletion failed. Please try again!');
        }
    }
}
