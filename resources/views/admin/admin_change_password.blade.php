@extends('admin.layout.admin_master')

@section('title')
<meta name="description" content="">
<meta name="keywords" content="">
<title>{{ site_settings()->site_name }}</title>
@endsection

@section('content')

<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Change Password</h4>
            <h6>User Profile</h6>
        </div>
    </div>
    <!-- /product list -->
    <div class="card">
        <div class="card-header">
            <h4>Change Password</h4>

            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif


        </div>
        <div class="card-body profile-body">
            <form action="{{ route('admin.password.update') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Current Password<span class="text-danger ms-1">*</span></label>
                            <input type="password" class="form-control" name="current_password" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">New Password<span class="text-danger ms-1">*</span></label>
                            <input type="password" class="form-control" name="new_password" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Confirm Password<span class="text-danger ms-1">*</span></label>
                            <input type="password" class="form-control" name="new_password_confirmation" required>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <a href="javascript:void(0);" class="btn btn-secondary me-2 shadow-none">Cancel</a>
                        <button type="submit" class="btn btn-primary shadow-none">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /product list -->
</div>

@endsection