@extends('admin.layout.admin_master')

@section('title')
<meta name="description" content="">
<meta name="keywords" content="">
<title>{{ $siteSettings->site_name }}</title>
@endsection

@section('content')
<div class="content">

    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4 class="fw-bold">Site Settings</h4>
                <h6>Manage your site settings</h6>
            </div>
        </div>
        <ul class="table-top-head">
            <li>
                <a href="{{ url()->current() }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Refresh"><i
                        class="ti ti-refresh"></i></a>
            </li>
            <li>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Collapse" id="collapse-header"><i
                        class="ti ti-chevron-up"></i></a>
            </li>
        </ul>
        <div class="page-btn">
            <a href="{{ url()->previous() }}" class="btn btn-primary"><i class="ti ti-arrow-left me-1"></i>Back</a>
        </div>
    </div>

    <!-- Site Settings -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('site.setting.update', $siteSettings->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="site_title" class="form-label">Site Name</label>
                            <input type="text" class="form-control" id="site_title" name="site_title"
                                value="{{ old('site_title', $siteSettings->site_title) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name"
                                value="{{ old('company_name', $siteSettings->company_name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="site_email" class="form-label">Site Email</label>
                            <input type="email" class="form-control" id="site_email" name="site_email"
                                value="{{ old('site_email', $siteSettings->site_email) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="site_phone" class="form-label">Site Phone</label>
                            <input type="text" class="form-control" id="site_phone" name="site_phone"
                                value="{{ old('site_phone', $siteSettings->site_phone) }}">
                        </div>
                        <div class="mb-3">
                            <label for="currency" class="form-label">Currency</label>
                            <input type="text" class="form-control" id="currency" name="currency"
                                value="{{ old('currency', $siteSettings->currency) }}">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Site Address</label>
                            <textarea class="form-control" id="address" name="address"
                                rows="2">{{ old('address', $siteSettings->address) }}</textarea>
                        </div>
                         <div class="mb-3">
                            <label for="site_logo" class="form-label">Site Logo</label>
                            <div class="add-choosen">
                                <div class="mb-3">
                                    <div class="image-upload image-upload-two">
                                        <input type="file" name="site_logo" class="form-control" id="site_logo"
                                            accept="image/*" onchange="loadImage(this, 'image-preview-edit')">
                                        <div class="image-uploads">
                                            <i data-feather="plus-circle" class="plus-down-add me-0"></i>
                                            <h4>Add Images</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="phone-img">
                                    <img src="{{ asset( $siteSettings->site_logo ? $siteSettings->site_logo : 'backend/assets/img/no-image.jpg') }}" id="image-preview"
                                        alt="image" class="image-preview-edit">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="url" class="form-control" id="facebook" name="facebook"
                                value="{{ old('facebook', $siteSettings->facebook) }}">
                        </div>
                        <div class="mb-3">
                            <label for="linkedin" class="form-label">LinkedIn</label>
                            <input type="url" class="form-control" id="linkedin" name="linkedin"
                                value="{{ old('linkedin', $siteSettings->linkedin) }}">
                        </div>
                        <div class="mb-3">
                            <label for="twitter" class="form-label">Twitter</label>
                            <input type="url" class="form-control" id="twitter" name="twitter"
                                value="{{ old('twitter', $siteSettings->twitter) }}">
                        </div>
                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="url" class="form-control" id="instagram" name="instagram"
                                value="{{ old('instagram', $siteSettings->instagram) }}">
                        </div>
                       
                        <div class="mb-3">
                            <label for="favicon" class="form-label">Site Favicon</label>
                            <div class="add-choosen">
                                <div class="mb-3">
                                    <div class="image-upload image-upload-two">
                                        <input type="file" name="favicon" class="form-control" accept="image/*"
                                            onchange="loadImage(this, 'image-preview-edit')">
                                        <div class="image-uploads">
                                            <i data-feather="plus-circle" class="plus-down-add me-0"></i>
                                            <h4>Add Images</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="phone-img">
                                    <img src="{{ asset($siteSettings->favicon ? $siteSettings->favicon : 'backend/assets/img/no-image.jpg') }}" id="image-preview"
                                        alt="image" class="image-preview-edit">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Settings</button>
            </form>
        </div>
    </div>

</div>
@endsection