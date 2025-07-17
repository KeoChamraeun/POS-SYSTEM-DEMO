@extends('admin.layout.admin_master')

@section('title')
<meta name="description" content="Manage your POS invoices efficiently with our user-friendly interface.">
<meta name="keywords" content="POS, Invoices, Management, Sales">
<title>{{ site_settings()->site_name }} - POS Invoices</title>
@endsection

@section('content')
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <!-- <div class="page-title">
                <h4>Invoices</h4>
                <h6>Manage your stock invoices</h6>
            </div> -->
        </div>
        <ul class="table-top-head">
            <li>
                <a href="{{ url()->current() }}" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Refresh"
                    data-bs-original-title="Refresh"><i class="ti ti-refresh"></i></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" id="collapse-header" aria-label="Collapse"
                    data-bs-original-title="Collapse"><i class="ti ti-chevron-up"></i></a>
            </li>
            <div class="page-btn">
                <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="ti ti-arrow-left me-1"></i>Back</a>
            </div>
        </ul>
    </div>

    <div class="card">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" class="fs-16 text-danger">&times;</span>
            </button>
        </div>
        @endif
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                <div class="search-input">
                    <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                </div>
            </div>
            <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table datatable">
                    <thead class="thead-light">
                        <tr>
                            <th class="no-sort">
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>Invoice No</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Paid</th>
                            <th>Status</th>
                            <th class="no-sort"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoiceList as $key => $invoice)
                        <tr>
                            <td>
                                <label class="checkboxs">
                                    <input type="checkbox">
                                    <span class="checkmarks"></span>
                                </label>
                            </td>
                            <td><a href="invoice-details-2.html">{{ $invoice->order_number }}</a></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0);">{{ $invoice->customer_name }}</a>
                                </div>
                            </td>
                            <td>
                                <span class="fs-12">{{ $invoice->created_at->format('d M Y') }}</span>

                            </td>
                            <td>
                                {{ site_settings()->currency }}{{ $invoice->total }}
                            </td>
                            <td>{{ site_settings()->currency }}{{ $invoice->total }}</td>
                            <td><span class="badge badge-soft-success badge-xs shadow-none"><i
                                        class="ti ti-point-filled me-1"></i>Paid</span></td>
                            <td class="d-flex">
                                <div class="edit-delete-action d-flex align-items-center justify-content-center">
                                    <a class="me-2 p-2 d-flex align-items-center justify-content-between border rounded"
                                        href="{{ route('order.confirmation', $invoice->id) }}">
                                        <i data-feather="eye" class="feather-eye"></i>
                                    </a>
                                    <a id="delete" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal"
                                        class="p-2 d-flex align-items-center justify-content-between border rounded"
                                        href="{{ route('order.delete', $invoice->id) }}">
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
</div>


<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">
            <div class="modal-body">
                <div class="mb-3">
                    <div class="icon-circle bg-light-danger text-danger mx-auto mb-2"
                        style="width: 50px; height: 50px; border-radius: 50%;">
                        <span class="rounded-circle d-inline-flex p-2 bg-danger-transparent mb-2"><i
                                class="ti ti-trash fs-24 text-danger"></i></span>
                    </div>
                    <h5 class="fw-bold">Delete Order</h5>
                    <p class="text-muted">Are you sure you want to delete Order?</p>
                </div>
                <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-dark px-4" data-bs-dismiss="modal">Cancel</button>
                    <a id="deleteConfirm" class="btn btn-primary text-white px-4">Yes Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Delete Confirmation Modal -->

<script>
    $(document).on('click', 'a#delete', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $('#deleteConfirmModal').modal('show');
        $('#deleteConfirmModal').on('click', 'a#deleteConfirm', function(e) {
            window.location.href = url;
        });
    });
</script>
@endsection