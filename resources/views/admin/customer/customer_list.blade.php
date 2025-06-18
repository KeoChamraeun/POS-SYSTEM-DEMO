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
                    <h4 class="fw-bold">Customer</h4>
                    <h6>Manage your customer</h6>
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

        <!-- Bulk Delete Form Start -->
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
                                    <th class="no-sort"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>
                                            {{ session('success') }}
                                        </strong>
                                    </div>
                                @endif
                                @if (session()->has('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ session('error') }}</strong>
                                    </div>
                                @endif

                                @foreach ($customers as $customer)
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
														<img src="{{ asset($customer->image) }}" alt="customer image" class="avatar-img rounded-circle">
													</a>
													<a href="javascript:void(0);">{{ $customer->name }}</a>
												</div>
                                        </td>
                                        <td>
                                            <span class="text-gray-9">{{ $customer->email }}</span>
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
                                                <input type="hidden" name="customer_email" value="{{ $customer->email }}" id="customer_email">
                                                <input type="hidden" name="customer_phone" value="{{ $customer->phone }}" id="customer_phone">
                                                <input type="hidden" name="customer_address" value="{{ $customer->address }}" id="customer_address">
                                                <input type="hidden" name="customer_image" value="{{ $customer->image }}" id="customer_image">
                                                <input type="hidden" name="customer_status" value="{{ $customer->status }}" id="customer_status">

                                                <a data-bs-toggle="modal" data-bs-target="#delete-modals" class="p-2 me-2" href="javascript:void(0);" id="delete-cat">
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


        <!-- Add customer -->
        <div class="modal fade" id="add-customer">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="page-title">
                            <h4>Add customer</h4>
                        </div>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body add-list add">
                            <div class="add-choosen">
                                <div class="mb-3">
                                    <div class="image-upload image-upload-two">
                                        <input type="file" name="image" class="form-control" accept="image/*" required onchange="loadImage(this, 'image-preview')">
                                        <div class="image-uploads">
                                            <i data-feather="plus-circle" class="plus-down-add me-0"></i>
                                            <h4>Add Images</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="phone-img">
                                    <img src="{{ asset('backend/assets/img/no-image.jpg') }}" id="image-preview" alt="image">
                               </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Enter customer name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter customer email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" name="phone" placeholder="Enter customer price" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" name="address" placeholder="Enter your address" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status<span class="text-danger ms-1">*</span></label>
                                <div class="status-toggle modal-status d-flex justify-content-between align-items-center">

                                    <select name="status" class="form-select">
                                        <option value="">Select Status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn me-2 btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add customer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Add customer -->


        <!-- Edit customer -->
        <div class="modal fade" id="edit-customer">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="page-title">
                            <h4>Edit customer</h4>
                        </div>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('customer.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="" id="id">
                        <div class="modal-body">
                            <div class="add-choosen">
                                <div class="mb-3">
                                    <div class="image-upload image-upload-two">
                                        <input type="file" name="image" class="form-control" accept="image/*" onchange="loadImage(this, 'image-preview-edit')">
                                        <div class="image-uploads">
                                            <i data-feather="plus-circle" class="plus-down-add me-0"></i>
                                            <h4>Add Images</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="phone-img">
                                    <img src="{{ asset('backend/assets/img/no-image.jpg') }}" id="image-preview" alt="image" class="image-preview">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">customer<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" value="" id="name" name="name" placeholder="Enter customer name" required>
                            </div>
                             <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter customer email" id="email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" name="phone" placeholder="Enter customer price" required id="phone">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" name="address" placeholder="Enter your address" required id="address">
                            </div>
                            <div class="mb-0">
                                <label class="form-label">Status<span class="text-danger ms-1">*</span></label>
                                <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <select name="status" class="form-select" id="status">
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
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete customer</h4>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('customer.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="" id="delete_customer_id">
                        <div class="modal-body">
                            <h1>Are you sure you want to delete?</h1>
                        </div>
                        <div class="modal-footer justify-content-start">
                            <button type="button" class="btn me-2 btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        //jQuery for edit customer
        $(document).on('click', '#edit-cat', function() {

            var customer_id = $(this).closest('tr').find('#customer_id').val();
            $('#id').val(customer_id);

            var customer_name = $(this).closest('tr').find('#customer_name').val();
            $('#name').val(customer_name);

            var customer_email = $(this).closest('tr').find('#customer_email').val();
            $('#email').val(customer_email);

            var customer_phone = $(this).closest('tr').find('#customer_phone').val();
            $('#phone').val(customer_phone);

            var customer_address = $(this).closest('tr').find('#customer_address').val();
            $('#address').val(customer_address);

            var customer_image = $(this).closest('tr').find('#customer_image').val();
            $('.image-preview').attr('src', customer_image);

            var customer_status = $(this).closest('tr').find('#customer_status').val();
            $('#status').val(customer_status);

            $('#status').html(`
            <option value="">Select Status</option>
            <option value="active" ${customer_status === 'active' ? 'selected' : ''}>Active</option>
            <option value="inactive" ${customer_status === 'inactive' ? 'selected' : ''}>Inactive</option>
        `);


        });

        //jQuery for delete customer
        $(document).on('click', '#delete-cat', function() {
            var customer_id = $(this).closest('tr').find('#customer_id').val();
            $('#delete_customer_id').val(customer_id);
        });
    </script>
@endsection
