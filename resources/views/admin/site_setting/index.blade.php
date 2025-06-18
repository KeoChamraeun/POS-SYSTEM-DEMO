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
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table datatable">
                    <thead class="thead-light">
                        <tr>
                            <th>Site Title</th>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Currency Symbol</th>
                            <th>Action</th>
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

                        <tr>
                            <td>{{ $siteSettings->site_title }}</td>
                            <td> {{ $siteSettings->company_name }}</td>
                            <td>
                                <a href="mailto:{{ $siteSettings->site_email }}">{{ $siteSettings->site_email }}</a>
                            </td>
                            <td>
                                <a href="tel:{{ $siteSettings->site_phone }}">{{ $siteSettings->site_phone }}</a>
                            </td>
                            <td>{{ $siteSettings->currency }}</td>
                            <td>
                                <a class="me-2 p-2" href="{{ route('site.setting.edit', $siteSettings->id) }}">
                                    <i data-feather="edit" class="feather-edit"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endsection
