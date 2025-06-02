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
                    <h4 class="fw-bold">Category</h4>
                    <h6>Manage your categories</h6>
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
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-category"><i class="ti ti-circle-plus me-1"></i>Add Category</a>
            </div>
        </div>

        <!-- Bulk Delete Form Start -->
        <form action="{{ route('category.bulk.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete selected categories?');">
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
                                        @if (count($categories) > 0)
                                            <label class="checkboxs">
                                                <input type="checkbox" id="select-all">
                                                <span class="checkmarks"></span>
                                            </label>
                                        @endif
                                    </th>
                                    <th>Category</th>
                                    <th>Created On</th>
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

                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox" name="ids[]" value="{{ $category->id }}">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>

                                        <td><span class="text-gray-9">{{ $category->name }}</span></td>
                                        <td>{{ $category->created_at->format('d M Y') }}</td>
                                        <td>
                                            @if ($category->status == 'active')
                                                <span class="badge bg-success fw-medium fs-10">Active</span>
                                            @else
                                                <span class="badge bg-danger fw-medium fs-10">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="action-table-data">
                                            <div class="edit-delete-action">
                                                <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-category" id="edit-cat">
                                                    <i data-feather="edit" class="feather-edit"></i>
                                                </a>
                                                <input type="hidden" name="cat_id" value="{{ $category->id }}" id="cat_id">
                                                <input type="hidden" name="cat_name" value="{{ $category->name }}" id="cat_name">
                                                <input type="hidden" name="cat_status" value="{{ $category->status }}" id="cat_status">

                                                <a data-bs-toggle="modal" data-bs-target="#delete-modals" class="p-2 me-2" href="javascript:void(0);" id="delete-cat" href="#">
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


        <!-- Add Category -->
        <div class="modal fade" id="add-category">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="page-title">
                            <h4>Add Category</h4>
                        </div>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Category<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" wire:model="name" name="name" placeholder="Enter category name" required>
                            </div>
                            <div class="mb-0">
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
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Add Category -->
        <!-- /product list -->

        <!-- Edit Category -->
        <div class="modal fade" id="edit-category">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="page-title">
                            <h4>Edit Category</h4>
                        </div>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('category.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="1" id="category_id">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Category<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" value="Computers" id="category_name" name="name" placeholder="Enter category name" required>
                            </div>
                            <div class="mb-0">
                                <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                    <select name="status" class="form-select" id="category_status">
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
                        <h4 class="modal-title">Delete Category</h4>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('category.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="" id="delete_category_id">
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
        //jQuery for edit category
        $(document).on('click', '#edit-cat', function() {
            var cat_id = $(this).closest('tr').find('#cat_id').val();
            $('#category_id').val(cat_id);
            var cat_name = $(this).closest('tr').find('#cat_name').val();
            $('#category_name').val(cat_name);

            var cat_status = $(this).closest('tr').find('#cat_status').val();
            $('#category_status').val(cat_status);

            $('#category_status').html(`
            <option value="">Select Status</option>
            <option value="active" ${cat_status === 'active' ? 'selected' : ''}>Active</option>
            <option value="inactive" ${cat_status === 'inactive' ? 'selected' : ''}>Inactive</option>
        `);


        });

        //jQuery for delete category
        $(document).on('click', '#delete-cat', function() {
            var cat_id = $(this).closest('tr').find('#cat_id').val();
            $('#delete_category_id').val(cat_id);
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
