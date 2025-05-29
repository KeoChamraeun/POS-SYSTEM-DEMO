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
                    <h4 class="fw-bold">menu</h4>
                    <h6>Manage your menu</h6>
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
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-menu"><i class="ti ti-circle-plus me-1"></i>Add menu</a>
            </div>
        </div>

        <!-- Bulk Delete Form Start -->
        <form action="{{ route('menu.bulk.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete selected menus?');" enctype="multipart/form-data">
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
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Menu</th>
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
                                @if (session()->has('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ session('error') }}</strong>
                                    </div>
                                @endif

                                @foreach ($menus as $menu)
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox" name="ids[]" value="{{ $menu->id }}">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>

                                        <td><span class="text-gray-9">{{ $menu->name }}</span></td>
                                        <td>
                                            <span class="text-gray-9">${{ $menu->price }}</span>
                                        </td>

                                        <td>
                                            <img src="{{ asset(  $menu->image) }}" width="50" height="50" alt="image">
                                        </td>
                                        <td>
                                            @if ($menu->status == 'active')
                                                <span class="badge bg-success fw-medium fs-10">Active</span>
                                            @else
                                                <span class="badge bg-danger fw-medium fs-10">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="action-table-data">
                                            <div class="edit-delete-action">
                                                <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-menu" id="edit-cat">
                                                    <i data-feather="edit" class="feather-edit"></i>
                                                </a>
                                                <input type="hidden" name="menu_id" value="{{ $menu->id }}" id="menu_id">
                                                <input type="hidden" name="menu_name" value="{{ $menu->name }}" id="menu_name">
                                                <input type="hidden" name="menu_price" value="{{ $menu->price }}" id="menu_price">
                                                <input type="hidden" name="menu_image" value="{{ $menu->image }}" id="menu_image">
                                                <input type="hidden" name="menu_status" value="{{ $menu->status }}" id="menu_status">

                                                <a data-bs-toggle="modal" data-bs-target="#delete-modals" class="p-3" href="javascript:void(0);" id="delete-cat">
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
                    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body add-list add">
                            <div class="add-choosen">
                                <div class="mb-3">
                                    <div class="image-upload image-upload-two">
                                        <input type="file" name="image" class="form-control" accept="image/*" required onchange="loadImage(this)">
                                        <div class="image-uploads">
                                            <i data-feather="plus-circle" class="plus-down-add me-0"></i>
                                            <h4>Add Images</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="phone-img">
                                    <img src="{{ asset('backend/assets/img/no-image.jpg') }}" id="image-preview" alt="image">
                                    {{-- <a href="javascript:void(0);"></a> --}}
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Menu<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" wire:model="name" name="name" placeholder="Enter menu name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" name="price" placeholder="Enter menu price" required>
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
                            <button type="submit" class="btn btn-primary">Add menu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Add menu -->
        <!-- /product list -->

        <!-- Edit menu -->
        <div class="modal fade" id="edit-menu">
            <div class="modal-dialog modal-dialog-centered" >
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="page-title">
                            <h4>Edit menu</h4>
                        </div>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('menu.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" value="" id="id">
                        <div class="modal-body">
                            <div class="add-choosen">
                                <div class="mb-3">
                                    <div class="image-upload image-upload-two">
                                        <input type="file" name="image" class="form-control" accept="image/*" onchange="loadImage(this)">
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
                                <label class="form-label">menu<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" value="" id="name" name="name" placeholder="Enter menu name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" value="" id="price" name="price" placeholder="Enter menu price" required>
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
                        <h4 class="modal-title">Delete menu</h4>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('menu.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="" id="delete_menu_id">
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
        $(document).on('click', '#edit-cat', function() {

            var menu_id = $(this).closest('tr').find('#menu_id').val();
            $('#id').val(menu_id);

            var menu_name = $(this).closest('tr').find('#menu_name').val();
            $('#name').val(menu_name);

            var menu_price = $(this).closest('tr').find('#menu_price').val();
            $('#price').val(menu_price);

            var menu_image = $(this).closest('tr').find('#menu_image').val();
            $('.image-preview').attr('src', menu_image);

            var menu_status = $(this).closest('tr').find('#menu_status').val();
            $('#status').val(menu_status);

            $('#status').html(`
            <option value="">Select Status</option>
            <option value="active" ${menu_status === 'active' ? 'selected' : ''}>Active</option>
            <option value="inactive" ${menu_status === 'inactive' ? 'selected' : ''}>Inactive</option>
        `);


        });

        //jQuery for delete menu
        $(document).on('click', '#delete-cat', function() {
            var menu_id = $(this).closest('tr').find('#menu_id').val();
            $('#delete_menu_id').val(menu_id);
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

    <script>
        function loadImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-preview').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                document.getElementById('image-preview').src = "";
            }
        }
    </script>
@endsection
