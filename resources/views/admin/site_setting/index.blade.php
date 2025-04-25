@extends('admin.layout.admin_master')
@section('content')
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Site Settings</h4>
                <h6>Update site settings</h6>
            </div>
        </div>
        <div class="page-btn mt-0">
            <a href="product-list.html" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left me-2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>Back</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="site_name" class="form-label">Site Name</label>
                            <input type="text" name="site_name" id="site_name" class="form-control"
                                value="{{ site_settings()->site_name }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="site_email" class="form-label">Site Email</label>
                            <input type="text" name="site_email" id="site_email" class="form-control"
                                value="{{ site_settings()->site_email }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="site_phone" class="form-label">Site Phone</label>
                            <input type="text" name="site_phone" id="site_phone" class="form-control"
                                value="{{ site_settings()->site_phone }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" id="address" class="form-control"
                                value="{{ site_settings()->address }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="footer_text" class="form-label">Footer Text</label>
                            <input type="text" name="footer_text" id="footer_text" class="form-control"
                                value="{{ site_settings()->footer_text }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="site_logo" class="form-label">Site Logo</label>
                            <input type="file" name="site_logo" id="site_logo" class="form-control">
                            <img src="{{ asset(site_settings()->site_logo) }}" alt="{{ site_settings()->site_name }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="favicon" class="form-label">Site Favicon</label>
                            <input type="file" name="favicon" id="favicon" class="form-control">
                            <img src="{{ asset(site_settings()->favicon) }}" alt="{{ site_settings()->site_name }}">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
