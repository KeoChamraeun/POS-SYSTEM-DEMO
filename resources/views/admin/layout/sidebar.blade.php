<div class="sidebar" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo active">
        <a href="{{ route('dashboard') }}" class="logo logo-normal">
            <img src="https://nebulaitbd.com/frontend/assets/images/logo.png" alt="Img">
        </a>
        <a href="{{ route('dashboard') }}" class="logo logo-white">
            <img src="https://nebulaitbd.com/frontend/assets/images/logo-white.svg" alt="Img">
        </a>
        <a href="{{ route('dashboard') }}" class="logo-small">
            <img src="https://nebulaitbd.com/frontend/assets/images/favicon.png" alt="Img">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
            <i data-feather="chevrons-left" class="feather-16"></i>
        </a>
    </div>
    <!-- /Logo -->


    <div class="sidebar-header p-3 pb-0 pt-2">
        <div class="text-center rounded bg-light p-2 mb-4 sidebar-profile d-flex align-items-center">
            <div class="avatar avatar-md onlin">
                <img src="{{ asset('backend/assets/img/customer/customer15.jpg') }}" alt="Img"
                    class="img-fluid rounded-circle">
            </div>
            <div class="text-start sidebar-profile-info ms-2">
                <h6 class="fs-14 fw-bold mb-1">{{ Auth::user()->name }}</h6>
                <p class="fs-12">{{ Auth::user()->role }}</p>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between menu-item mb-3">
            <div>
                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-icon bg-light">
                    <i class="ti ti-layout-grid-remove"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Main</h6>
                    <ul>
                        <li class=" {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}" class="active">
                                <i class="ti ti-layout-grid fs-16 me-2"></i><span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Inventory</h6>
                    <ul>
                        <li class=" {{ request()->routeIs('category.index') ? 'active' : '' }}">
                            <a href="{{ route('category.index') }}">
                                <i class="ti ti-list-details fs-16 me-2"></i><span>Category</span>
                            </a>
                        </li>
                        <li class=" {{ request()->routeIs('menu.index') ? 'active' : '' }}">
                            <a href="{{ route('menu.index') }}">
                                <i class="ti ti-tools-kitchen-2 fs-16 me-2"></i><span>Menu</span>
                            </a>
                        </li>
                        <li class=" {{ request()->routeIs('menu.item.index') ? 'active' : '' }}">
                            <a href="{{ route('menu.item.index') }}">
                                <i class="ti ti-tools-kitchen fs-16 me-2"></i><span>Menu Item</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="submenu-open">
                    <h6 class="submenu-hdr">Sales</h6>
                    <ul>
                        <li class=" {{ request()->routeIs('invoice.index') ? 'active' : '' }}">
                            <a href="{{ route('invoice.index') }}">
                                <i class="ti ti-file-invoice fs-16 me-2"></i><span>Invoices</span>
                            </a>
                        </li>
                        <li class=" {{ request()->routeIs('pos') ? 'active' : '' }}">
                            <a href="{{ route('pos') }}">
                                <i class="ti ti-device-laptop fs-16 me-2"></i><span>POS</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="submenu-open">
                    <h6 class="submenu-hdr">Expense</h6>
                    <ul>
                        <li class=" {{ request()->routeIs('expense.head.index') ? 'active' : '' }}">
                            <a href="{{ route('expense.head.index') }}">
                                <i class="ti ti-list-details fs-16 me-2"></i><span>Expense Head</span>
                            </a>
                        </li>
                        <li class=" {{ request()->routeIs('expense.index') ? 'active' : '' }}">
                            <a href="{{ route('expense.index') }}">
                                <i class="ti ti-file-text fs-16 me-2"></i><span>Expense</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="submenu-open">
                    <h6 class="submenu-hdr">Peoples</h6>
                    <ul>
                        <li class=" {{ request()->routeIs('customer.index') ? 'active' : '' }}">
                            <a href="{{ route('customer.index') }}">
                                <i class="ti ti-users-group fs-16 me-2"></i><span>Customers</span>
                            </a>
                        </li>
                        <li class=" {{ request()->routeIs('supplier.index') ? 'active' : '' }}">
                            <a href="{{ route('supplier.index') }}"><i
                                    class="ti ti-user-dollar fs-16 me-2"></i><span>Suppliers</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="submenu-open">
                    <h6 class="submenu-hdr">Settings</h6>
                    <ul>
                        <li class=" {{ request()->routeIs('vat.index') ? 'active' : '' }}">
                            <a href="{{ route('vat.index') }}"><i class="ti ti-chart-dots-2 fs-16 me-2"></i><span>VAT
                                    Settings</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>