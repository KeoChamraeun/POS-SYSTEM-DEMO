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
                        <input type="text" class="form-control" placeholder="Search customers..." id="search-input">
                        <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                    </div>
                </div>
                <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
                    <button type="submit" class="btn btn-danger" id="bulk-delete-btn" disabled>
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
                                        <input type="checkbox" name="ids[]" value="{{ $customer->id }}" class="customer-checkbox">
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
                                        <a class="me-2 p-2 edit-customer" href="#" data-bs-toggle="modal" data-bs-target="#edit-customer" data-id="{{ $customer->id }}" data-name="{{ $customer->name }}" data-email="{{ $customer->email ?? '' }}" data-phone="{{ $customer->phone }}" data-address="{{ $customer->address }}" data-image="{{ $customer->image ? asset($customer->image) : asset('backend/assets/img/no-image.jpg') }}" data-status="{{ $customer->status }}">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        <a class="p-2 delete-customer" href="#" data-bs-toggle="modal" data-bs-target="#delete-modals" data-id="{{ $customer->id }}">
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
                                    <input type="file" name="image" class="form-control" accept="image/*" id="add-image">
                                    <div class="image-uploads">
                                        <i data-feather="plus-circle" class="plus-down-add me-0"></i>
                                        <h4>Add Image</h4>
                                    </div>
                                </div>
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="phone-img">
                                <img src="{{ asset('backend/assets/img/no-image.jpg') }}" id="image-preview" alt="image" class="image-preview">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter customer name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter customer email" value="{{ old('email') }}">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter customer phone" value="{{ old('phone') }}" required>
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="address" placeholder="Enter customer address" value="{{ old('address') }}" required>
                            @error('address')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status<span class="text-danger ms-1">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="" disabled selected>Select Status</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
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
                    @method('PUT')
                    <input type="hidden" name="id" id="edit-id">
                    <div class="modal-body">
                        <div class="add-choosen">
                            <div class="mb-3">
                                <div class="image-upload image-upload-two">
                                    <input type="file" name="image" class="form-control" accept="image/*" id="edit-image">
                                    <div class="image-uploads">
                                        <i data-feather="plus-circle" class="plus-down-add me-0"></i>
                                        <h4>Update Image</h4>
                                    </div>
                                </div>
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="phone-img">
                                <img src="{{ asset('backend/assets/img/no-image.jpg') }}" id="image-preview-edit" alt="image" class="image-preview">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" id="edit-name" name="name" placeholder="Enter customer name" required>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="edit-email" name="email" placeholder="Enter customer email">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" id="edit-phone" name="phone" placeholder="Enter customer phone" required>
                            @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" id="edit-address" name="address" placeholder="Enter customer address" required>
                            @error('address')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status<span class="text-danger ms-1">*</span></label>
                            <select name="status" class="form-select" id="edit-status" required>
                                <option value="" disabled>Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
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
                    <input type="hidden" name="id" id="delete-id">
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
    document.getElementById('select-all').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.customer-checkbox');
        const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        bulkDeleteBtn.disabled = !Array.from(checkboxes).some(cb => cb.checked);
    });

    // Individual Checkbox
    document.querySelectorAll('.customer-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
            bulkDeleteBtn.disabled = !Array.from(document.querySelectorAll('.customer-checkbox')).some(cb => cb.checked);
        });
    });

    // Image Preview
    function loadImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = "{{ asset('backend/assets/img/no-image.jpg') }}";
        }
    }

    // Add Image Preview
    document.getElementById('add-image').addEventListener('change', function() {
        loadImage(this, 'image-preview');
    });

    // Edit Image Preview
    document.getElementById('edit-image').addEventListener('change', function() {
        loadImage(this, 'image-preview-edit');
    });

    // Edit Customer Modal
    document.querySelectorAll('.edit-customer').forEach(button => {
        button.addEventListener('click', function() {
            const data = this.dataset;
            document.getElementById('edit-id').value = data.id;
            document.getElementById('edit-name').value = data.name;
            document.getElementById('edit-email').value = data.email;
            document.getElementById('edit-phone').value = data.phone;
            document.getElementById('edit-address').value = data.address;
            document.getElementById('edit-status').value = data.status;
            document.getElementById('image-preview-edit').src = data.image;
        });
    });

    // Delete Customer Modal
    document.querySelectorAll('.delete-customer').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('delete-id').value = this.dataset.id;
        });
    });

    // Search Functionality (Client-side)
    document.getElementById('search-input').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('.datatable tbody tr');
        rows.forEach(row => {
            const name = row.querySelector('td:nth-child(2) a').textContent.toLowerCase();
            const email = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            const phone = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
            row.style.display = name.includes(searchValue) || email.includes(searchValue) || phone.includes(searchValue) ? '' : 'none';
        });
    });
</script>
@endsection