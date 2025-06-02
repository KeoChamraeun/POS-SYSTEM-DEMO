<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id', 'desc')->get();
        return view('admin.customer.customer_list', compact('customers'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $customer = new Customer();
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->status = $request->status;

            if ($request->file(key: 'image')) {
                $customer_img = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $customer_img->getClientOriginalExtension();
                $image = $manager->read($customer_img);
                $image->resize(740, 740);
                $image->toJpeg(80)->save(base_path('public/uploads/customer/' . $name_gen));
                $customer->image = 'uploads/customer/' . $name_gen;
            }

            $customer->updated_at = null;
            $customer->save();

            DB::commit();

            return redirect()->route('customer.index')->with('success', 'customer created successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error creating customer: ' . $th->getMessage());

            return redirect()->back()->with('error', 'customer created Failed. Please try again!');
        }
    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $customer = Customer::findOrFail($request->id);
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->status = $request->status;

            if ($request->file(key: 'image')) {
                if ($customer->image) {
                    $imagePath = public_path($customer->image);
                    if (file_exists($imagePath) && is_file($imagePath)) {
                        unlink($imagePath);
                    }
                }
                $customer_img = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $customer_img->getClientOriginalExtension();
                $image = $manager->read($customer_img);
                $image->resize(740, 740);
                $image->toJpeg(80)->save(base_path('public/uploads/customer/' . $name_gen));
                $customer->image = 'uploads/customer/' . $name_gen;
            }

            $customer->save();

            DB::commit();

            return redirect()->route('customer.index')->with('success', 'customer updated successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error updating customer: ' . $th->getMessage());

            return redirect()->back()->with('error', 'customer updated Failed. Please try again!');
        }
    }
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $customer = Customer::findOrFail($request->id);
            if ($customer->image ) {
                $imagePath = public_path($customer->image);
                if (file_exists($imagePath) && is_file($imagePath)) {
                    unlink($imagePath);
                }
            }
            $customer->delete();

            DB::commit();

            return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error deleting customer: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Customer deletion failed. Please try again!');
        }
    }
    public function bulkDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $ids = $request->ids;

            if (!$ids || count($ids) === 0) {
                return redirect()->route('customer.index')->with('error', 'No customer selected for deletion.');
            }

            foreach ($ids as $id) {
                $customer = Customer::findOrFail($id);
                if ($customer->image) {
                    $imagePath = public_path($customer->image);
                    if (file_exists($imagePath) && is_file($imagePath)) {
                        unlink($imagePath);
                    }
                }
                $customer->delete();
            }
            DB::commit();
            return redirect()->route('customer.index')->with('success', 'Customers deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error deleting customers: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Customers deletion failed. Please try again!');
        }
    }
}
