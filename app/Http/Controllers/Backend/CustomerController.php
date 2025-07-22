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
        $customers = Customer::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('admin.customer.customer_list', compact('customers'));
    }

    public function store(Request $request)
    {
        Log::info('Customer store request:', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:customers,email',
            'phone' => 'required|string|max:20|unique:customers,phone',
            'address' => 'required|string|max:500',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $customer = new Customer();
            $customer->user_id = Auth::id();
            $customer->name = $request->name;
            $customer->email = $request->email ?: null;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->status = $request->status;

            if ($request->hasFile('image')) {
                if (!extension_loaded('gd')) {
                    throw new Exception('GD PHP extension is required for image processing.');
                }

                $uploadPath = public_path('uploads/customer');
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                if (!is_writable($uploadPath)) {
                    throw new Exception('The directory uploads/customer/ is not writable. Please set permissions to 775.');
                }

                $customer_img = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $customer_img->getClientOriginalExtension();
                $image = $manager->read($customer_img);
                $image->resize(740, 740, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image->toJpeg(80)->save($uploadPath . '/' . $name_gen);
                $customer->image = 'uploads/customer/' . $name_gen;
            }

            $customer->save();
            DB::commit();

            return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating customer: ' . $e->getMessage(), ['file' => $e->getFile(), 'line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Failed to create customer: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:customers,id',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:customers,email,' . $request->id,
            'phone' => 'required|string|max:20|unique:customers,phone,' . $request->id,
            'address' => 'required|string|max:500',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();
        try {
            Log::info('Update request for customer ID: ' . $request->id . ' by user: ' . Auth::id());

            $customer = Customer::where('id', $request->id)
                ->where('user_id', Auth::id())
                ->first();

            if (!$customer) {
                throw new Exception('Customer not found or does not belong to the current user.');
            }

            $customer->name = $request->name;
            $customer->email = $request->email ?: null;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->status = $request->status;

            if ($request->hasFile('image')) {
                if (!extension_loaded('gd')) {
                    throw new Exception('GD PHP extension is required for image processing.');
                }

                $uploadPath = public_path('uploads/customer');
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                if (!is_writable($uploadPath)) {
                    throw new Exception('The directory uploads/customer/ is not writable. Please set permissions to 775.');
                }

                if ($customer->image && file_exists(public_path($customer->image))) {
                    unlink(public_path($customer->image));
                }

                $customer_img = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $customer_img->getClientOriginalExtension();
                $image = $manager->read($customer_img);
                $image->resize(740, 740, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image->toJpeg(80)->save($uploadPath . '/' . $name_gen);
                $customer->image = 'uploads/customer/' . $name_gen;
            }

            $customer->save();
            DB::commit();

            return redirect()->route('customer.index')->with('success', 'Customer updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating customer: ' . $e->getMessage(), ['file' => $e->getFile(), 'line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Failed to update customer: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:customers,id',
        ]);

        DB::beginTransaction();
        try {
            $customer = Customer::where('id', $request->id)
                ->where('user_id', Auth::id())
                ->first();

            if (!$customer) {
                throw new Exception('Customer not found or does not belong to the current user.');
            }

            if ($customer->image && file_exists(public_path($customer->image))) {
                unlink(public_path($customer->image));
            }

            $customer->delete();
            DB::commit();

            return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting customer: ' . $e->getMessage(), ['file' => $e->getFile(), 'line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Failed to delete customer: ' . $e->getMessage());
        }
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:customers,id',
        ]);

        DB::beginTransaction();
        try {
            $customers = Customer::whereIn('id', $request->ids)
                ->where('user_id', Auth::id())
                ->get();

            foreach ($customers as $customer) {
                if ($customer->image && file_exists(public_path($customer->image))) {
                    unlink(public_path($customer->image));
                }
                $customer->delete();
            }

            DB::commit();
            return redirect()->route('customer.index')->with('success', 'Customers deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting customers: ' . $e->getMessage(), ['file' => $e->getFile(), 'line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Failed to delete customers: ' . $e->getMessage());
        }
    }
}
