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
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $customers = Customer::where('user_id', $userId)->orderBy('id', 'desc')->get();
        return view('admin.customer.customer_list', compact('customers'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $customer = new Customer();
            $customer->user_id = Auth::id(); // assign session user
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->status = $request->status;

            if ($request->file('image')) {
                $customer_img = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $customer_img->getClientOriginalExtension();
                $image = $manager->read($customer_img);
                $image->resize(740, 740);
                $image->toJpeg(80)->save(public_path('uploads/customer/' . $name_gen));
                $customer->image = 'uploads/customer/' . $name_gen;
            }

            $customer->save();
            DB::commit();

            return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error creating customer: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Customer creation failed. Please try again!');
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $customer = Customer::where('id', $request->id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->status = $request->status;

            if ($request->file('image')) {
                if ($customer->image && file_exists(public_path($customer->image))) {
                    unlink(public_path($customer->image));
                }

                $customer_img = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $customer_img->getClientOriginalExtension();
                $image = $manager->read($customer_img);
                $image->resize(740, 740);
                $image->toJpeg(80)->save(public_path('uploads/customer/' . $name_gen));
                $customer->image = 'uploads/customer/' . $name_gen;
            }

            $customer->save();
            DB::commit();

            return redirect()->route('customer.index')->with('success', 'Customer updated successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error updating customer: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Customer update failed. Please try again!');
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $customer = Customer::where('id', $request->id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            if ($customer->image && file_exists(public_path($customer->image))) {
                unlink(public_path($customer->image));
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
                return redirect()->route('customer.index')->with('error', 'No customers selected for deletion.');
            }

            foreach ($ids as $id) {
                $customer = Customer::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->first();

                if ($customer) {
                    if ($customer->image && file_exists(public_path($customer->image))) {
                        unlink(public_path($customer->image));
                    }
                    $customer->delete();
                }
            }

            DB::commit();
            return redirect()->route('customer.index')->with('success', 'Customers deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error deleting customers: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Bulk deletion failed. Please try again!');
        }
    }
}
