@extends('admin.layout.admin_master')

@section('title')
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>{{ site_settings()->site_name }}</title>
@endsection

@section('content')
    <div class="content">

        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-2">
            <div class="mb-3">
                <h1 class="mb-1">Welcome, {{ Auth::user()->name }}</h1>
                <p class="fw-medium">You have <span class="text-primary fw-bold">{{ $todaysOrder }}</span> Orders, Today</p>
            </div>
            <div class="input-icon-start position-relative mb-3 d-lg-none d-sm-block">
                <a href="{{ route('pos') }}" class="btn btn-dark btn-md d-inline-flex align-items-center">
                    <i class="ti ti-device-laptop me-1"></i>POS
                </a>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-primary sale-widget flex-fill">
                    <div class="card-body d-flex align-items-center">
                        <span class="sale-icon bg-white text-primary">
                            <i class="ti ti-file-text fs-24"></i>
                        </span>
                        <div class="ms-2">
                            <p class="text-white mb-1">Total Sales</p>
                            <div class="d-inline-flex align-items-center flex-wrap gap-2">
                                <h4 class="text-white">{{ site_settings()->currency }}{{ $totalSales }}</h4>
                                {{-- <span class="badge badge-soft-primary"><i class="ti ti-arrow-up me-1"></i>+22%</span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-secondary sale-widget flex-fill">
                    <div class="card-body d-flex align-items-center">
                        <span class="sale-icon bg-white text-secondary">
                            <i class="ti ti-repeat fs-24"></i>
                        </span>
                        <div class="ms-2">
                            <p class="text-white mb-1">Total Purchase</p>
                            <div class="d-inline-flex align-items-center flex-wrap gap-2">
                                <h4 class="text-white">{{ site_settings()->currency }}{{ number_format($totalPurchase,2)}}</h4>
                                {{-- <span class="badge badge-soft-danger"><i class="ti ti-arrow-down me-1"></i>-22%</span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-teal sale-widget flex-fill">
                    <div class="card-body d-flex align-items-center">
                        <span class="sale-icon bg-white text-teal">
                            <i class="ti ti-gift fs-24"></i>
                        </span>
                        <div class="ms-2">
                            <p class="text-white mb-1">Total Expense</p>
                            <div class="d-inline-flex align-items-center flex-wrap gap-2">
                                <h4 class="text-white">{{ site_settings()->currency }}{{ number_format($totalExpense,2)}}</h4>
                                {{-- <span class="badge badge-soft-success"><i class="ti ti-arrow-up me-1"></i>+22%</span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-info sale-widget flex-fill">
                    <div class="card-body d-flex align-items-center">
                        <span class="sale-icon bg-white text-info">
                            <i class="ti ti-brand-pocket fs-24"></i>
                        </span>
                        <div class="ms-2">
                            <p class="text-white mb-1">Total Profit</p>
                            <div class="d-inline-flex align-items-center flex-wrap gap-2">
                                <h4 class="text-white">{{ site_settings()->currency }}{{ number_format($totalProfit,2)}}</h4>
                                {{-- <span class="badge badge-soft-success"><i class="ti ti-arrow-up me-1"></i>+22%</span> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
