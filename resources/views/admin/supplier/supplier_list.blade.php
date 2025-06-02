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
                <h4 class="fw-bold">Supplier</h4>
                <h6>Manage your supplier</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li>
                <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i
                        class="ti ti-refresh"></i></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                        class="ti ti-chevron-up"></i></a>
            </li>
        </ul>
        <div class="page-btn">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-supplier"><i
                    class="ti ti-circle-plus me-1"></i>Add supplier</a>
        </div>
    </div>

    <!-- Bulk Delete Form Start -->
    <form action="{{ route('supplier.bulk.delete') }}" method="POST"
        onsubmit="return confirm('Are you sure you want to delete selected suppliers?');" enctype="multipart/form-data">
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
                                    @if (count($suppliers) > 0)
                                    <label class="checkboxs">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmarks"></span>
                                    </label>
                                    @endif
                                </th>
                                <th>supplier</th>
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

                            @foreach ($suppliers as $supplier)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox" name="ids[]" value="{{ $supplier->id }}">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>

                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="avatar avatar-md me-2">
                                            <img src="{{ asset($supplier->image) }}" alt="supplier image"
                                                class="avatar-img rounded-circle">
                                        </a>
                                        <a href="javascript:void(0);">{{ $supplier->name }}</a>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-gray-9">{{ $supplier->email }}</span>
                                </td>
                                <td>
                                    <span class="text-gray-9">{{ $supplier->phone }}</span>
                                </td>
                                <td>
                                    @if ($supplier->status == 'active')
                                    <span class="badge bg-success fw-medium fs-10">Active</span>
                                    @else
                                    <span class="badge bg-danger fw-medium fs-10">Inactive</span>
                                    @endif
                                </td>
                                <td class="action-table-data">
                                    <div class="edit-delete-action">
                                        <a class="me-2 p-2" href="#" data-bs-toggle="modal"
                                            data-bs-target="#edit-supplier" id="edit-cat">
                                            <i data-feather="edit" class="feather-edit"></i>
                                        </a>
                                        <input type="hidden" name="supplier_id" value="{{ $supplier->id }}"
                                            id="supplier_id">
                                        <input type="hidden" name="supplier_name" value="{{ $supplier->name }}"
                                            id="supplier_name">
                                        <input type="hidden" name="supplier_email" value="{{ $supplier->email }}"
                                            id="supplier_email">
                                        <input type="hidden" name="supplier_phone" value="{{ $supplier->phone }}"
                                            id="supplier_phone">
                                        <input type="hidden" name="supplier_address" value="{{ $supplier->address }}"
                                            id="supplier_address">
                                        <input type="hidden" name="supplier_image" value="{{ $supplier->image }}"
                                            id="supplier_image">
                                        <input type="hidden" name="supplier_status" value="{{ $supplier->status }}"
                                            id="supplier_status">

                                        <a data-bs-toggle="modal" data-bs-target="#delete-modals" class="p-2 me-2"
                                            href="javascript:void(0);" id="delete-cat">
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


    <!-- Add supplier -->
    <div class="modal fade" id="add-supplier">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="page-title">
                        <h4>Add supplier</h4>
                    </div>
                    <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body add-list add">
                        <div class="add-choosen">
                            <div class="mb-3">
                                <div class="image-upload image-upload-two">
                                    <input type="file" name="image" class="form-control" accept="image/*" required
                                        onchange="loadImage(this, 'image-preview')">
                                    <div class="image-uploads">
                                        <i data-feather="plus-circle" class="plus-down-add me-0"></i>
                                        <h4>Add Images</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="phone-img">
                                <img src="{{ asset('backend/assets/img/no-image.jpg') }}" id="image-preview" alt="image"
                                    class="image-preview">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter supplier name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter supplier email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter supplier price"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="address" placeholder="Enter your address"
                                required>
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
                        <button type="submit" class="btn btn-primary">Add supplier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Add supplier -->

    <!-- Edit supplier -->
    <div class="modal fade" id="edit-supplier">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="page-title">
                        <h4>Edit supplier</h4>
                    </div>
                    <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('supplier.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="" id="id">
                    <div class="modal-body">
                        <div class="add-choosen">
                            <div class="mb-3">
                                <div class="image-upload image-upload-two">
                                    <input type="file" name="image" class="form-control" accept="image/*"
                                        onchange="loadImage(this, 'image-preview-edit')">
                                    <div class="image-uploads">
                                        <i data-feather="plus-circle" class="plus-down-add me-0"></i>
                                        <h4>Add Images</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="phone-img">
                                <img src="" id="image-preview" alt="image" class="image-preview image-preview-edit">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">supplier<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="" id="name" name="name"
                                placeholder="Enter supplier name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter supplier email"
                                id="email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="phone" placeholder="Enter supplier price"
                                required id="phone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="address" placeholder="Enter your address"
                                required id="address">
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
                    <h4 class="modal-title">Delete supplier</h4>
                    <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('supplier.delete') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="" id="delete_supplier_id">
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
    //jQuery for edit supplier
        $(document).on('click', '#edit-cat', function() {

            var supplier_id = $(this).closest('tr').find('#supplier_id').val();
            $('#id').val(supplier_id);

            var supplier_name = $(this).closest('tr').find('#supplier_name').val();
            $('#name').val(supplier_name);

            var supplier_email = $(this).closest('tr').find('#supplier_email').val();
            $('#email').val(supplier_email);

            var supplier_phone = $(this).closest('tr').find('#supplier_phone').val();
            $('#phone').val(supplier_phone);

            var supplier_address = $(this).closest('tr').find('#supplier_address').val();
            $('#address').val(supplier_address);

            var supplier_image = $(this).closest('tr').find('#supplier_image').val();
            $('.image-preview').attr('src', supplier_image);

            var supplier_status = $(this).closest('tr').find('#supplier_status').val();
            $('#status').val(supplier_status);

            $('#status').html(`
            <option value="">Select Status</option>
            <option value="active" ${supplier_status === 'active' ? 'selected' : ''}>Active</option>
            <option value="inactive" ${supplier_status === 'inactive' ? 'selected' : ''}>Inactive</option>
        `);


        });

        //jQuery for delete supplier
        $(document).on('click', '#delete-cat', function() {
            var supplier_id = $(this).closest('tr').find('#supplier_id').val();
            $('#delete_supplier_id').val(supplier_id);
        });
</script>
@endsection