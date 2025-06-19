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
            <h4>Profile</h4>
            <h6>User Profile</h6>
        </div>
    </div>
    <!-- /product list -->
    <div class="card">
        <div class="card-header">
            <h4>Profile</h4>
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
            <h5 class="mb-2"><i class="ti ti-user text-primary me-1"></i>Basic Information</h5>
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="profile-pic-upload image-field">
                    <div class="profile-pic p-2">
                        <img src="{{ asset($user->thumbnail ? $user->thumbnail : '/backend/assets/img/avatar.png') }}"
                            class="object-fit-cover h-100 rounded-1" alt="user">
                        <button type="button" class="close rounded-1">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="mb-3">
                        <div class="image-upload mb-0 d-inline-flex">
                            <input type="file" name="thumbnail">
                            <div class="btn btn-primary fs-13">Change Image</div>
                        </div>
                        <p class="mt-2">Upload an image below 1 MB, Accepted File format JPG, PNG</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label>Email<span class="text-danger ms-1">*</span></label>
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                            <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-3">
                            <label class="form-label">Address<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" name="address" value="{{ $user->address }}">
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
