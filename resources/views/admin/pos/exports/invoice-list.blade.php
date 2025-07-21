@extends('admin.layout.admin_master')

@section('title')
<meta name="description" content="Manage your POS invoices efficiently with our user-friendly interface.">
<meta name="keywords" content="POS, Invoices, Management, Sales">
<title>{{ site_settings()->site_name }} - POS Invoices</title>

<!-- Include jQuery UI CSS for datepicker -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css" />
<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
@endsection

@section('content')
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex justify-content-between align-items-center flex-wrap gap-3">
            <ul class="table-top-head d-flex gap-2 mb-0 align-items-center">
                <li>
                    <a href="{{ url()->current() }}" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh" data-bs-original-title="Refresh">
                        <i class="ti ti-refresh"></i>
                    </a>
                </li>
                <li>
                    <a data-bs-toggle="tooltip" data-bs-placement="top" id="collapse-header" aria-label="Collapse" data-bs-original-title="Collapse">
                        <i class="ti ti-chevron-up"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ url()->previous() }}" class="btn btn-primary" style="min-width: 90px;">
                        <i class="ti ti-arrow-left me-1"></i>Back
                    </a>
                </li>
            </ul>

            <form action="{{ route('pos.invoice.list') }}" method="GET" class="d-flex gap-1 align-items-center" id="dateFilterForm" style="min-width: 280px;">
                <input type="text" name="start_date" id="start_date" class="form-control form-control-sm" autocomplete="off" value="{{ request('start_date') }}" placeholder="Start Date" style="max-width: 120px;">
                <input type="text" name="end_date" id="end_date" class="form-control form-control-sm" autocomplete="off" value="{{ request('end_date') }}" placeholder="End Date" style="max-width: 120px;">
                <a href="{{ route('pos.invoice.export') }}" class="btn btn-success btn-sm ms-2" id="exportLink">Export</a>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="invoiceTable">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>Invoice No</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Paid</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($invoiceList as $invoice)
                        <tr>
                            <td><input type="checkbox" name="selected_invoices[]" value="{{ $invoice->id }}"></td>
                            <td>
                                <a href="{{ route('order.confirmation', $invoice->id) }}">
                                    {{ $invoice->order_number }}
                                </a>
                            </td>
                            <td>{{ $invoice->customer_name }}</td>
                            <td>{{ $invoice->created_at->format('d M Y') }}</td>
                            <td>{{ site_settings()->currency }}{{ number_format($invoice->total, 2) }}</td>
                            <td>{{ site_settings()->currency }}{{ number_format($invoice->total, 2) }}</td>
                            <td>
                                <span class="badge bg-success">
                                    <i class="ti ti-point-filled me-1"></i>Paid
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No invoices found for the selected date range.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
    $(function() {
        // Initialize datepickers
        $('#start_date, #end_date').datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function() {
                $('#dateFilterForm').submit();
            }
        });

        // Delete confirmation modal handling
        let deleteUrl = '';
        $('#deleteConfirmModal').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget);
            deleteUrl = button.data('delete-url');
        });

        $('#deleteConfirm').on('click', function() {
            if (deleteUrl) {
                window.location.href = deleteUrl;
            }
        });

        // Select/Deselect all checkboxes
        $('#checkAll').on('change', function() {
            $('input[name="selected_invoices[]"]').prop('checked', $(this).prop('checked'));
        });
    });
</script>
@endsection