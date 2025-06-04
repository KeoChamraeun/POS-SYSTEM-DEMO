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
                <div class="page-title">
                    <h4 class="fw-bold">Expense Head</h4>
                    <h6>Manage your Expense Head</h6>
                </div>
            </div>
            <ul class="table-top-head">
                <li>
                    <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i class="ti ti-refresh"></i></a>
                </li>
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i class="ti ti-chevron-up"></i></a>
                </li>
            </ul>
            <div class="page-btn">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-expense-head"><i class="ti ti-circle-plus me-1"></i>Add Expense Head</a>
            </div>
        </div>

        <!-- Bulk Delete Form Start -->
        <form action="{{ route('expense.head.bulk.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete selected expense heads?');">
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
                                        @if (count($expense_heads) > 0)
                                            <label class="checkboxs">
                                                <input type="checkbox" id="select-all">
                                                <span class="checkmarks"></span>
                                            </label>
                                        @endif
                                    </th>
                                    <th>Expense Head</th>
                                    <th>Status</th>
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

                                @foreach ($expense_heads as $head)
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox" name="ids[]" value="{{ $head->id }}">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>

                                        <td><span class="text-gray-9">{{ $head->name }}</span></td>
                                        <td>
                                            @if ($head->status == 'active')
                                                <span class="badge bg-success fw-medium fs-10">Active</span>
                                            @else
                                                <span class="badge bg-danger fw-medium fs-10">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="action-table-data">
                                            <div class="edit-delete-action">
                                                <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-expense-head" id="edit-head">
                                                    <i data-feather="edit" class="feather-edit"></i>
                                                </a>
                                                <input type="hidden" name="head_id" value="{{ $head->id }}" id="head_id">
                                                <input type="hidden" name="head_name" value="{{ $head->name }}" id="head_name">
                                                <input type="hidden" name="expense_head_status" value="{{ $head->status }}" id="expense_head_status">

                                                <a data-bs-toggle="modal" data-bs-target="#delete-modals" class="p-2 me-2" href="javascript:void(0);" id="delete-expense-head" href="#">
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


        <!-- Add Expense Head -->
        <div class="modal fade" id="add-expense-head">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="page-title">
                            <h4>Add Expense Head</h4>
                        </div>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('expense.head.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Expense Head<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Expense Head" required>
                            </div>
                            <div class="mb-0">
                                <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <select name="status" class="form-select" required>
                                        <option value="">Select Status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn me-2 btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Expense Head</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Add Expense Head -->

        <!-- Edit Expense Head -->
        <div class="modal fade" id="edit-expense-head">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="page-title">
                            <h4>Edit Expense Head</h4>
                        </div>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('expense.head.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="" id="id">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Expense Head<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" value="" id="expense_head_name" name="name" placeholder="Enter Expense Head" required>
                            </div>
                            <div class="mb-0">
                                <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <select name="status" class="form-select" id="head_status">
                                        <option value="">Select Status</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn me-2 btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Delete modal --}}

        <div class="modal fade" id="delete-modals">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center p-4">
                    <div class="modal-body">
                        <div class="icon-circle bg-light-danger text-danger mx-auto mb-2" style="width: 50px; height: 50px; border-radius: 50%;">
                            <span class="rounded-circle d-inline-flex p-2 bg-danger-transparent mb-2"><i class="ti ti-trash fs-24 text-danger"></i></span>
                        </div>
                        <h5 class="mb-2 fw-bold">Delete Expense Head</h5>
                        <p class="text-muted mb-4">Are you sure you want to delete Head?</p>
                        <form action="{{ route('expense.head.delete') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="" id="delete_expense_head_id">
                            <div class="d-flex justify-content-center gap-3">
                                <button type="button" class="btn btn-dark px-4" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary text-white px-4">Yes Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <script>
        //jQuery for edit expense head
        $(document).on('click', '#edit-head', function() {
            var head_id = $(this).closest('tr').find('#head_id').val();
            $('#id').val(head_id);
            var head_name = $(this).closest('tr').find('#head_name').val();
            $('#expense_head_name').val(head_name);

            var head_status = $(this).closest('tr').find('#expense_head_status').val();
            $('#head_status').val(head_status);

            $('#head_status').html(`
            <option value="">Select Status</option>
            <option value="active" ${head_status === 'active' ? 'selected' : ''}>Active</option>
            <option value="inactive" ${head_status === 'inactive' ? 'selected' : ''}>Inactive</option>
        `);


        });

        //jQuery for delete Expense head
        $(document).on('click', '#delete-expense-head', function() {
            var head_id = $(this).closest('tr').find('#head_id').val();
            $('#delete_expense_head_id').val(head_id);
        });
    </script>

    <script>
        document.getElementById('select-all').onclick = function() {
            let checkboxes = document.querySelectorAll('input[name="ids[]"]');
            for (let checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        }
    </script>
@endsection
