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
                    <h4 class="fw-bold">Menu Item</h4>
                    <h6>Manage your Menu Item</h6>
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
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-menu"><i class="ti ti-circle-plus me-1"></i>Add Menu Item</a>
            </div>
        </div>

        <!-- Bulk Delete Form Start -->
        <form action="{{ route('menu.item.bulk.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete selected menuItems?');" enctype="multipart/form-data">
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
                                        @if (count($menuItems) > 0)
                                            <label class="checkboxs">
                                                <input type="checkbox" id="select-all">
                                                <span class="checkmarks"></span>
                                            </label>
                                        @endif
                                    </th>
                                    <th>Menu Item</th>
                                    <th>Price</th>
                                    <th>Image</th>
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
                                @if (session()->has('errors'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            @foreach ($errors->all() as $error)
                                                <p class="mb-0">{{ $error }}</p>
                                            @endforeach
                                    </div>
                                @endif

                                @foreach ($menuItems as $menuItem)
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox" name="ids[]" value="{{ $menuItem->id }}">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>

                                        <td><span class="text-gray-9">{{ $menuItem->name }}</span></td>
                                        <td>
                                            <span class="text-gray-9">${{ $menuItem->price }}</span>
                                        </td>

                                        <td>
                                            <img src="{{ asset($menuItem->image ?? 'backend/assets/img/no-image.jpg') }}" width="50" height="50" alt="image">
                                        </td>
                                        <td>
                                            @if ($menuItem->status == 'active')
                                                <span class="badge bg-success fw-medium fs-10">Active</span>
                                            @else
                                                <span class="badge bg-danger fw-medium fs-10">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="action-table-data">
                                            <div class="edit-delete-action">
                                                <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-menu-item" id="edit-item">
                                                    <i data-feather="edit" class="feather-edit"></i>
                                                </a>
                                                <input type="hidden" name="item_id" value="{{ $menuItem->id }}" id="item_id">
                                                <input type="hidden" name="item_name" value="{{ $menuItem->name }}" id="item_name">
                                                <input type="hidden" name="item_price" value="{{ $menuItem->price }}" id="item_price">
                                                <input type="hidden" name="item_image" value="{{ $menuItem->image }}" id="item_image">
                                                <input type="hidden" name="item_status" value="{{ $menuItem->status }}" id="item_status">
                                                <input type="hidden" name="item_category_id" value="{{ $menuItem->category }}" id="item_category_id">


                                                <a data-bs-toggle="modal" data-bs-target="#delete-modals" class="p-2 me-2 border outline-" href="javascript:void(0);" id="delete-item">
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


        <!-- Add menu -->
        <div class="modal fade" id="add-menu">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="page-title">
                            <h4>Add menu</h4>
                        </div>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('menu.item.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <img src="{{ asset('backend/assets/img/no-image.jpg') }}" id="image-preview" alt="image" class="image-preview">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category<span class="text-danger ms-1">*</span></label>
                                <div class="status-toggle modal-status d-flex justify-content-between align-items-center">

                                    <select name="category" class="form-select">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $items)
                                            <option value="{{ $items->id }}">{{ $items->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Menu Item<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" wire:model="name" name="name" placeholder="Enter item name">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" name="price" placeholder="Enter item price" required>
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
                            <button type="submit" class="btn btn-primary">Add Menu Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Add menu -->

        <!-- Edit menu -->
        <div class="modal fade" id="edit-menu-item">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="page-title">
                            <h4>Edit Menu Item</h4>
                        </div>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('menu.item.update') }}" method="POST" enctype="multipart/form-data">
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
                                    <img src="{{ asset('backend/assets/img/no-image.jpg') }}" id="image-preview" alt="image" class="image-preview-edit">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category<span class="text-danger ms-1">*</span></label>
                                <div class="status-toggle modal-status d-flex justify-content-between align-items-center">

                                    <select name="category" class="form-select" id="menu_cat">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $items)
                                            <option value="{{ $items->id }}">{{ $items->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Menu Item<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" value="" id="name" name="name" placeholder="Enter menu item name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" value="" id="price" name="price" placeholder="Enter menu item price" required>
                            </div>
                            <div class="mb-0">
                                <label class="form-label">Status<span class="text-danger ms-1">*</span></label>
                                <div class="status-toggle modal-status d-flex justify-content-between align-items-center">
                                     <select name="status" class="form-select" id="status">
                                        <option value="">Select Status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
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
                        <h4 class="modal-title">Delete Item</h4>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('menu.item.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="" id="delete_item_id">
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
        //jQuery for edit menu
        $(document).on('click', '#edit-item', function() {

            var item_id = $(this).closest('tr').find('#item_id').val();
            $('#id').val(item_id);

            var item_name = $(this).closest('tr').find('#item_name').val();
            $('#name').val(item_name);

            var item_price = $(this).closest('tr').find('#item_price').val();
            $('#price').val(item_price);

            var item_image = $(this).closest('tr').find('#item_image').val();
            $('.image-preview-edit').attr('src', item_image);

            var item_status = $(this).closest('tr').find('#item_status').val();
            $('#status option[value="' + item_status + '"]').prop('selected', true);

            var categoryId = $(this).closest('tr').find('#item_category_id').val();
            $('#menu_cat option[value="' + categoryId + '"]').prop('selected', true);
        });

        //jQuery for delete menu
        $(document).on('click', '#delete-item', function() {
            var item_id = $(this).closest('tr').find('#item_id').val();
            $('#delete_item_id').val(item_id);
        });
    </script>

@endsection
