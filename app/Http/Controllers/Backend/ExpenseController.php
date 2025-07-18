<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ExpenseHead;
use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;

class ExpenseController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $expenses = Expense::where('user_id', $userId)->get();
        $heads = ExpenseHead::where('user_id', $userId)->where('status', 'active')->get();

        return view('admin.expense.expense_list', compact('expenses', 'heads'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $expense = new Expense();
            $expense->amount = $request->amount;
            $expense->head_id = $request->head_id;
            $expense->date = $request->date;
            $expense->description = $request->description;
            $expense->user_id = Auth::id();
            $expense->save();

            DB::commit();

            return redirect()->route('expense.index')->with('success', 'Expense created successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error creating expense: ' . $th->getMessage());
            return redirect()->route('expense.index')->with('error', 'Failed to create expense.');
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $expense = Expense::findOrFail($request->id);

            if ($expense->user_id !== Auth::id()) {
                return redirect()->route('expense.index')->with('error', 'Unauthorized action.');
            }

            $expense->amount = $request->amount;
            $expense->head_id = $request->head_id;
            $expense->date = $request->date;
            $expense->description = $request->description;
            $expense->save();

            DB::commit();

            return redirect()->route('expense.index')->with('success', 'Expense updated successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error updating expense: ' . $th->getMessage());
            return redirect()->route('expense.index')->with('error', 'Failed to update expense.');
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $expense = Expense::findOrFail($request->id);

            if ($expense->user_id !== Auth::id()) {
                return redirect()->route('expense.index')->with('error', 'Unauthorized action.');
            }

            $expense->delete();

            DB::commit();

            return redirect()->route('expense.index')->with('success', 'Expense deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error deleting expense: ' . $th->getMessage());
            return redirect()->route('expense.index')->with('error', 'Failed to delete expense.');
        }
    }

    public function bulkDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $ids = $request->ids;

            if (!$ids || count($ids) === 0) {
                return redirect()->route('expense.index')->with('error', 'No expenses selected for deletion.');
            }

            $userId = Auth::id();
            foreach ($ids as $id) {
                $expense = Expense::findOrFail($id);
                if ($expense->user_id === $userId) {
                    $expense->delete();
                }
            }

            DB::commit();
            return redirect()->route('expense.index')->with('success', 'Expenses deleted successfully.');
        } catch (Exception $th) {
            DB::rollBack();
            Log::error('Error bulk deleting expenses: ' . $th->getMessage());
            return redirect()->route('expense.index')->with('error', 'Bulk delete failed. Please try again!');
        }
    }

    // ===== Expense Head Methods =====

    public function ExpenseHeadIndex()
    {
        $userId = Auth::id();
        $expense_heads = ExpenseHead::where('user_id', $userId)->get();
        return view('admin.expense.head.head_list', compact('expense_heads'));
    }

    public function ExpenseHeadStore(Request $request)
    {
        DB::beginTransaction();
        try {
            $expense_head = new ExpenseHead();
            $expense_head->name = $request->name;
            $expense_head->status = $request->status;
            $expense_head->user_id = Auth::id();
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
            $expense_head = ExpenseHead::findOrFail($request->id);

            if ($expense_head->user_id !== Auth::id()) {
                return redirect()->route('expense.head.index')->with('error', 'Unauthorized action.');
            }

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

            if ($expense_head->user_id !== Auth::id()) {
                return redirect()->route('expense.head.index')->with('error', 'Unauthorized action.');
            }

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

            $userId = Auth::id();
            foreach ($ids as $id) {
                $expense_head = ExpenseHead::findOrFail($id);
                if ($expense_head->user_id === $userId) {
                    $expense_head->delete();
                }
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
