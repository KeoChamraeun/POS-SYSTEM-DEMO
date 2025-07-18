@extends('admin.layout.admin_master')

@section('title')
<meta name="description" content="">
<meta name="keywords" content="">
<title>Site Settings</title>
@endsection

@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-btn">
            @if (!$siteSettings)
            <a href="{{ route('site.setting.create') }}" class="btn btn-primary">Add Site Setting</a>
            @endif
        </div>
    </div>

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
                        @if (session('success'))
                        <tr>
                            <td colspan="6" class="text-success text-center">{{ session('success') }}</td>
                        </tr>
                        @endif

                        @if (session('error'))
                        <tr>
                            <td colspan="6" class="text-danger text-center">{{ session('error') }}</td>
                        </tr>
                        @endif

                        @if ($siteSettings)
                        <tr>
                            <td>{{ $siteSettings->site_title }}</td>
                            <td>{{ $siteSettings->company_name }}</td>
                            <td><a href="mailto:{{ $siteSettings->site_email }}">{{ $siteSettings->site_email }}</a></td>
                            <td><a href="tel:{{ $siteSettings->site_phone }}">{{ $siteSettings->site_phone }}</a></td>
                            <td>{{ $siteSettings->currency }}</td>
                            <td>
                                <a href="{{ route('site.setting.edit', $siteSettings->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td colspan="6" class="text-center">No Site Settings found. Please create one.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection