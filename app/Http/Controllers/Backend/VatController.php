<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vat;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;

class VatController extends Controller
{
    public function index()
    {
        $vats = Vat::orderBy('id', 'desc')->get();
        return view('admin.vat.vat_list', compact('vats'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate(
                [
                    'name' => 'required|string|max:255|unique:vats,name',
                    'status' => 'required|in:active,inactive',
                ],
                [
                    'name.unique' => 'The name has already been taken.',
                ],
            );

            $vat = new Vat();
            $vat->name = $request->name;
            $vat->rate = $request->rate;
            $vat->status = $request->status;
            $vat->updated_at = NULL;
            $vat->save();

            DB::commit();

            return redirect()->route('vat.index')->with('success', 'vat created successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error creating vat: ' . $th->getMessage());

            return redirect()->back()->with('error', 'vat created Failed. Please try again!');
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $vat = Vat::findOrFail($request->id);
            $vat->name = $request->name;
            $vat->rate = $request->rate;
            $vat->status = $request->status;
            $vat->save();

            DB::commit();

        return redirect()->route('vat.index')->with('success', 'VAT updated successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error updating vat: ' . $th->getMessage());

            return redirect()->back()->with('error', 'VAT updated Failed. Please try again successfully.');
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $vat = Vat::findOrFail($request->id);
            $vat->delete();

            DB::commit();

            return redirect()->route('vat.index')->with('success', 'vat deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error deleting vat: ' . $th->getMessage());

            return redirect()->back()->with('error', 'vat deleted Failed. Please try again!');
        }
    }

    public function bulkDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $ids = $request->ids;

            if (!$ids || count($ids) === 0) {
                return redirect()->route('vat.index')->with('error', 'No vats selected for deletion.');
            }

            Vat::whereIn('id', $ids)->delete();

            DB::commit();

            return redirect()->route('vat.index')->with('success', 'vats deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error bulk deleting vats: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Bulk delete failed. Please try again!');
        }
    }
}
