@extends('admin.layout.admin_master')

@section('title')
<title>Edit Site Settings</title>
@endsection

@section('content')
<div class="content">

    <h4>Edit Site Settings</h4>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ route('site.setting.update', $siteSettings->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="site_title">Site Title</label>
            <input type="text" id="site_title" name="site_title" class="form-control" value="{{ old('site_title', $siteSettings->site_title) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="company_name">Company Name</label>
            <input type="text" id="company_name" name="company_name" class="form-control" value="{{ old('company_name', $siteSettings->company_name) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="site_email">Site Email</label>
            <input type="email" id="site_email" name="site_email" class="form-control" value="{{ old('site_email', $siteSettings->site_email) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="site_phone">Site Phone</label>
            <input type="text" id="site_phone" name="site_phone" class="form-control" value="{{ old('site_phone', $siteSettings->site_phone) }}">
        </div>

        <div class="form-group mb-3">
            <label for="currency">Currency</label>
            <input type="text" id="currency" name="currency" class="form-control" value="{{ old('currency', $siteSettings->currency) }}">
        </div>

        <div class="form-group mb-3">
            <label for="address">Address</label>
            <textarea id="address" name="address" class="form-control" rows="2">{{ old('address', $siteSettings->address) }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="site_logo">Site Logo</label>
            <input type="file" id="site_logo" name="site_logo" class="form-control">
            @if($siteSettings->site_logo)
            <img src="{{ asset($siteSettings->site_logo) }}" alt="Site Logo" style="max-height: 100px; margin-top: 10px;">
            @endif
        </div>

        <div class="form-group mb-3">
            <label for="favicon">Favicon</label>
            <input type="file" id="favicon" name="favicon" class="form-control">
            @if($siteSettings->favicon)
            <img src="{{ asset($siteSettings->favicon) }}" alt="Favicon" style="max-height: 50px; margin-top: 10px;">
            @endif
        </div>

        <div class="form-group mb-3">
            <label for="facebook">Facebook</label>
            <input type="url" id="facebook" name="facebook" class="form-control" value="{{ old('facebook', $siteSettings->facebook) }}">
        </div>

        <div class="form-group mb-3">
            <label for="twitter">Twitter</label>
            <input type="url" id="twitter" name="twitter" class="form-control" value="{{ old('twitter', $siteSettings->twitter) }}">
        </div>

        <div class="form-group mb-3">
            <label for="linkedin">LinkedIn</label>
            <input type="url" id="linkedin" name="linkedin" class="form-control" value="{{ old('linkedin', $siteSettings->linkedin) }}">
        </div>

        <div class="form-group mb-3">
            <label for="instagram">Instagram</label>
            <input type="url" id="instagram" name="instagram" class="form-control" value="{{ old('instagram', $siteSettings->instagram) }}">
        </div>

        <button type="submit" class="btn btn-success">Update Settings</button>
        <a href="{{ route('site.setting.index') }}" class="btn btn-secondary">Back</a>
    </form>

</div>
@endsection