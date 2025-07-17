@extends('admin.layout.admin_master')

@section('title')
<meta name="description" content="">
<meta name="keywords" content="">
<title>{{ site_settings()->site_name }}</title>
@endsection

@section('content')
<div class="content">

    <div class="page-header">
        <div class="add-item d-flex">
            <!-- <div class="page-title">
                    <h4 class="fw-bold">Expense</h4>
                    <h6>Manage your Expense</h6>
                </div> -->
        </div>
        <ul class="table-top-head">
            <li>
                <a href="{{ url()->current() }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i class="ti ti-refresh"></i></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a>
            </li>
        </ul>
        <div class="page-btn">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-expense-head"><i class="ti ti-circle-plus me-1"></i>Add Expense</a>
        </div>
    </div>

    <!-- Bulk Delete Form Start -->
    <form action="{{ route('expense.bulk.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete selected expense?');">
        @csrf
        @method('DELETE')

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                <div class="search-set">
                    <div class="search-input">
                        <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                    </div>
                </div>
                <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
                    <button type="submit" class="btn btn-danger">
                        <i class="ti ti-trash"></i> Delete Selected
                    </button>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead class="thead-light">
                            <tr>
                                <th class="no-sort">
                                    @if (count($expenses) > 0)
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmarks"></span>
                                    </label>
                                    @endif
                                </th>
                                <th>Expense Head</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>Description</th>
                                <th class="no-sort"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                            </div>
                            @endif
                            @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('error') }}</strong>
                            </div>
                            @endif

                            @foreach ($expenses as $expense)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox" name="ids[]" value="{{ $expense->id }}">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>

                                <td><span class="text-gray-9">{{ $expense->head->name }}</span></td>
                                <td>
                                    <span class="text-gray-9">{{ $expense->amount }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-9">{{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-9">{{ $expense->description }}</span>
                                </td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-expense" id="edit-expense-btn">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        <input type="hidden" id="expense_id" value="{{ $expense->id }}">

                                        <input type="hidden" id="head_id" value="{{ $expense->head_id }}">

                                        <input type="hidden" id="expense_description" value="{{ $expense->description }}">

                                        <input type="hidden" id="expense_amount" value="{{ $expense->amount }}">

                                        <input type="hidden" id="expense_date" value="{{ \Carbon\Carbon::parse($expense->date)->format('Y-m-d') }}">

                                        <a data-bs-toggle="modal" data-bs-target="#delete-modals" class="p-2 me-2" href="javascript:void(0);" id="delete-expense" href="#">
                                            <i data-feather="trash-2" class="feather-trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
    <!-- Bulk Delete Form End -->

    <!-- Select All Checkbox Script -->
    <script>
        document.getElementById('select-all').onclick = function() {
            let checkboxes = document.querySelectorAll('input[name="ids[]"]');
            for (let checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        }
    </script>

    <!-- Add Expense Modal -->
    <div class="modal fade" id="add-expense-head">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="page-title">
                        <h4>Add Expense</h4>
                    </div>
                    <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('expense.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Expense Head<span class="text-danger ms-1">*</span></label>
                            <select name="head_id" class="form-select" required>
                                <option value="">Select Expense Head</option>
                                @foreach ($heads as $head)
                                <option value="{{ $head->id }}">{{ $head->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Expense Amount<span class="text-danger ms-1">*</span></label>
                            <input type="digit" name="amount" class="form-control" placeholder="Enter Expense Amount" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Expense Date<span class="text-danger ms-1">*</span></label>
                            <input type="date" name="date" class="form-control" placeholder="Select Expense Date" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Expense Description<span class="text-danger ms-1">*</span></label>
                            <input type="text" name="description" class="form-control" placeholder="Enter Expense Description" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-2 btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Expense </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Expense Modal -->

    <!-- Delete Expense Modal -->
    <div class="modal fade" id="delete-modals">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="modal-body">
                    <div class="icon-circle bg-light-danger text-danger mx-auto mb-2" style="width: 50px; height: 50px; border-radius: 50%;">
                        <span class="rounded-circle d-inline-flex p-2 bg-danger-transparent mb-2"><i class="ti ti-trash fs-24 text-danger"></i></span>
                    </div>
                    <h5 class="mb-2 fw-bold">Delete Expense</h5>
                    <p class="text-muted mb-4">Are you sure you want to delete Expense?</p>
                    <form action="{{ route('expense.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="" id="delete_expense_id">
                        <div class="d-flex justify-content-center gap-3">
                            <button type="button" class="btn btn-dark px-4" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary text-white px-4">Yes Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Expense Modal -->


    <!-- Edit Expense -->
    <div class="modal fade" id="edit-expense">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="page-title">
                        <h4>Edit Expense</h4>
                    </div>
                    <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('expense.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="" id="id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Expense Head<span class="text-danger ms-1">*</span></label>
                            <select name="head_id" class="form-select" id="head" required>
                                <option value="">Select Expense Head</option>
                                @foreach ($heads as $head)
                                <option value="{{ $head->id }}">{{ $head->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Expense Amount<span class="text-danger ms-1">*</span></label>
                            <input type="number" class="form-control" value="" id="amount" name="amount" placeholder="Enter Expense Amount" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Expense Date<span class="text-danger ms-1">*</span></label>
                            <input type="date" class="form-control" value="" id="date" name="date" placeholder="Enter Expense Date" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Expense Description<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="" id="description" name="description" placeholder="Enter Expense Description" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-2 btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Expense</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('select-all').onclick = function() {
            let checkboxes = document.querySelectorAll('input[name="ids[]"]');
            for (let checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        }
    </script>

    <script>
        // jQuery for Edit Expense
        $(document).on('click', '#edit-expense-btn', function() {
            var expense_id = $(this).closest('tr').find('#expense_id').val();
            var head_id = $(this).closest('tr').find('#head_id').val();
            var expense_description = $(this).closest('tr').find('#expense_description').val();
            var expense_amount = $(this).closest('tr').find('#expense_amount').val();
            var expense_date = $(this).closest('tr').find('#expense_date').val();

            $('#id').val(expense_id);
            $('#head').val(head_id);
            $('#description').val(expense_description);
            $('#amount').val(expense_amount);
            $('#date').val(expense_date);
        });
    </script>

    <script>
        // jQuery for Delete Expense
        $(document).on('click', '#delete-expense', function() {
            var expense_id = $(this).closest('tr').find('#expense_id').val();
            $('#delete_expense_id').val(expense_id);
        });
    </script>

    @endsection