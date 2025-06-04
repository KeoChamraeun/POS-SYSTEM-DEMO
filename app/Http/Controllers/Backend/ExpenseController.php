<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ExpenseHead;
use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::get();
        return view('admin.expense.expense_list', compact('expenses'));
    }
    public function create()
    {
        // Logic to show the form for creating a new expense
        return view('admin.expense.create');
    }
    public function store(Request $request)
    {
        // Logic to store a new expense
        // Validate and save the expense data
        // Redirect or return response
    }
    public function edit($id)
    {
        // Logic to show the form for editing an existing expense
        // Fetch the expense by ID and pass it to the view
        return view('admin.expense.edit', compact('id'));
    }
    public function update(Request $request, $id)
    {
        // Logic to update an existing expense
        // Validate and update the expense data
        // Redirect or return response
    }
    public function destroy($id)
    {
        // Logic to delete an expense
        // Find the expense by ID and delete it
        // Redirect or return response
    }
    public function bulkDelete(Request $request)
    {
        // Logic to delete multiple expenses
        // Validate and delete the expenses based on IDs provided in the request
        // Redirect or return response
    }


    // Expense Head Routes
    public function ExpenseHeadIndex()
    {
        $expense_heads = ExpenseHead::all(); 
        return view('admin.expense.head.head_list', compact('expense_heads'));
    }
    public function ExpenseHeadStore(Request $request)
    {
        DB::beginTransaction();
        try {
            
            $expense_head = new ExpenseHead();
            $expense_head->name = $request->name;
            $expense_head->status = $request->status;
            $expense_head->save();

            DB::commit();

            return redirect()->route('expense.head.index')->with('success', 'Expense head created successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error creating expense head: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Expense head creation failed. Please try again!');
        }
    }
    public function ExpenseHeadUpdate(Request $request)
    {
        DB::beginTransaction();
        try {
            $expense_head = ExpenseHead::findOrFail(request()->id);
            $expense_head->name = $request->name;
            $expense_head->status = $request->status;
            $expense_head->save();

            DB::commit();

            return redirect()->route('expense.head.index')->with('success', 'Expense head updated successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error updating expense head: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Expense head update failed. Please try again!');
        }
    }

    public function ExpenseHeadDestroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $expense_head = ExpenseHead::findOrFail($request->id);
            $expense_head->delete();

            DB::commit();

            return redirect()->route('expense.head.index')->with('success', 'Expense head deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();

            Log::error('Error deleting expense head: ' . $th->getMessage());

            return redirect()->back()->with('error', 'Expense head deletion failed. Please try again!');
        }
    }
    public function ExpenseHeadBulkDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $ids = $request->ids;
            if (!$ids || count($ids) === 0) {       
                return redirect()->route('expense.head.index')->with('error', 'No expense head selected for deletion.');
            }
            foreach ($ids as $id) {
                $expense_head = ExpenseHead::findOrFail($id);
                $expense_head->delete();
            }
            DB::commit();
            return redirect()->route('expense.head.index')->with('success', 'Expense heads deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error bulk deleting expense heads: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Bulk delete failed. Please try again!');
        }
    }


}
