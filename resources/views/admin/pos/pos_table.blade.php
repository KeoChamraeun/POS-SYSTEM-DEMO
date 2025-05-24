<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layout.head')

</head>

<body class="pos-page">
    {{-- <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div> --}}
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <div class="header pos-header">

            <!-- Logo -->
            <div class="header-left active">
                <a href="index-2.html" class="logo logo-normal">
                    <img src="{{  asset('backend/assets/img/logo.svg') }}" alt="Img">
                </a>
                <a href="index-2.html" class="logo logo-white">
                    <img src="{{  asset('backend/assets/img/logo-white.svg') }}" alt="Img">
                </a>
                <a href="index-2.html" class="logo-small">
                    <img src="{{  asset('backend/assets/img/logo-small.svg') }}" alt="Img">
                </a>
            </div>
            <!-- /Logo -->

            <a id="mobile_btn" class="mobile_btn d-none" href="#sidebar">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

            <!-- Header Menu -->
            <ul class="nav user-menu">

                <!-- Search -->
                <li class="nav-item time-nav">
                    <span class="bg-teal text-white d-inline-flex align-items-center"><img
                            src="{{  asset('backend/assets/img/icons/clock-icon.svg') }}" alt="img" class="me-2">09:25:32</span>
                </li>
                <!-- /Search -->

                <li class="nav-item pos-nav">
                    <a href="{{ route('dashboard') }}" class="btn btn-purple btn-md d-inline-flex align-items-center">
                        <i class="ti ti-world me-1"></i>Dashboard
                    </a>
                </li>

                <li class="nav-item nav-item-box">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#calculator"
                        class="bg-orange border-orange text-white"><i class="ti ti-calculator"></i></a>
                </li>
                <li class="nav-item nav-item-box">
                    <a href="javascript:void(0);" id="btnFullscreen" data-bs-toggle="tooltip" data-bs-placement="top"
                        data-bs-title="Maximize">
                        <i class="ti ti-maximize"></i>
                    </a>
                </li>
               
                <li class="nav-item nav-item-box" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-title="Print Last Reciept">
                    <a href="#"><i class="ti ti-printer"></i></a>
                </li>
                <li class="nav-item nav-item-box" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-title="Today's Sale">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#today-sale"><i class="ti ti-progress"></i></a>
                </li>
             
                <li class="nav-item nav-item-box" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-title="POS Settings">
                    <a href=""><i class="ti ti-settings"></i></a>
                </li>
                 @php $user = Auth::user(); @endphp
                <li class="nav-item dropdown has-arrow main-drop profile-nav">
                    <a href="javascript:void(0);" class="nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-info p-0">
                            <span class="user-letter">
                                <img src="{{ asset( $user->image ?? 'backend/assets/img/avatar/avatar.png') }}" alt="{{ $user->name }}" class="img-fluid">
                            </span>
                        </span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                       
                        <div class="profilename">
                            <div class="profileset">
                                <span class="user-img"><img src="{{ asset( $user->image ?? 'backend/assets/img/avatar/avatar.png') }}" alt="{{$user->name}}">
                                    <span class="status online"></span></span>
                                <div class="profilesets">
                                    <h6>{{ $user->name }}</h6>
                                    <h5>{{ $user->role }}</h5>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a class="dropdown-item" href=""><i class="me-2" data-feather="user"></i>My
                                Profile</a>
                            <a class="dropdown-item" href=""><i class="me-2"
                                    data-feather="settings"></i>Settings</a>
                            <hr class="m-0">
                            <a class="dropdown-item logout pb-0" href="{{ route('admin.logout')}}"><img
                                    src="{{asset('backend/assets/img/icons/log-out.svg')}}" class="me-2" alt="img">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- /Header Menu -->

            <!-- Mobile Menu -->
            <div class="dropdown mobile-user-menu">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="">My Profile</a>
                    <a class="dropdown-item" href="">Settings</a>
                    <a class="dropdown-item" href="">Logout</a>
                </div>
            </div>
            <!-- /Mobile Menu -->
        </div>
        <!-- /Header -->


        <div class="page-wrapper pos-pg-wrapper ms-0">
            <div class="content pos-design p-0">

                <div class="row align-items-start pos-wrapper">

                    <!-- Products -->
                    <div class="col-md-12 col-lg-7 col-xl-8">
                        <div class="pos-categories tabs_wrapper pb-0">
                            <div class="card pos-button">
                                <div class="d-flex align-items-center flex-wrap">
                                    <a href="javascript:void(0);" class="btn btn-teal btn-md mb-xs-3"
                                        data-bs-toggle="modal" data-bs-target="#orders"><i
                                            class="ti ti-shopping-cart me-1"></i>View Orders</a>
                                    <a href="javascript:void(0);" class="btn btn-md btn-indigo" data-bs-toggle="modal"
                                        data-bs-target="#reset"><i class="ti ti-reload me-1"></i>Reset</a>
                                    <a href="javascript:void(0);" class="btn btn-md btn-info" data-bs-toggle="modal"
                                        data-bs-target="#recents"><i class="ti ti-refresh-dot me-1"></i>Transaction</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="mb-3">Categories</h4>
                            </div>

                            <ul class="tabs owl-carousel pos-category">
									<li id="all" class="active">
										<a href="javascript:void(0);">
											<img src="{{  asset('backend/assets/img/products/pos-product-01.png') }}" alt="Categories">
										</a>
										<h6><a href="javascript:void(0);">All Categories</a></h6>
										<span>80 Items</span>
									</li>
                                    @foreach ($categories  as $category)
                                        <li id="all" class="active">
										<a href="javascript:void(0);">
											<img src="{{  asset('backend/assets/img/products/pos-product-01.png') }}" alt="Categories">
										</a>
										<h6><a href="javascript:void(0);">{{ $category->category  }}</a></h6>
										<span>80 Items</span>
									</li>
                                    @endforeach
									
								</ul>
                            <div class="pos-products">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="mb-3">Products</h4>
                                    <div class="input-icon-start pos-search position-relative mb-3">
                                        <span class="input-icon-addon">
                                            <i class="ti ti-search"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Search Product">
                                    </div>
                                </div>
                                <div class="tabs_container">
                                    <div class="tab_content active" data-tab="all">
                                        <div class="row">
                                           @foreach($menuItems as $menuItem)
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="{{asset('backend/assets/img/products/pos-product-01.png')}}"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">{{ $menuItem->category }}</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">{{ $menuItem->name }}</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>30 Pcs</span>
                                                        <p>${{ $menuItem->price }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab_content" data-tab="headphones">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-05.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Headphones</a>
                                                    </h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Airpod 2</a>
                                                    </h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>47 Pcs</span>
                                                        <p>$5478</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-08.png"
                                                            alt="Products">
                                                        <span><i data-feather="check" class="feather-16"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Headphones</a>
                                                    </h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">SWAGME</a>
                                                    </h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>14 Pcs</span>
                                                        <p>$6587</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab_content" data-tab="shoes">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-04.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Red Nike
                                                            Angelo</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>78 Pcs</span>
                                                        <p>$7800</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-06.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Blue White
                                                            OGR</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>54 Pcs</span>
                                                        <p>$987</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-13.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Green Nike
                                                            Fe</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>78 Pcs</span>
                                                        <p>$7847</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab_content" data-tab="mobiles">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-01.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Mobiles</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">IPhone 14
                                                            64GB</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>30 Pcs</span>
                                                        <p>$15800</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-14.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Mobiles</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Iphone 11</a>
                                                    </h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>14 Pcs</span>
                                                        <p>$3654</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab_content" data-tab="watches">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-03.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Watches</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Rolex Tribute
                                                            V3</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>220 Pcs</span>
                                                        <p>$6800</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-09.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Watches</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Timex Black
                                                            Silver</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>24 Pcs</span>
                                                        <p>$1457</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-11.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Watches</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Fossil Pair
                                                            Of 3 in 1 </a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>40 Pcs</span>
                                                        <p>$789</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab_content" data-tab="laptops">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-02.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Computer</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">MacBook
                                                            Pro</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>140 Pcs</span>
                                                        <p>$1000</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-07.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Laptop</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">IdeaPad Slim
                                                            5 Gen 7</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>74 Pcs</span>
                                                        <p>$1454</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-10.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Computer</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Tablet 1.02
                                                            inch</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>14 Pcs</span>
                                                        <p>$4744</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-13.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Laptop</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Yoga Book
                                                            9i</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>65 Pcs</span>
                                                        <p>$4784</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-14.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Laptop</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">IdeaPad Slim
                                                            3i</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>47 Pcs</span>
                                                        <p>$1245</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab_content" data-tab="allcategory">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-01.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Mobiles</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">IPhone 14
                                                            64GB</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>30 Pcs</span>
                                                        <p>$15800</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-02.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Computer</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">MacBook
                                                            Pro</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>140 Pcs</span>
                                                        <p>$1000</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-03.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Watches</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Rolex Tribute
                                                            V3</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>220 Pcs</span>
                                                        <p>$6800</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-04.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Red Nike
                                                            Angelo</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>78 Pcs</span>
                                                        <p>$7800</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-05.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Headphones</a>
                                                    </h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Airpod 2</a>
                                                    </h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>47 Pcs</span>
                                                        <p>$5478</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-06.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Blue White
                                                            OGR</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>54 Pcs</span>
                                                        <p>$987</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-07.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Laptop</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">IdeaPad Slim
                                                            5 Gen 7</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>74 Pcs</span>
                                                        <p>$1454</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-08.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Headphones</a>
                                                    </h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">SWAGME</a>
                                                    </h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>14 Pcs</span>
                                                        <p>$6587</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-09.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Watches</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Timex Black
                                                            Silver</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>24 Pcs</span>
                                                        <p>$1457</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-10.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Computer</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Tablet 1.02
                                                            inch</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>14 Pcs</span>
                                                        <p>$4744</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-11.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Watches</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Fossil Pair
                                                            Of 3 in 1 </a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>40 Pcs</span>
                                                        <p>$789</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-13.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Green Nike
                                                            Fe</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>78 Pcs</span>
                                                        <p>$7847</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab_content" data-tab="headphone">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-05.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Headphones</a>
                                                    </h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Airpod 2</a>
                                                    </h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>47 Pcs</span>
                                                        <p>$5478</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-08.png"
                                                            alt="Products">
                                                        <span><i data-feather="check" class="feather-16"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Headphones</a>
                                                    </h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">SWAGME</a>
                                                    </h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>14 Pcs</span>
                                                        <p>$6587</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab_content" data-tab="shoe">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-04.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Red Nike
                                                            Angelo</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>78 Pcs</span>
                                                        <p>$7800</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-06.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Blue White
                                                            OGR</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>54 Pcs</span>
                                                        <p>$987</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-13.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Shoes</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Green Nike
                                                            Fe</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>78 Pcs</span>
                                                        <p>$7847</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab_content" data-tab="mobile">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-01.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Mobiles</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">IPhone 14
                                                            64GB</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>30 Pcs</span>
                                                        <p>$15800</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-14.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Mobiles</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Iphone 11</a>
                                                    </h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>14 Pcs</span>
                                                        <p>$3654</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab_content" data-tab="watche">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-03.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Watches</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Rolex Tribute
                                                            V3</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>220 Pcs</span>
                                                        <p>$6800</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-09.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Watches</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Timex Black
                                                            Silver</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>24 Pcs</span>
                                                        <p>$1457</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-11.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Watches</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Fossil Pair
                                                            Of 3 in 1 </a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>40 Pcs</span>
                                                        <p>$789</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab_content" data-tab="laptop">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-02.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Computer</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">MacBook
                                                            Pro</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>140 Pcs</span>
                                                        <p>$1000</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-07.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Laptop</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">IdeaPad Slim
                                                            5 Gen 7</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>74 Pcs</span>
                                                        <p>$1454</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-10.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Computer</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Tablet 1.02
                                                            inch</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>14 Pcs</span>
                                                        <p>$4744</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-13.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Laptop</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">Yoga Book
                                                            9i</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>65 Pcs</span>
                                                        <p>$4784</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3">
                                                <div class="product-info card">
                                                    <a href="javascript:void(0);" class="pro-img">
                                                        <img src="assets/img/products/pos-product-14.png"
                                                            alt="Products">
                                                        <span><i class="ti ti-circle-check-filled"></i></span>
                                                    </a>
                                                    <h6 class="cat-name"><a href="javascript:void(0);">Laptop</a></h6>
                                                    <h6 class="product-name"><a href="javascript:void(0);">IdeaPad Slim
                                                            3i</a></h6>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between price">
                                                        <span>47 Pcs</span>
                                                        <p>$1245</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Products -->

                    <!-- Order Details -->
                    <div class="col-md-12 col-lg-5 col-xl-4 ps-0 theiaStickySidebar">
                        <aside class="product-order-list">
                            <div class="order-head bg-light d-flex align-items-center justify-content-between w-100">
                                <div>
                                    <h3>Order List</h3>
                                    <span>Transaction ID : #65565</span>
                                </div>
                                <div>
                                    <a class="link-danger fs-16" href="javascript:void(0);"><i
                                            class="ti ti-trash-x-filled"></i></a>
                                </div>
                            </div>
                            <div class="customer-info block-section">
                                <h4 class="mb-3">Customer Information</h4>
                                <div class="input-block d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <select class="select">
                                            <option>Walk in Customer</option>
                                            <option>John</option>
                                            <option>Smith</option>
                                            <option>Ana</option>
                                            <option>Elza</option>
                                        </select>
                                    </div>
                                    <a href="#" class="btn btn-primary btn-icon" data-bs-toggle="modal"
                                        data-bs-target="#create"><i data-feather="user-plus" class="feather-16"></i></a>
                                </div>
                                <div class="input-block">
                                    <select class="select">
                                        <option>Search Products</option>
                                        <option>IPhone 14 64GB</option>
                                        <option>MacBook Pro</option>
                                        <option>Rolex Tribute V3</option>
                                        <option>Red Nike Angelo</option>
                                        <option>Airpod 2</option>
                                        <option>Oldest</option>
                                    </select>
                                </div>
                            </div>
                            <div class="product-added block-section">
                                <div class="head-text d-flex align-items-center justify-content-between">
                                    <h5 class="d-flex align-items-center mb-0">Product Added<span class="count">2</span>
                                    </h5>
                                    <a href="javascript:void(0);" class="d-flex align-items-center link-danger"><span
                                            class="me-2"><i data-feather="x" class="feather-16"></i></span>Clear all</a>
                                </div>
                                <div class="product-wrap">
                                    <div class="empty-cart">
                                        <div class="fs-24 mb-1">
                                            <i class="ti ti-shopping-cart"></i>
                                        </div>
                                        <p class="fw-bold">No Products Selected</p>
                                    </div>
                                    <div class="product-list align-items-center justify-content-between">
                                        <div class="d-flex align-items-center product-info" data-bs-toggle="modal"
                                            data-bs-target="#products">
                                            <a href="javascript:void(0);" class="pro-img">
                                                <img src="{{ asset('backend/assets/img/products/pos-product-04.png') }}" alt="Products">
                                            </a>
                                            <div class="info">
                                                <span>PT0005</span>
                                                <h6><a href="javascript:void(0);">Red Nike Laser</a></h6>
                                                <p class="fw-bold text-teal">$2000</p>
                                            </div>
                                        </div>
                                        <div class="qty-item text-center">
                                            <a href="javascript:void(0);"
                                                class="dec d-flex justify-content-center align-items-center"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="minus"><i
                                                    data-feather="minus-circle" class="feather-14"></i></a>
                                            <input type="text" class="form-control text-center" name="qty" value="4">
                                            <a href="javascript:void(0);"
                                                class="inc d-flex justify-content-center align-items-center"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="plus"><i
                                                    data-feather="plus-circle" class="feather-14"></i></a>
                                        </div>
                                        <div class="d-flex align-items-center action">
                                            <a class="btn-icon edit-icon me-1" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-product">
                                                <i data-feather="edit" class="feather-14"></i>
                                            </a>
                                            <a class="btn-icon delete-icon" href="javascript:void(0);"
                                                data-bs-toggle="modal" data-bs-target="#delete">
                                                <i data-feather="trash-2" class="feather-14"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-list align-items-center justify-content-between">
                                        <div class="d-flex align-items-center product-info" data-bs-toggle="modal"
                                            data-bs-target="#products">
                                            <a href="javascript:void(0);" class="pro-img">
                                                <img src="{{ asset('backend/assets/img/products/pos-product-10.png') }}" alt="Products">
                                            </a>
                                            <div class="info">
                                                <span>PT0235</span>
                                                <h6><a href="javascript:void(0);">Iphone 14</a></h6>
                                                <p class="fw-bold text-teal">$3000</p>
                                            </div>
                                        </div>
                                        <div class="qty-item text-center">
                                            <a href="javascript:void(0);"
                                                class="dec d-flex justify-content-center align-items-center"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="minus"><i
                                                    data-feather="minus-circle" class="feather-14"></i></a>
                                            <input type="text" class="form-control text-center" name="qty" value="3">
                                            <a href="javascript:void(0);"
                                                class="inc d-flex justify-content-center align-items-center"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="plus"><i
                                                    data-feather="plus-circle" class="feather-14"></i></a>
                                        </div>
                                        <div class="d-flex align-items-center action">
                                            <a class="btn-icon edit-icon me-1" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-product">
                                                <i data-feather="edit" class="feather-14"></i>
                                            </a>
                                            <a class="btn-icon delete-icon" href="javascript:void(0);"
                                                data-bs-toggle="modal" data-bs-target="#delete">
                                                <i data-feather="trash-2" class="feather-14"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-list align-items-center justify-content-between">
                                        <div class="d-flex align-items-center product-info" data-bs-toggle="modal"
                                            data-bs-target="#products">
                                            <a href="javascript:void(0);" class="pro-img">
                                                <img src="{{ asset('backend/assets/img/products/pos-product-09.png') }}" alt="Products">
                                            </a>
                                            <div class="info">
                                                <span>PT0242</span>
                                                <h6><a href="javascript:void(0);">Timex Black Silver</a></h6>
                                                <p class="fw-bold text-teal">$1457</p>
                                            </div>
                                        </div>
                                        <div class="qty-item text-center">
                                            <a href="javascript:void(0);"
                                                class="dec d-flex justify-content-center align-items-center"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="minus"><i
                                                    data-feather="minus-circle" class="feather-14"></i></a>
                                            <input type="text" class="form-control text-center" name="qty" value="1">
                                            <a href="javascript:void(0);"
                                                class="inc d-flex justify-content-center align-items-center"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="plus"><i
                                                    data-feather="plus-circle" class="feather-14"></i></a>
                                        </div>
                                        <div class="d-flex align-items-center action">
                                            <a class="btn-icon edit-icon me-1" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-product">
                                                <i data-feather="edit" class="feather-14"></i>
                                            </a>
                                            <a class="btn-icon delete-icon" href="javascript:void(0);"
                                                data-bs-toggle="modal" data-bs-target="#delete">
                                                <i data-feather="trash-2" class="feather-14"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-list align-items-center justify-content-between">
                                        <div class="d-flex align-items-center product-info" data-bs-toggle="modal"
                                            data-bs-target="#products">
                                            <a href="javascript:void(0);" class="pro-img">
                                                <img src="{{ asset('backend/assets/img/products/pos-product-08.png') }}" alt="Products">
                                            </a>
                                            <div class="info">
                                                <span>PT0005</span>
                                                <h6><a href="javascript:void(0);">SWAGME</a></h6>
                                                <p class="fw-bold text-teal">$6587</p>
                                            </div>
                                        </div>
                                        <div class="qty-item text-center">
                                            <a href="javascript:void(0);"
                                                class="dec d-flex justify-content-center align-items-center"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="minus"><i
                                                    data-feather="minus-circle" class="feather-14"></i></a>
                                            <input type="text" class="form-control text-center" name="qty" value="1">
                                            <a href="javascript:void(0);"
                                                class="inc d-flex justify-content-center align-items-center"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="plus"><i
                                                    data-feather="plus-circle" class="feather-14"></i></a>
                                        </div>
                                        <div class="d-flex align-items-center action">
                                            <a class="btn-icon edit-icon me-1" href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit-product">
                                                <i data-feather="edit" class="feather-14"></i>
                                            </a>
                                            <a class="btn-icon delete-icon" href="javascript:void(0);"
                                                data-bs-toggle="modal" data-bs-target="#delete">
                                                <i data-feather="trash-2" class="feather-14"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-section">
                                <div class="selling-info">
                                    <div class="row g-3">
                                        <div class="col-12 col-sm-4">
                                            <div>
                                                <label class="form-label">Order Tax</label>
                                                <select class="select">
                                                    <option>Select</option>
                                                    <option>GST 5%</option>
                                                    <option>GST 10%</option>
                                                    <option>GST 15%</option>
                                                    <option>GST 20%</option>
                                                    <option>GST 25%</option>
                                                    <option>GST 30%</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div>
                                                <label class="form-label">Shipping</label>
                                                <select class="select">
                                                    <option>0</option>
                                                    <option>15</option>
                                                    <option>20</option>
                                                    <option>25</option>
                                                    <option>30</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div>
                                                <label class="form-label">Discount</label>
                                                <select class="select">
                                                    <option>0%</option>
                                                    <option>10%</option>
                                                    <option>10%</option>
                                                    <option>15%</option>
                                                    <option>20%</option>
                                                    <option>25%</option>
                                                    <option>30%</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="order-total">
                                    <table class="table table-responsive table-borderless">
                                        <tr>
                                            <td>Sub Total</td>
                                            <td class="text-end">$60,454</td>
                                        </tr>
                                        <tr>
                                            <td>Tax (GST 5%)</td>
                                            <td class="text-end">$40.21</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping</td>
                                            <td class="text-end">$40.21</td>
                                        </tr>
                                        <tr>
                                            <td>Sub Total</td>
                                            <td class="text-end">$60,454</td>
                                        </tr>
                                        <tr>
                                            <td class="text-danger">Discount (10%)</td>
                                            <td class="text-danger text-end">$15.21</td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td class="text-end">$64,024.5</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="block-section payment-method">
                                <h4>Payment Method</h4>
                                <div class="row align-items-center justify-content-center methods g-3">
                                    <div class="col-sm-6 col-md-4">
                                        <a href="javascript:void(0);" class="payment-item" data-bs-toggle="modal"
                                            data-bs-target="#payment-cash">
                                            <i class="ti ti-cash-banknote fs-18"></i>
                                            <span>Cash</span>
                                        </a>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <a href="javascript:void(0);" class="payment-item" data-bs-toggle="modal"
                                            data-bs-target="#payment-card">
                                            <i class="ti ti-credit-card fs-18"></i>
                                            <span>Debit Card</span>
                                        </a>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <a href="javascript:void(0);" class="payment-item" data-bs-toggle="modal"
                                            data-bs-target="#scan-payment">
                                            <i class="ti ti-scan fs-18"></i>
                                            <span>Scan</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-block">
                                <a class="btn btn-secondary w-100" href="javascript:void(0);">
                                    Grand Total : $64,024.5
                                </a>
                            </div>
                            <div class="btn-row d-sm-flex align-items-center justify-content-between">
                                <a href="javascript:void(0);"
                                    class="btn btn-purple d-flex align-items-center justify-content-center flex-fill"
                                    data-bs-toggle="modal" data-bs-target="#hold-order"><i
                                        class="ti ti-player-pause me-1"></i>Hold</a>
                                <a href="javascript:void(0);"
                                    class="btn btn-danger d-flex align-items-center justify-content-center flex-fill"><i
                                        class="ti ti-trash me-1"></i>Void</a>
                                <a href="javascript:void(0);"
                                    class="btn btn-success d-flex align-items-center justify-content-center flex-fill"
                                    data-bs-toggle="modal" data-bs-target="#payment-completed"><i
                                        class="ti ti-cash-banknote me-1"></i>Payment</a>
                            </div>
                        </aside>
                    </div>
                    <!-- /Order Details -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Main Wrapper -->

    <!-- Payment Completed -->
    <div class="modal fade modal-default" id="payment-completed" aria-labelledby="payment-completed">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="success-wrap text-center">
                        <form action="https://dreamspos.dreamstechnologies.com/html/template/pos-2.html">
                            <div class="icon-success bg-success text-white mb-2">
                                <i class="ti ti-check"></i>
                            </div>
                            <h3 class="mb-2">Payment Completed</h3>
                            <p class="mb-3">Do you want to Print Receipt for the Completed Order</p>
                            <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap">
                                <button type="button" class="btn btn-md btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#print-receipt">Print Receipt<i
                                        class="feather-arrow-right-circle icon-me-5"></i></button>
                                <button type="submit" class="btn btn-md btn-primary">Next Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Payment Completed -->

    <!-- Print Receipt -->
    <div class="modal fade modal-default" id="print-receipt" aria-labelledby="print-receipt">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="icon-head text-center">
                        <a href="javascript:void(0);">
                            <img src="assets/img/logo.svg" width="100" height="30" alt="Receipt Logo">
                        </a>
                    </div>
                    <div class="text-center info text-center">
                        <h6>Dreamguys Technologies Pvt Ltd.,</h6>
                        <p class="mb-0">Phone Number: +1 5656665656</p>
                        <p class="mb-0">Email: <a
                                href="https://dreamspos.dreamstechnologies.com/cdn-cgi/l/email-protection#06637e676b766a6346616b676f6a2865696b"><span
                                    class="__cf_email__"
                                    data-cfemail="5d38253c302d31381d3a303c3431733e3230">[email&#160;protected]</span></a>
                        </p>
                    </div>
                    <div class="tax-invoice">
                        <h6 class="text-center">Tax Invoice</h6>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="invoice-user-name"><span>Name: </span>John Doe</div>
                                <div class="invoice-user-name"><span>Invoice No: </span>CS132453</div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="invoice-user-name"><span>Customer Id: </span>#LL93784</div>
                                <div class="invoice-user-name"><span>Date: </span>01.07.2022</div>
                            </div>
                        </div>
                    </div>
                    <table class="table-borderless w-100 table-fit">
                        <thead>
                            <tr>
                                <th># Item</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1. Red Nike Laser</td>
                                <td>$50</td>
                                <td>3</td>
                                <td class="text-end">$150</td>
                            </tr>
                            <tr>
                                <td>2. Iphone 14</td>
                                <td>$50</td>
                                <td>2</td>
                                <td class="text-end">$100</td>
                            </tr>
                            <tr>
                                <td>3. Apple Series 8</td>
                                <td>$50</td>
                                <td>3</td>
                                <td class="text-end">$150</td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <table class="table-borderless w-100 table-fit">
                                        <tr>
                                            <td class="fw-bold">Sub Total :</td>
                                            <td class="text-end">$700.00</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Discount :</td>
                                            <td class="text-end">-$50.00</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Shipping :</td>
                                            <td class="text-end">0.00</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Tax (5%) :</td>
                                            <td class="text-end">$5.00</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Total Bill :</td>
                                            <td class="text-end">$655.00</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Due :</td>
                                            <td class="text-end">$0.00</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Total Payable :</td>
                                            <td class="text-end">$655.00</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-center invoice-bar">
                        <div class="border-bottom border-dashed">
                            <p>**VAT against this challan is payable through central registration. Thank you for your
                                business!</p>
                        </div>
                        <a href="javascript:void(0);">
                            <img src="assets/img/barcode/barcode-03.jpg" alt="Barcode">
                        </a>
                        <p class="text-dark fw-bold">Sale 31</p>
                        <p>Thank You For Shopping With Us. Please Come Again</p>
                        <a href="javascript:void(0);" class="btn btn-md btn-primary">Print Receipt</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Print Receipt -->

    <!-- Products -->
    <div class="modal fade modal-default pos-modal" id="products" aria-labelledby="products">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <h5 class="me-4">Products</h5>
                    </div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card bg-light mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap mb-3">
                                <span class="badge bg-dark fs-12">Order ID : #45698</span>
                                <p class="fs-16">Number of Products : 02</p>
                            </div>
                            <div class="product-wrap h-auto">
                                <div class="product-list bg-white align-items-center justify-content-between">
                                    <div class="d-flex align-items-center product-info" data-bs-toggle="modal"
                                        data-bs-target="#products">
                                        <a href="javascript:void(0);" class="pro-img">
                                            <img src="assets/img/products/pos-product-16.png" alt="Products">
                                        </a>
                                        <div class="info">
                                            <h6><a href="javascript:void(0);">Red Nike Laser</a></h6>
                                            <p>Quantity : 04</p>
                                        </div>
                                    </div>
                                    <p class="text-teal fw-bold">$2000</p>
                                </div>
                                <div class="product-list bg-white align-items-center justify-content-between">
                                    <div class="d-flex align-items-center product-info" data-bs-toggle="modal"
                                        data-bs-target="#products">
                                        <a href="javascript:void(0);" class="pro-img">
                                            <img src="assets/img/products/pos-product-17.png" alt="Products">
                                        </a>
                                        <div class="info">
                                            <h6><a href="javascript:void(0);">Iphone 11S</a></h6>
                                            <p>Quantity : 04</p>
                                        </div>
                                    </div>
                                    <p class="text-teal fw-bold">$3000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Products -->

    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="create" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="https://dreamspos.dreamstechnologies.com/html/template/pos-2.html">
                    <div class="modal-body pb-1">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end gap-2 flex-wrap">
                        <button type="button" class="btn btn-md btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-md btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Hold -->
    <div class="modal fade modal-default pos-modal" id="hold-order" aria-labelledby="hold-order">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hold order</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="https://dreamspos.dreamstechnologies.com/html/template/pos-2.html">
                    <div class="modal-body">
                        <div class="bg-light br-10 p-4 text-center mb-3">
                            <h2 class="display-1">4500.00</h2>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Order Reference <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" value="" placeholder="">
                        </div>
                        <p>The current order will be set on hold. You can retreive this order from the pending order
                            button. Providing a reference to it might help you to identify the order more quickly.</p>
                    </div>
                    <div class="modal-footer d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-md btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-md btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Hold -->

    <!-- Edit Product -->
    <div class="modal fade modal-default pos-modal" id="edit-product" aria-labelledby="edit-product">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Product</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="https://dreamspos.dreamstechnologies.com/html/template/pos-2.html">
                    <div class="modal-body pb-1">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="Red Nike Laser Show" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Product Price <span class="text-danger">*</span></label>
                                    <div class="input-icon-start position-relative">
                                        <span class="input-icon-addon text-gray-9">
                                            <i class="ti ti-currency-dollar"></i>
                                        </span>
                                        <input type="text" class="form-control" value="1800">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Tax Type <span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Exclusive</option>
                                        <option>Inclusive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Tax <span class="text-danger">*</span></label>
                                    <div class="input-icon-start position-relative">
                                        <span class="input-icon-addon text-gray-9">
                                            <i class="ti ti-percentage"></i>
                                        </span>
                                        <input type="text" class="form-control" value="15">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Discount Type <span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Percentage</option>
                                        <option>Early payment discounts</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Discount <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="15">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Sale Unit <span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Kilogram</option>
                                        <option>Grams</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end flex-wrap gap-2">
                        <button type="button" class="btn btn-md btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-md btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Edit Product -->

    <!-- Delete Product -->
    <div class="modal fade modal-default" id="delete" aria-labelledby="payment-completed">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="success-wrap text-center">
                        <form action="https://dreamspos.dreamstechnologies.com/html/template/pos-2.html">
                            <div class="icon-success bg-danger-transparent text-danger mb-2">
                                <i class="ti ti-trash"></i>
                            </div>
                            <h3 class="mb-2">Are you Sure!</h3>
                            <p class="fs-16 mb-3">The current order will be deleted as no payment has been made so far.
                            </p>
                            <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap">
                                <button type="button" class="btn btn-md btn-secondary" data-bs-dismiss="modal">No,
                                    Cancel</button>
                                <button type="submit" class="btn btn-md btn-primary">Yes, Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Product -->

    <!-- Reset -->
    <div class="modal fade modal-default" id="reset" aria-labelledby="payment-completed">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="success-wrap text-center">
                        <form action="https://dreamspos.dreamstechnologies.com/html/template/pos-2.html">
                            <div class="icon-success bg-purple-transparent text-purple mb-2">
                                <i class="ti ti-transition-top"></i>
                            </div>
                            <h3 class="mb-2">Confirm Your Action</h3>
                            <p class="fs-16 mb-3">The current order will be cleared. But not deleted if it's persistent.
                                Would you like to proceed ?</p>
                            <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap">
                                <button type="button" class="btn btn-md btn-secondary" data-bs-dismiss="modal">No,
                                    Cancel</button>
                                <button type="submit" class="btn btn-md btn-primary">Yes, Proceed</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Reset -->

    <!-- Recent Transactions -->
    <div class="modal fade pos-modal" id="recents" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recent Transactions</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tabs-sets">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="purchase-tab" data-bs-toggle="tab"
                                    data-bs-target="#purchase" type="button" aria-controls="purchase"
                                    aria-selected="true" role="tab">Purchase</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment"
                                    type="button" aria-controls="payment" aria-selected="false"
                                    role="tab">Payment</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="return-tab" data-bs-toggle="tab" data-bs-target="#return"
                                    type="button" aria-controls="return" aria-selected="false"
                                    role="tab">Return</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="purchase" role="tabpanel"
                                aria-labelledby="purchase-tab">
                                <div class="card mb-0">
                                    <div
                                        class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                        <div class="search-set">
                                            <div class="search-input">
                                                <span class="btn-searchset"><i
                                                        class="ti ti-search fs-14 feather-search"></i></span>
                                            </div>
                                        </div>
                                        <ul class="table-top-head">
                                            <li>
                                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
                                                        src="assets/img/icons/pdf.svg" alt="img"></a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
                                                        src="assets/img/icons/excel.svg" alt="img"></a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i
                                                        class="ti ti-printer"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table datatable border">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th class="no-sort">
                                                            <label class="checkboxs">
                                                                <input type="checkbox" class="select-all">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </th>
                                                        <th>Customer</th>
                                                        <th>Reference</th>
                                                        <th>Date</th>
                                                        <th>Amount </th>
                                                        <th class="no-sort">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-27.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Carl Evans</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0101</td>
                                                        <td>24 Dec 2024</td>
                                                        <td>$1000</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-02.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Minerva Rameriz</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0102</td>
                                                        <td>10 Dec 2024</td>
                                                        <td>$1500</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-05.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Robert Lamon</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0103</td>
                                                        <td>27 Nov 2024</td>
                                                        <td>$1500</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-22.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Patricia Lewis</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0104</td>
                                                        <td>18 Nov 2024</td>
                                                        <td>$2000</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-03.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Mark Joslyn</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0105</td>
                                                        <td>06 Nov 2024</td>
                                                        <td>$800</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-12.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Marsha Betts</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0106</td>
                                                        <td>25 Oct 2024</td>
                                                        <td>$750</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-06.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Daniel Jude</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0107</td>
                                                        <td>14 Oct 2024</td>
                                                        <td>$1300</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="payment" role="tabpanel">
                                <div class="card mb-0">
                                    <div
                                        class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                        <div class="search-set">
                                            <div class="search-input">
                                                <span class="btn-searchset"><i
                                                        class="ti ti-search fs-14 feather-search"></i></span>
                                            </div>
                                        </div>
                                        <ul class="table-top-head">
                                            <li>
                                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
                                                        src="assets/img/icons/pdf.svg" alt="img"></a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
                                                        src="assets/img/icons/excel.svg" alt="img"></a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i
                                                        class="ti ti-printer"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table datatable border">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th class="no-sort">
                                                            <label class="checkboxs">
                                                                <input type="checkbox" class="select-all">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </th>
                                                        <th>Customer</th>
                                                        <th>Reference</th>
                                                        <th>Date</th>
                                                        <th>Amount </th>
                                                        <th class="no-sort">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-27.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Carl Evans</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0101</td>
                                                        <td>24 Dec 2024</td>
                                                        <td>$1000</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-02.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Minerva Rameriz</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0102</td>
                                                        <td>10 Dec 2024</td>
                                                        <td>$1500</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-05.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Robert Lamon</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0103</td>
                                                        <td>27 Nov 2024</td>
                                                        <td>$1500</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-22.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Patricia Lewis</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0104</td>
                                                        <td>18 Nov 2024</td>
                                                        <td>$2000</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-03.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Mark Joslyn</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0105</td>
                                                        <td>06 Nov 2024</td>
                                                        <td>$800</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-12.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Marsha Betts</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0106</td>
                                                        <td>25 Oct 2024</td>
                                                        <td>$750</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-06.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Daniel Jude</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0107</td>
                                                        <td>14 Oct 2024</td>
                                                        <td>$1300</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="return" role="tabpanel">
                                <div class="card mb-0">
                                    <div
                                        class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                                        <div class="search-set">
                                            <div class="search-input">
                                                <span class="btn-searchset"><i
                                                        class="ti ti-search fs-14 feather-search"></i></span>
                                            </div>
                                        </div>
                                        <ul class="table-top-head">
                                            <li>
                                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"><img
                                                        src="assets/img/icons/pdf.svg" alt="img"></a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"><img
                                                        src="assets/img/icons/excel.svg" alt="img"></a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i
                                                        class="ti ti-printer"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class=" table-responsive">
                                            <table class="table datatable border">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th class="no-sort">
                                                            <label class="checkboxs">
                                                                <input type="checkbox" class="select-all">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </th>
                                                        <th>Customer</th>
                                                        <th>Reference</th>
                                                        <th>Date</th>
                                                        <th>Amount </th>
                                                        <th class="no-sort">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-27.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Carl Evans</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0101</td>
                                                        <td>24 Dec 2024</td>
                                                        <td>$1000</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-02.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Minerva Rameriz</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0102</td>
                                                        <td>10 Dec 2024</td>
                                                        <td>$1500</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-05.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Robert Lamon</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0103</td>
                                                        <td>27 Nov 2024</td>
                                                        <td>$1500</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-22.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Patricia Lewis</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0104</td>
                                                        <td>18 Nov 2024</td>
                                                        <td>$2000</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-03.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Mark Joslyn</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0105</td>
                                                        <td>06 Nov 2024</td>
                                                        <td>$800</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-12.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Marsha Betts</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0106</td>
                                                        <td>25 Oct 2024</td>
                                                        <td>$750</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <label class="checkboxs">
                                                                <input type="checkbox">
                                                                <span class="checkmarks"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);"
                                                                    class="avatar avatar-md me-2">
                                                                    <img src="assets/img/users/user-06.jpg"
                                                                        alt="product">
                                                                </a>
                                                                <a href="javascript:void(0);">Daniel Jude</a>
                                                            </div>
                                                        </td>
                                                        <td>INV/SL0107</td>
                                                        <td>14 Oct 2024</td>
                                                        <td>$1300</td>
                                                        <td class="action-table-data">
                                                            <div class="edit-delete-action">
                                                                <a class="me-2 edit-icon p-2"
                                                                    href="javascript:void(0);"><i data-feather="eye"
                                                                        class="feather-eye"></i></a>
                                                                <a class="me-2 p-2" href="javascript:void(0);"><i
                                                                        data-feather="edit"
                                                                        class="feather-edit"></i></a>
                                                                <a class="p-2" href="javascript:void(0);"><i
                                                                        data-feather="trash-2"
                                                                        class="feather-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Recent Transactions -->

    <!-- Orders -->
    <div class="modal fade pos-modal" id="orders" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Orders</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tabs-sets">
                        <ul class="nav nav-tabs" id="myTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="onhold-tab" data-bs-toggle="tab"
                                    data-bs-target="#onhold" type="button" aria-controls="onhold" aria-selected="true"
                                    role="tab">Onhold</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="unpaid-tab" data-bs-toggle="tab" data-bs-target="#unpaid"
                                    type="button" aria-controls="unpaid" aria-selected="false"
                                    role="tab">Unpaid</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="paid-tab" data-bs-toggle="tab" data-bs-target="#paid"
                                    type="button" aria-controls="paid" aria-selected="false" role="tab">Paid</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="onhold" role="tabpanel"
                                aria-labelledby="onhold-tab">
                                <div class="input-icon-start pos-search position-relative mb-3">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-search"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Search Product">
                                </div>
                                <div class="order-body">
                                    <div class="card bg-light mb-3">
                                        <div class="card-body">
                                            <span class="badge bg-dark fs-12 mb-2">Order ID : #45698</span>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <p class="fs-15 mb-1"><span
                                                            class="fs-14 fw-bold text-gray-9">Cashier :</span> admin</p>
                                                    <p class="fs-15"><span class="fs-14 fw-bold text-gray-9">Total
                                                            :</span> $900</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="fs-15 mb-1"><span
                                                            class="fs-14 fw-bold text-gray-9">Customer :</span> Botsford
                                                    </p>
                                                    <p class="fs-15"><span class="fs-14 fw-bold text-gray-9">Date
                                                            :</span> 24 Dec 2024 13:39:11</p>
                                                </div>
                                            </div>
                                            <div class="bg-info-transparent p-1 rounded text-center my-3">
                                                <p class="text-info fw-medium">Customer need to recheck the product once
                                                </p>
                                            </div>
                                            <div
                                                class="d-flex align-items-center justify-content-center flex-wrap gap-2">
                                                <a href="javascript:void(0);" class="btn btn-md btn-orange">Open
                                                    Order</a>
                                                <a href="javascript:void(0);" class="btn btn-md btn-teal"
                                                    data-bs-dismiss="modal" data-bs-toggle="modal"
                                                    data-bs-target="#products">View Products</a>
                                                <a href="javascript:void(0);" class="btn btn-md btn-indigo">Print</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card bg-light mb-0">
                                        <div class="card-body">
                                            <span class="badge bg-dark fs-12 mb-2">Order ID : #666659</span>
                                            <div class="mb-3">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <p class="fs-15 mb-1"><span
                                                                class="fs-14 fw-bold text-gray-9">Cashier :</span> admin
                                                        </p>
                                                        <p class="fs-15"><span class="fs-14 fw-bold text-gray-9">Total
                                                                :</span> $900</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p class="fs-15 mb-1"><span
                                                                class="fs-14 fw-bold text-gray-9">Customer :</span>
                                                            Botsford</p>
                                                        <p class="fs-15"><span class="fs-14 fw-bold text-gray-9">Date
                                                                :</span> 24 Dec 2024 13:39:11</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="unpaid" role="tabpanel">
                                <div class="input-icon-start pos-search position-relative mb-3">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-search"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Search Product">
                                </div>
                                <div class="order-body">
                                    <div class="card bg-light mb-3">
                                        <div class="card-body">
                                            <span class="badge bg-dark fs-12 mb-2">Order ID : #45698</span>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <p class="fs-15 mb-1"><span
                                                            class="fs-14 fw-bold text-gray-9">Cashier :</span> admin</p>
                                                    <p class="fs-15"><span class="fs-14 fw-bold text-gray-9">Total
                                                            :</span> $900</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="fs-15 mb-1"><span
                                                            class="fs-14 fw-bold text-gray-9">Customer :</span>
                                                        Anastasia</p>
                                                    <p class="fs-15"><span class="fs-14 fw-bold text-gray-9">Date
                                                            :</span> 24 Dec 2024 13:39:11</p>
                                                </div>
                                            </div>
                                            <div class="bg-info-transparent p-1 rounded text-center my-3">
                                                <p class="text-info fw-medium">Customer need to recheck the product once
                                                </p>
                                            </div>
                                            <div
                                                class="d-flex align-items-center justify-content-center flex-wrap gap-2">
                                                <a href="javascript:void(0);" class="btn btn-md btn-orange">Open
                                                    Order</a>
                                                <a href="javascript:void(0);" class="btn btn-md btn-teal"
                                                    data-bs-dismiss="modal" data-bs-toggle="modal"
                                                    data-bs-target="#products">View Products</a>
                                                <a href="javascript:void(0);" class="btn btn-md btn-indigo">Print</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card bg-light mb-0">
                                        <div class="card-body">
                                            <span class="badge bg-dark fs-12 mb-2">Order ID : #666659</span>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <p class="fs-15 mb-1"><span
                                                            class="fs-14 fw-bold text-gray-9">Cashier :</span> admin</p>
                                                    <p class="fs-15"><span class="fs-14 fw-bold text-gray-9">Total
                                                            :</span> $900</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="fs-15 mb-1"><span
                                                            class="fs-14 fw-bold text-gray-9">Customer :</span> Lucia
                                                    </p>
                                                    <p class="fs-15"><span class="fs-14 fw-bold text-gray-9">Date
                                                            :</span> 24 Dec 2024 13:39:11</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="paid" role="tabpanel">
                                <div class="input-icon-start pos-search position-relative mb-3">
                                    <span class="input-icon-addon">
                                        <i class="ti ti-search"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Search Product">
                                </div>
                                <div class="order-body">
                                    <div class="card bg-light mb-3">
                                        <div class="card-body">
                                            <span class="badge bg-dark fs-12 mb-2">Order ID : #45698</span>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <p class="fs-15 mb-1"><span
                                                            class="fs-14 fw-bold text-gray-9">Cashier :</span> admin</p>
                                                    <p class="fs-15"><span class="fs-14 fw-bold text-gray-9">Total
                                                            :</span> $1000</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="fs-15 mb-1"><span
                                                            class="fs-14 fw-bold text-gray-9">Customer :</span> Hugo</p>
                                                    <p class="fs-15"><span class="fs-14 fw-bold text-gray-9">Date
                                                            :</span> 24 Dec 2024 13:39:11</p>
                                                </div>
                                            </div>
                                            <div class="bg-info-transparent p-1 rounded text-center my-3">
                                                <p class="text-info fw-medium">Customer need to recheck the product once
                                                </p>
                                            </div>
                                            <div
                                                class="d-flex align-items-center justify-content-center flex-wrap gap-2">
                                                <a href="javascript:void(0);" class="btn btn-md btn-orange">Open
                                                    Order</a>
                                                <a href="javascript:void(0);" class="btn btn-md btn-teal"
                                                    data-bs-dismiss="modal" data-bs-toggle="modal"
                                                    data-bs-target="#products">View Products</a>
                                                <a href="javascript:void(0);" class="btn btn-md btn-indigo">Print</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card bg-light mb-0">
                                        <div class="card-body">
                                            <span class="badge bg-dark fs-12 mb-2">Order ID : #666659</span>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <p class="fs-15 mb-1"><span
                                                            class="fs-14 fw-bold text-gray-9">Cashier :</span> admin</p>
                                                    <p class="fs-15"><span class="fs-14 fw-bold text-gray-9">Total
                                                            :</span> $9100</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="fs-15 mb-1"><span
                                                            class="fs-14 fw-bold text-gray-9">Customer :</span> Antonio
                                                    </p>
                                                    <p class="fs-15"><span class="fs-14 fw-bold text-gray-9">Date
                                                            :</span> 23 Dec 2024 13:39:11</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Orders -->

    <!-- Scan -->
    <div class="modal fade modal-default" id="scan-payment">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <div class="success-wrap scan-wrap text-center">
                        <h5><span class="text-gray-6">Amount to Pay :</span> $150</h5>
                        <div class="scan-img">
                            <img src="assets/img/icons/scan-img.svg" alt="img">
                        </div>
                        <p class="mb-3">Scan your Phone or UPI App to Complete the payment</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Scan -->

    <!-- Payment Cash -->
    <div class="modal fade modal-default" id="payment-cash">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Finalize Sale</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="https://dreamspos.dreamstechnologies.com/html/template/pos-2.html">
                    <div class="modal-body pb-1">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Received Amount <span class="text-danger">*</span></label>
                                    <div class="input-icon-start position-relative">
                                        <span class="input-icon-addon text-gray-9">
                                            <i class="ti ti-currency-dollar"></i>
                                        </span>
                                        <input type="text" class="form-control" value="1800">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Paying Amount <span class="text-danger">*</span></label>
                                    <div class="input-icon-start position-relative">
                                        <span class="input-icon-addon text-gray-9">
                                            <i class="ti ti-currency-dollar"></i>
                                        </span>
                                        <input type="text" class="form-control" value="1800">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="change-item mb-3">
                                    <label class="form-label">Change</label>
                                    <div class="input-icon-start position-relative">
                                        <span class="input-icon-addon text-gray-9">
                                            <i class="ti ti-currency-dollar"></i>
                                        </span>
                                        <input type="text" class="form-control" value="0.00">
                                    </div>
                                </div>
                                <div class="point-item mb-3">
                                    <label class="form-label">Balance Point</label>
                                    <input type="text" class="form-control" value="200">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Payment Type <span class="text-danger">*</span></label>
                                    <select class="select select-payment">
                                        <option value="credit">Credit Card</option>
                                        <option value="cash" selected>Cash</option>
                                        <option value="cheque">Cheque</option>
                                        <option value="deposit">Deposit</option>
                                        <option value="points">Points</option>
                                    </select>
                                </div>
                                <div class="quick-cash payment-content bg-light  mb-3">
                                    <div class="d-flex align-items-center flex-wra gap-4">
                                        <h5 class="text-nowrap">Quick Cash</h5>
                                        <div class="d-flex align-items-center flex-wrap gap-3">
                                            <div class="form-check">
                                                <input type="radio" class="btn-check" name="cash" id="cash21" checked>
                                                <label class="btn btn-white" for="cash21">10</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="btn-check" name="cash" id="cash22">
                                                <label class="btn btn-white" for="cash22">20</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="btn-check" name="cash" id="cash23">
                                                <label class="btn btn-white" for="cash23">50</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="btn-check" name="cash" id="cash24">
                                                <label class="btn btn-white" for="cash24">100</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="btn-check" name="cash" id="cash25">
                                                <label class="btn btn-white" for="cash25">500</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="btn-check" name="cash" id="cash26">
                                                <label class="btn btn-white" for="cash26">1000</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="point-wrap payment-content mb-3">
                                    <div
                                        class=" bg-success-transparent d-flex align-items-center justify-content-between flex-wrap p-2 gap-2 br-5">
                                        <h6 class="fs-14 fw-bold text-success">You have 2000 Points to Use</h6>
                                        <a href="javascript:void(0);" class="btn btn-dark btn-md">Use for this
                                            Purchase</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Payment Receiver</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Payment Note</label>
                                    <textarea class="form-control" rows="3" placeholder="Type your message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Sale Note</label>
                                    <textarea class="form-control" rows="3" placeholder="Type your message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Staff Note</label>
                                    <textarea class="form-control" rows="3" placeholder="Type your message"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end flex-wrap gap-2">
                        <button type="button" class="btn btn-md btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-md btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Payment Cash  -->

    <!-- Payment Card  -->
    <div class="modal fade modal-default" id="payment-card">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Finalize Sale</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="https://dreamspos.dreamstechnologies.com/html/template/pos-2.html">
                    <div class="modal-body pb-1">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Received Amount <span class="text-danger">*</span></label>
                                    <div class="input-icon-start position-relative">
                                        <span class="input-icon-addon text-gray-9">
                                            <i class="ti ti-currency-dollar"></i>
                                        </span>
                                        <input type="text" class="form-control" value="1800">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Paying Amount <span class="text-danger">*</span></label>
                                    <div class="input-icon-start position-relative">
                                        <span class="input-icon-addon text-gray-9">
                                            <i class="ti ti-currency-dollar"></i>
                                        </span>
                                        <input type="text" class="form-control" value="1800">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="change-item mb-3">
                                    <label class="form-label">Change</label>
                                    <div class="input-icon-start position-relative">
                                        <span class="input-icon-addon text-gray-9">
                                            <i class="ti ti-currency-dollar"></i>
                                        </span>
                                        <input type="text" class="form-control" value="0.00">
                                    </div>
                                </div>
                                <div class="point-item mb-3">
                                    <label class="form-label">Balance Point</label>
                                    <input type="text" class="form-control" value="200">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Payment Type <span class="text-danger">*</span></label>
                                    <select class="select select-payment">
                                        <option value="credit" selected>Credit Card</option>
                                        <option value="cash">Cash</option>
                                        <option value="cheque">Cheque</option>
                                        <option value="deposit">Deposit</option>
                                        <option value="points">Points</option>
                                    </select>
                                </div>
                                <div class="quick-cash payment-content bg-light  mb-3">
                                    <div class="d-flex align-items-center flex-wra gap-4">
                                        <h5 class="text-nowrap">Quick Cash</h5>
                                        <div class="d-flex align-items-center flex-wrap gap-3">
                                            <div class="form-check">
                                                <input type="radio" class="btn-check" name="cash" id="cash11" checked>
                                                <label class="btn btn-white" for="cash11">10</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="btn-check" name="cash" id="cash12">
                                                <label class="btn btn-white" for="cash12">20</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="btn-check" name="cash" id="cash13">
                                                <label class="btn btn-white" for="cash13">50</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="btn-check" name="cash" id="cash14">
                                                <label class="btn btn-white" for="cash14">100</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="btn-check" name="cash" id="cash15">
                                                <label class="btn btn-white" for="cash15">500</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="btn-check" name="cash" id="cash16">
                                                <label class="btn btn-white" for="cash16">1000</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="point-wrap payment-content mb-3">
                                    <div
                                        class=" bg-success-transparent d-flex align-items-center justify-content-between flex-wrap p-2 gap-2 br-5">
                                        <h6 class="fs-14 fw-bold text-success">You have 2000 Points to Use</h6>
                                        <a href="javascript:void(0);" class="btn btn-dark btn-md">Use for this
                                            Purchase</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Payment Receiver</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Payment Note</label>
                                    <textarea class="form-control" rows="3" placeholder="Type your message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Sale Note</label>
                                    <textarea class="form-control" rows="3" placeholder="Type your message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Staff Note</label>
                                    <textarea class="form-control" rows="3" placeholder="Type your message"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end flex-wrap gap-2">
                        <button type="button" class="btn btn-md btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-md btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Payment Card  -->

    <!-- Calculator -->
    <div class="modal fade pos-modal" id="calculator" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="calculator-wrap">
                        <div class="p-3">
                            <div class="d-flex align-items-center">
                                <h3>Calculator</h3>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div>
                                <input class="input" type="text" placeholder="0" readonly>
                            </div>
                        </div>
                        <div class="calculator-body d-flex justify-content-between">
                            <div class="text-center">
                                <button class="btn btn-clear"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; clr()"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">C</button>
                                <button class="btn btn-number"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; dis('7')"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">7</button>
                                <button class="btn btn-number"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; dis('4')"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">4</button>
                                <button class="btn btn-number"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; dis('1')"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">1</button>
                                <button class="btn btn-number"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; dis(',')"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">,</button>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-expression"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; dis('https://dreamspos.dreamstechnologies.com/')"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">÷</button>
                                <button class="btn btn-number"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; dis('8')"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">8</button>
                                <button class="btn btn-number"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; dis('5')"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">5</button>
                                <button class="btn btn-number"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; dis('2')"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">2</button>
                                <button class="btn btn-number"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; dis('00')"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">00</button>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-expression"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; dis('%')"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">%</button>
                                <button class="btn btn-number"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; dis('9')"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">9</button>
                                <button class="btn btn-number"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; dis('6')"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">6</button>
                                <button class="btn btn-number"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; dis('3')"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">3</button>
                                <button class="btn btn-number"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; dis('.')"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">.</button>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-clear"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; back()"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-=""><i
                                        class="ti ti-backspace"></i></button>
                                <button class="btn btn-expression"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; dis('*')"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">x</button>
                                <button class="btn btn-expression"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; dis('-')"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">-</button>
                                <button class="btn btn-expression"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; dis('+')"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">+</button>
                                <button class="btn btn-clear"
                                    onclick="if (!window.__cfRLUnblockHandlers) return false; solve()"
                                    data-cf-modified-6fb0f1fc2c444bd5344d6718-="">=</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Calculator -->

    <!-- Cash Register Details -->
    <div class="modal fade pos-modal" id="cash-register" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cash Register Details</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped border">
                            <tr>
                                <td>Cash in Hand</td>
                                <td class="text-gray-9 fw-medium text-end">$45689</td>
                            </tr>
                            <tr>
                                <td>Total Sale Amount</td>
                                <td class="text-gray-9 fw-medium text-end">$565597.88</td>
                            </tr>
                            <tr>
                                <td>Total Payment</td>
                                <td class="text-gray-9 fw-medium text-end">$566867.97</td>
                            </tr>
                            <tr>
                                <td>Cash Payment</td>
                                <td class="text-gray-9 fw-medium text-end">$3355.84</td>
                            </tr>
                            <tr>
                                <td>Total Sale Return</td>
                                <td class="text-gray-9 fw-medium text-end">$1959</td>
                            </tr>
                            <tr>
                                <td>Total Expense</td>
                                <td class="text-gray-9 fw-medium text-end">$0</td>
                            </tr>
                            <tr>
                                <td class="text-gray-9 fw-bold bg-secondary-transparent">Total Cash</td>
                                <td class="text-gray-9 fw-bold text-end bg-secondary-transparent">$587130.97</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-end gap-2 flex-wrap">
                    <button type="button" class="btn btn-md btn-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Cash Register Details -->

    <!-- Today's Sale -->
    <div class="modal fade pos-modal" id="today-sale" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Today's Sale</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped border">
                            <tr>
                                <td>Total Sale Amount</td>
                                <td class="text-gray-9 fw-medium text-end">$565597.88</td>
                            </tr>
                            <tr>
                                <td>Cash Payment</td>
                                <td class="text-gray-9 fw-medium text-end">$3355.84</td>
                            </tr>
                            <tr>
                                <td>Credit Card Payment</td>
                                <td class="text-gray-9 fw-medium text-end">$1959</td>
                            </tr>
                            <tr>
                                <td>Cheque Payment:</td>
                                <td class="text-gray-9 fw-medium text-end">$0</td>
                            </tr>
                            <tr>
                                <td>Deposit Payment</td>
                                <td class="text-gray-9 fw-medium text-end">$565597.88</td>
                            </tr>
                            <tr>
                                <td>Points Payment</td>
                                <td class="text-gray-9 fw-medium text-end">$3355.84</td>
                            </tr>
                            <tr>
                                <td>Gift Card Payment</td>
                                <td class="text-gray-9 fw-medium text-end">$565597.88</td>
                            </tr>
                            <tr>
                                <td>Scan & Pay</td>
                                <td class="text-gray-9 fw-medium text-end">$3355.84</td>
                            </tr>
                            <tr>
                                <td>Pay Later</td>
                                <td class="text-gray-9 fw-medium text-end">$3355.84</td>
                            </tr>
                            <tr>
                                <td>Total Payment</td>
                                <td class="text-gray-9 fw-medium text-end">$565597.88</td>
                            </tr>
                            <tr>
                                <td>Total Sale Return</td>
                                <td class="text-gray-9 fw-medium text-end">$565597.88</td>
                            </tr>
                            <tr>
                                <td>Total Expense:</td>
                                <td class="text-gray-9 fw-medium text-end">$565597.88</td>
                            </tr>
                            <tr>
                                <td class="text-gray-9 fw-bold bg-secondary-transparent">Total Cash</td>
                                <td class="text-gray-9 fw-bold text-end bg-secondary-transparent">$587130.97</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-end gap-2 flex-wrap">
                    <button type="button" class="btn btn-md btn-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Today's Sale -->

    <!-- Today's Profit -->
    <div class="modal fade pos-modal" id="today-profit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Today's Profit</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center g-3 mb-3">
                        <div class="col-lg-4 col-md-6 d-flex">
                            <div class="border border-success bg-success-transparent br-8 p-3 flex-fill">
                                <p class="fs-16 text-gray-9 mb-1">Total Sale</p>
                                <h3 class="text-success">$89954</h3>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">
                            <div class="border border-danger bg-danger-transparent br-8 p-3 flex-fill">
                                <p class="fs-16 text-gray-9 mb-1">Expense</p>
                                <h3 class="text-danger">$89954</h3>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 d-flex">
                            <div class="border border-info bg-info-transparent br-8 p-3 flex-fill">
                                <p class="fs-16 text-gray-9 mb-1">Total Profit </p>
                                <h3 class="text-info">$2145</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped border">
                            <tr>
                                <td>Product Revenue</td>
                                <td class="text-gray-9 fw-medium text-end">$565597.88</td>
                            </tr>
                            <tr>
                                <td>Product Cost</td>
                                <td class="text-gray-9 fw-medium text-end">$3355.84</td>
                            </tr>
                            <tr>
                                <td>Expense</td>
                                <td class="text-gray-9 fw-medium text-end">$1959</td>
                            </tr>
                            <tr>
                                <td>Total Stock Adjustment</td>
                                <td class="text-gray-9 fw-medium text-end">$0</td>
                            </tr>
                            <tr>
                                <td>Deposit Payment</td>
                                <td class="text-gray-9 fw-medium text-end">$565597.88</td>
                            </tr>
                            <tr>
                                <td>Total Purchase Shipping Cost</td>
                                <td class="text-gray-9 fw-medium text-end">$3355.84</td>
                            </tr>
                            <tr>
                                <td>Total Sell Discount</td>
                                <td class="text-gray-9 fw-medium text-end">$565597.88</td>
                            </tr>
                            <tr>
                                <td>Total Sell Return</td>
                                <td class="text-gray-9 fw-medium text-end">$3355.84</td>
                            </tr>
                            <tr>
                                <td>Closing Stock</td>
                                <td class="text-gray-9 fw-medium text-end">$3355.84</td>
                            </tr>
                            <tr>
                                <td>Total Sales</td>
                                <td class="text-gray-9 fw-medium text-end">$565597.88</td>
                            </tr>
                            <tr>
                                <td>Total Sale Return</td>
                                <td class="text-gray-9 fw-medium text-end">$565597.88</td>
                            </tr>
                            <tr>
                                <td>Total Expense</td>
                                <td class="text-gray-9 fw-medium text-end">$565597.88</td>
                            </tr>
                            <tr>
                                <td class="text-gray-9 fw-bold bg-secondary-transparent">Total Cash</td>
                                <td class="text-gray-9 fw-bold text-end bg-secondary-transparent">$587130.97</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-end gap-2 flex-wrap">
                    <button type="button" class="btn btn-md btn-primary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Today's Profit -->

   @include('admin.layout.script')

</body>

</html>