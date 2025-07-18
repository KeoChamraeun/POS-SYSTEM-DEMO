<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Vat;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\Request;

class VatController extends Controller
{
    public function index()
    {
        $vats = Vat::where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.vat.vat_list', compact('vats'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:vats,name',
                'rate' => 'required|numeric|min:0',
                'status' => 'required|in:active,inactive',
            ], [
                'name.unique' => 'The name has already been taken.',
            ]);

            $vat = new Vat();
            $vat->user_id = Auth::id(); // Link to session user
            $vat->name = $request->name;
            $vat->rate = $request->rate;
            $vat->status = $request->status;
            $vat->updated_at = null;
            $vat->save();

            DB::commit();

            return redirect()->route('vat.index')->with('success', 'VAT created successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error creating vat: ' . $th->getMessage());

            return redirect()->back()->with('error', 'VAT creation failed. Please try again!');
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'rate' => 'required|numeric|min:0',
                'status' => 'required|in:active,inactive',
            ]);

            $vat = Vat::where('id', $request->id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $vat->name = $request->name;
            $vat->rate = $request->rate;
            $vat->status = $request->status;
            $vat->save();

            DB::commit();

            return redirect()->route('vat.index')->with('success', 'VAT updated successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error updating vat: ' . $th->getMessage());

            return redirect()->back()->with('error', 'VAT update failed. Please try again!');
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $vat = Vat::where('id', $request->id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $vat->delete();

            DB::commit();

            return redirect()->route('vat.index')->with('success', 'VAT deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error deleting vat: ' . $th->getMessage());

            return redirect()->back()->with('error', 'VAT deletion failed. Please try again!');
        }
    }

    public function bulkDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $ids = $request->ids;

            if (!$ids || count($ids) === 0) {
                return redirect()->route('vat.index')->with('error', 'No VATs selected for deletion.');
            }

            Vat::whereIn('id', $ids)
                ->where('user_id', Auth::id())
                ->delete();

            DB::commit();

            return redirect()->route('vat.index')->with('success', 'VATs deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error bulk deleting vats: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Bulk delete failed. Please try again!');
        }
    }
}
