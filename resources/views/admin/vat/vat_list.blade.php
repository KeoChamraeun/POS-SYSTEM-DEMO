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
                    <h4 class="fw-bold">vat</h4>
                    <h6>Manage your vats</h6>
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
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-vat"><i class="ti ti-circle-plus me-1"></i>Add vat</a>
            </div>
        </div>

        <!-- Bulk Delete Form Start -->
        <form action="{{ route('vat.bulk.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete selected vats?');">
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
                                        @if (count($vats) > 0)
                                            <label class="checkboxs">
                                                <input type="checkbox" id="select-all">
                                                <span class="checkmarks"></span>
                                            </label>
                                        @endif
                                    </th>
                                    <th>Vat</th>
                                    <th>Rate</th>
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

                                @foreach ($vats as $vat)
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox" name="ids[]" value="{{ $vat->id }}">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>

                                        <td><span class="text-gray-9">{{ $vat->name }}</span></td>
                                        <td>
                                            {{ $vat->rate }}%</td>
                                        <td>
                                            @if ($vat->status == 'active')
                                                <span class="badge bg-success fw-medium fs-10">Active</span>
                                            @else
                                                <span class="badge bg-danger fw-medium fs-10">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="action-table-data">
                                            <div class="edit-delete-action">
                                                <a class="me-2 p-2" href="#" data-bs-toggle="modal" data-bs-target="#edit-vat" id="edit-cat">
                                                    <i data-feather="edit" class="feather-edit"></i>
                                                </a>
                                                <input type="hidden" name="vat_id" value="{{ $vat->id }}" id="vat_id">
                                                <input type="hidden" name="vat_name" value="{{ $vat->name }}" id="vat_name">
                                                <input type="hidden" name="vat_rate" value="{{ $vat->rate }}" id="vat_rate">
                                                <input type="hidden" name="vat_status" value="{{ $vat->status }}" id="vat_status">

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


        <!-- Add vat -->
        <div class="modal fade" id="add-vat">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="page-title">
                            <h4>Add vat</h4>
                        </div>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('vat.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">vat<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" wire:model="name" name="name" placeholder="Enter vat name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Rate<span class="text-danger ms-1">*</span></label>
                                <input type="number" class="form-control" name="rate" placeholder="Enter vat rate in %" required>
                            </div>
                            <div class="mb-0">
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
                            <button type="submit" class="btn btn-primary">Add vat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Add vat -->
        <!-- /product list -->

        <!-- Edit vat -->
        <div class="modal fade" id="edit-vat">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="page-title">
                            <h4>Edit vat</h4>
                        </div>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('vat.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="1" id="vat_id">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">vat<span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control" value="Computers" id="name" name="name" placeholder="Enter vat name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Rate<span class="text-danger ms-1">*</span></label>
                                <input type="number" class="form-control" name="rate" placeholder="Enter vat rate in %" required id="rate">
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
                        <h4 class="modal-title">Delete vat</h4>
                        <button type="button" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('vat.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="" id="delete_vat_id">
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
        //jQuery for edit vat
        $(document).on('click', '#edit-cat', function() {
            var vat_id = $(this).closest('tr').find('#vat_id').val();
            $('#vat_id').val(vat_id);

            var vat_name = $(this).closest('tr').find('#vat_name').val();
            $('#name').val(vat_name);

            var vat_rate = $(this).closest('tr').find('#vat_rate').val();
            $('#rate').val(vat_rate);



            var vat_status = $(this).closest('tr').find('#vat_status').val();
            $('#status').val(vat_status);

            $('#status').html(`
            <option value="">Select Status</option>
            <option value="active" ${vat_status === 'active' ? 'selected' : ''}>Active</option>
            <option value="inactive" ${vat_status === 'inactive' ? 'selected' : ''}>Inactive</option>
        `);


        });

        //jQuery for delete vat
        $(document).on('click', '#delete-cat', function() {
            var vat_id = $(this).closest('tr').find('#vat_id').val();
            $('#delete_vat_id').val(vat_id);
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
