<div class="header">
    <div class="main-header">
        <!-- Logo -->
        <div class="header-left active">
            <a href="{{ route('dashboard') }}" class="logo logo-normal">
                <img src="https://nebulaitbd.com/frontend/assets/images/logo.png" alt="Img">
            </a>
            <a href="{{ route('dashboard') }}" class="logo logo-white">
                <img src="https://nebulaitbd.com/frontend/assets/images/logo-white.svg" alt="Img">
            </a>
            <a href="{{ route('dashboard') }}" class="logo-small">
                <img src="https://nebulaitbd.com/frontend/assets/images/logo-small.png" alt="Img">
            </a>
        </div>
        <!-- /Logo -->
        <a id="mobile_btn" class="mobile_btn" href="#sidebar">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>

        <!-- Header Menu -->
        <ul class="nav user-menu">

            <!-- Search -->
            <li class="nav-item nav-searchinputs">
                <div class="top-nav-search">
                    <a href="javascript:void(0);" class="responsive-search">
                        <i class="fa fa-search"></i>
                    </a>
                    <form action="#" class="dropdown">
                        <div class="searchinputs input-group dropdown-toggle" id="dropdownMenuClickable" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                            <input type="text" placeholder="Search">
                            <div class="search-addon">
                                <span><i class="ti ti-search"></i></span>
                            </div>
                            <span class="input-group-text">
                                <kbd class="d-flex align-items-center"><img src="{{ asset('backend/assets/img/icons/command.svg') }}" alt="img" class="me-1">K</kbd>
                            </span>
                        </div>
                        <div class="dropdown-menu search-dropdown" aria-labelledby="dropdownMenuClickable">
                           
                        </div>
                    </form>
                </div>
            </li>
            <!-- /Search -->

          
            <li class="nav-item dropdown link-nav">
                <a href="javascript:void(0);" class="btn btn-primary btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
                    <i class="ti ti-circle-plus me-1"></i>Add New
                </a>
                <div class="dropdown-menu dropdown-xl dropdown-menu-center" style="z-index: 9999 !important;">
                    <div class="row g-2">
                        <div class="col-md-2">
                            <a href="{{ route('category.index') }}" class="link-item">
                                <span class="link-icon">
                                    <i class="ti ti-brand-codepen"></i>
                                </span>
                                <p>Category</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('menu.index') }}" class="link-item">
                                <span class="link-icon">
                                    <i class="ti ti-square-plus"></i>
                                </span>
                                <p>Menu</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('menu.item.index') }}" class="link-item">
                                <span class="link-icon">
                                    <i class="ti ti-square-plus"></i>
                                </span>
                                <p>Menu Item</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="link-item">
                                <span class="link-icon">
                                    <i class="ti ti-shopping-bag"></i>
                                </span>
                                <p>Purchase</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="#" class="link-item">
                                <span class="link-icon">
                                    <i class="ti ti-shopping-cart"></i>
                                </span>
                                <p>Sale</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('expense.index') }}" class="link-item">
                                <span class="link-icon">
                                    <i class="ti ti-file-text"></i>
                                </span>
                                <p>Expense</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('customer.index') }}" class="link-item">
                                <span class="link-icon">
                                    <i class="ti ti-user"></i>
                                </span>
                                <p>User</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('customer.index') }}" class="link-item">
                                <span class="link-icon">
                                    <i class="ti ti-users"></i>
                                </span>
                                <p>Customer</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('supplier.index') }}" class="link-item">
                                <span class="link-icon">
                                    <i class="ti ti-user-check"></i>
                                </span>
                                <p>Supplier</p>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('vat.index') }}" class="link-item">
                                <span class="link-icon">
                                    <i class="ti ti-file-text"></i>
                                </span>
                                <p>VAT</p>
                            </a>
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item pos-nav">
                <a href="{{ route('pos') }}" class="btn btn-dark btn-md d-inline-flex align-items-center">
                    <i class="ti ti-device-laptop me-1"></i>POS
                </a>
            </li>

            <li class="nav-item nav-item-box">
                <a href="javascript:void(0);" id="btnFullscreen">
                    <i class="ti ti-maximize"></i>
                </a>
            </li>
           

            <li class="nav-item nav-item-box">
                <a href="{{ route('dashboard') }}"><i class="ti ti-settings"></i></a>
            </li>
            <li class="nav-item dropdown has-arrow main-drop profile-nav">
                <a href="javascript:void(0);" class="nav-link userset" data-bs-toggle="dropdown">
                    <span class="user-info p-0">
                        <span class="user-letter">
                            <img src="{{ asset( Auth::user()->thumbnail ?? '/backend/assets/img/avatar.png') }}" alt="Img" class="img-fluid">
                        </span>
                    </span>
                </a>
                <div class="dropdown-menu menu-drop-user">
                    <div class="profileset d-flex align-items-center">
                        <span class="user-img me-2">
                            <img src="{{ asset( Auth::user()->thumbnail ?? '/backend/assets/img/avatar.png') }}" alt="Img">
                        </span>
                        <div>
                            <h6 class="fw-medium">{{ Auth::user()->name }}</h6>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    {{-- <a class="dropdown-item" href="profile.html"><i class="ti ti-user-circle me-2"></i>MyProfile</a>
                    <a class="dropdown-item" href="sales-report.html"><i class="ti ti-file-text me-2"></i>Reports</a>
                    <a class="dropdown-item" href="general-settings.html"><i class="ti ti-settings-2 me-2"></i>Settings</a> --}}
                    <hr class="my-2">
                    <a class="dropdown-item logout pb-0" href="{{ route('admin.logout') }}"><i class="ti ti-logout me-2"></i>Logout</a>
                </div>
            </li>
        </ul>
        <!-- /Header Menu -->

        <!-- Mobile Menu -->
        <div class="dropdown mobile-user-menu">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                {{-- <a class="dropdown-item" href="profile.html">My Profile</a>
                <a class="dropdown-item" href="general-settings.html">Settings</a> --}}
                <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
            </div>
        </div>
        <!-- /Mobile Menu -->
    </div>
</div>
