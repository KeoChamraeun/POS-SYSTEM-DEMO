@extends('admin.layout.admin_master')

@section('title')
<meta name="description" content="Manage your customers">
<meta name="keywords" content="customers, admin, management">
<title>{{ site_settings()->site_name ?? 'Customer Management' }}</title>
@endsection

@section('content')
<div class="content">
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Customers</h4>
                <h6>Manage your customers</h6>
            </div>
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
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-customer"><i class="ti ti-circle-plus me-1"></i>Add Customer</a>
        </div>
    </div>

    <!-- Bulk Delete Form -->
    <form action="{{ route('customer.bulk.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete selected customers?');" enctype="multipart/form-data">
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
                                    @if (count($customers) > 0)
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmarks"></span>
                                    </label>
                                    @endif
                                </th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th class="no-sort">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('error') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            @forelse ($customers as $customer)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox" name="ids[]" value="{{ $customer->id }}">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                            <img src="{{ $customer->image ? asset($customer->image) : asset('backend/assets/img/no-image.jpg') }}" alt="customer image" class="avatar-img rounded-circle">
                                        </a>
                                        <a href="javascript:void(0);">{{ $customer->name }}</a>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-gray-9">{{ $customer->email ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-9">{{ $customer->phone }}</span>
                                </td>
                                <td>
                                    @if ($customer->status == 'active')
                                    <span class="badge bg-success fw-medium fs-10">Active</span>
                                    @else
                                    <span class="badge bg-danger fw-medium fs-10">Inactive</span>
                                    @endif
                                </td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-customer" id="edit-cat">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        <input type="hidden" name="customer_id" value="{{ $customer->id }}" id="customer_id">
                                        <input type="hidden" name="customer_name" value="{{ $customer->name }}" id="customer_name">
                                        <input type="hidden" name="customer_email" value="{{ $customer->email ?? '' }}" id="customer_email">
                                        <input type="hidden" name="customer_phone" value="{{ $customer->phone }}" id="customer_phone">
                                        <input type="hidden" name="customer_address" value="{{ $customer->address }}" id="customer_address">
                                        <input type="hidden" name="customer_image" value="{{ $customer->image ? asset($customer->image) : asset('backend/assets/img/no-image.jpg') }}" id="customer_image">
                                        <input type="hidden" name="customer_status" value="{{ $customer->status }}" id="customer_status">

                                        <a data-bs-toggle="modal" data-bs-target="#delete-modals" class="p-2 me-2" href="javascript:void(0);" id="delete-cat">
                                            <i data-feather="trash-2" class="feather-trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No customers found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
    <!-- /Bulk Delete Form -->

    <!-- Add Customer Modal -->
    <div class="modal fade" id="add-customer">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="page-title">
                        <h4>Add Customer</h4>
                    </div>
                    <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body add-list add">
                        <div class="add-choosen">
                            <div class="mb-3">
                                <div class="image-upload image-upload-two">
                                    <input type="file" name="image" class="form-control" accept="image/*" onchange="loadImage(this, 'image-preview')">
                                    <div class="image-uploads">
                                        <i data-feather="plus-circle" class="plus-down-add me-0"></i>
                                        <h4>Add Image</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="phone-img">
                                <img src="{{ asset('backend/assets/img/no-image.jpg') }}" id="image-preview" alt="image">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter customer name" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter customer email" value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter customer phone" value="{{ old('phone') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="address" placeholder="Enter customer address" value="{{ old('address') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status<span class="text-danger ms-1">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="" disabled selected>Select Status</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-2 btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Add Customer Modal -->

    <!-- Edit Customer Modal -->
    <div class="modal fade" id="edit-customer">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="page-title">
                        <h4>Edit Customer</h4>
                    </div>
                    <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('customer.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="modal-body">
                        <div class="add-choosen">
                            <div class="mb-3">
                                <div class="image-upload image-upload-two">
                                    <input type="file" name="image" class="form-control" accept="image/*" onchange="loadImage(this, 'image-preview-edit')">
                                    <div class="image-uploads">
                                        <i data-feather="plus-circle" class="plus-down-add me-0"></i>
                                        <h4>Update Image</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="phone-img">
                                <img src="{{ asset('backend/assets/img/no-image.jpg') }}" id="image-preview-edit" alt="image" class="image-preview">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter customer name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter customer email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter customer phone" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter customer address" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status<span class="text-danger ms-1">*</span></label>
                            <select name="status" class="form-select" id="status" required>
                                <option value="" disabled>Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
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
    <!-- /Edit Customer Modal -->

    <!-- Delete Customer Modal -->
    <div class="modal fade" id="delete-modals">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Customer</h4>
                    <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('customer.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" id="delete_customer_id">
                    <div class="modal-body">
                        <h5>Are you sure you want to delete this customer?</h5>
                    </div>
                    <div class="modal-footer justify-content-start">
                        <button type="button" class="btn me-2 btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Delete Customer Modal -->

</div>

<script>
    // Select All Checkbox
    document.getElementById('select-all').onclick = function() {
        let checkboxes = document.querySelectorAll('input[name="ids[]"]');
        for (let checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    }

    // Image Preview
    function loadImage(input, previewId) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // jQuery for Edit Customer Modal
    $(document).on('click', '#edit-cat', function() {
        let customer_id = $(this).closest('tr').find('#customer_id').val();
        $('#id').val(customer_id);

        let customer_name = $(this).closest('tr').find('#customer_name').val();
        $('#name').val(customer_name);

        let customer_email = $(this).closest('tr').find('#customer_email').val();
        $('#email').val(customer_email);

        let customer_phone = $(this).closest('tr').find('#customer_phone').val();
        $('#phone').val(customer_phone);

        let customer_address = $(this).closest('tr').find('#customer_address').val();
        $('#address').val(customer_address);

        let customer_image = $(this).closest('tr').find('#customer_image').val();
        $('#image-preview-edit').attr('src', customer_image);

        let customer_status = $(this).closest('tr').find('#customer_status').val();
        $('#status').val(customer_status);
    });

    // jQuery for Delete Customer Modal
    $(document).on('click', '#delete-cat', function() {
        let customer_id = $(this).closest('tr').find('#customer_id').val();
        $('#delete_customer_id').val(customer_id);
    });
</script>
@endsection