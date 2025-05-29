<div class="sidebar" id="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo active">
        <a href="index-2.html" class="logo logo-normal">
            <img src="backend/assets/img/logo.svg" alt="Img">
        </a>
        <a href="index-2.html" class="logo logo-white">
            <img src="backend/assets/img/logo-white.svg" alt="Img">
        </a>
        <a href="index-2.html" class="logo-small">
            <img src="backend/assets/img/logo-small.png" alt="Img">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
            <i data-feather="chevrons-left" class="feather-16"></i>
        </a>
    </div>
    <!-- /Logo -->
    <div class="modern-profile p-3 pb-0">
        <div class="text-center rounded bg-light p-3 mb-4 user-profile">
            <div class="avatar avatar-lg online mb-3">
                <img src="backend/assets/img/customer/customer15.jpg" alt="Img" class="img-fluid rounded-circle">
            </div>
            <h6 class="fs-14 fw-bold mb-1">Adrian Herman</h6>
            <p class="fs-12 mb-0">System Admin</p>
        </div>
        <div class="sidebar-nav mb-3">
            <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified bg-transparent" role="tablist">
                <li class="nav-item"><a class="nav-link active border-0" href="#">Menu</a></li>
                <li class="nav-item"><a class="nav-link border-0" href="chat.html">Chats</a></li>
                <li class="nav-item"><a class="nav-link border-0" href="email.html">Inbox</a></li>
            </ul>
        </div>
    </div>
    <div class="sidebar-header p-3 pb-0 pt-2">
        <div class="text-center rounded bg-light p-2 mb-4 sidebar-profile d-flex align-items-center">
            <div class="avatar avatar-md onlin">
                <img src="backend/assets/img/customer/customer15.jpg" alt="Img" class="img-fluid rounded-circle">
            </div>
            <div class="text-start sidebar-profile-info ms-2">
                <h6 class="fs-14 fw-bold mb-1">Adrian Herman</h6>
                <p class="fs-12">System Admin</p>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between menu-item mb-3">
            <div>
                <a href="index-2.html" class="btn btn-sm btn-icon bg-light">
                    <i class="ti ti-layout-grid-remove"></i>
                </a>
            </div>
            <div>
                <a href="chat.html" class="btn btn-sm btn-icon bg-light">
                    <i class="ti ti-brand-hipchat"></i>
                </a>
            </div>
            <div>
                <a href="email.html" class="btn btn-sm btn-icon bg-light position-relative">
                    <i class="ti ti-message"></i>
                </a>
            </div>
            <div class="notification-item">
                <a href="activities.html" class="btn btn-sm btn-icon bg-light position-relative">
                    <i class="ti ti-bell"></i>
                    <span class="notification-status-dot"></span>
                </a>
            </div>
            <div class="me-0">
                <a href="general-settings.html" class="btn btn-sm btn-icon bg-light">
                    <i class="ti ti-settings"></i>
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
                        <li>
                            <a href="{{ route('dashboard') }}" class="active">
                                <i class="ti ti-layout-grid fs-16 me-2"></i><span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Inventory</h6>
                    <ul>
                        <li>
                            <a href="{{ route('category.index') }}">
                                <i class="ti ti-list-details fs-16 me-2"></i><span>Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('menu.index') }}">
                                <i class="ti ti-list-details fs-16 me-2"></i><span>Menu</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Stock</h6>
                    <ul>
                        <li><a href="manage-stocks.html"><i class="ti ti-stack-3 fs-16 me-2"></i><span>Manage
                                    Stock</span></a></li>
                        <li><a href="stock-adjustment.html"><i class="ti ti-stairs-up fs-16 me-2"></i><span>Stock
                                    Adjustment</span></a></li>
                        <li><a href="stock-transfer.html"><i class="ti ti-stack-pop fs-16 me-2"></i><span>Stock
                                    Transfer</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Sales</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i
                                    class="ti ti-layout-grid fs-16 me-2"></i><span>Sales</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="online-orders.html">Online Orders</a></li>
                                <li><a href="pos-orders.html">POS Orders</a></li>
                            </ul>
                        </li>
                        <li><a href="invoice.html"><i
                                    class="ti ti-file-invoice fs-16 me-2"></i><span>Invoices</span></a></li>
                        <li><a href="sales-returns.html"><i class="ti ti-receipt-refund fs-16 me-2"></i><span>Sales
                                    Return</span></a></li>
                        <li><a href="quotation-list.html"><i
                                    class="ti ti-files fs-16 me-2"></i><span>Quotation</span></a></li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i
                                    class="ti ti-device-laptop fs-16 me-2"></i><span>POS</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="pos.html">POS 1</a></li>
                                <li><a href="pos-2.html">POS 2</a></li>
                                <li><a href="pos-3.html">POS 3</a></li>
                                <li><a href="pos-4.html">POS 4</a></li>
                                <li><a href="pos-5.html">POS 5</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Purchases</h6>
                    <ul>
                        <li><a href="purchase-list.html"><i
                                    class="ti ti-shopping-bag fs-16 me-2"></i><span>Purchases</span></a></li>
                        <li><a href="purchase-order-report.html"><i
                                    class="ti ti-file-unknown fs-16 me-2"></i><span>Purchase Order</span></a></li>
                        <li><a href="purchase-returns.html"><i class="ti ti-file-upload fs-16 me-2"></i><span>Purchase
                                    Return</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Finance & Accounts</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i
                                    class="ti ti-file-stack fs-16 me-2"></i><span>Expenses</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="expense-list.html">Expenses</a></li>
                                <li><a href="expense-category.html">Expense Category</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i
                                    class="ti ti-file-pencil fs-16 me-2"></i><span>Income</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="income.html">Income</a></li>
                                <li><a href="income-category.html">Income Category</a></li>
                            </ul>
                        </li>
                        <li><a href="account-list.html"><i class="ti ti-building-bank fs-16 me-2"></i><span>Bank
                                    Accounts</span></a></li>
                        <li><a href="money-transfer.html"><i class="ti ti-moneybag fs-16 me-2"></i><span>Money
                                    Transfer</span></a></li>
                        <li><a href="balance-sheet.html"><i class="ti ti-report-money fs-16 me-2"></i><span>Balance
                                    Sheet</span></a></li>
                        <li><a href="trial-balance.html"><i class="ti ti-alert-circle fs-16 me-2"></i><span>Trial
                                    Balance</span></a></li>
                        <li><a href="cash-flow.html"><i class="ti ti-zoom-money fs-16 me-2"></i><span>Cash
                                    Flow</span></a></li>
                        <li><a href="account-statement.html"><i
                                    class="ti ti-file-infinity fs-16 me-2"></i><span>Account Statement</span></a></li>

                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Peoples</h6>
                    <ul>
                        <li><a href="customers.html"><i
                                    class="ti ti-users-group fs-16 me-2"></i><span>Customers</span></a></li>
                        <li><a href="billers.html"><i class="ti ti-user-up fs-16 me-2"></i><span>Billers</span></a>
                        </li>
                        <li><a href="suppliers.html"><i
                                    class="ti ti-user-dollar fs-16 me-2"></i><span>Suppliers</span></a></li>
                        <li><a href="store-list.html"><i
                                    class="ti ti-home-bolt fs-16 me-2"></i><span>Stores</span></a></li>
                        <li><a href="warehouse.html"><i
                                    class="ti ti-archive fs-16 me-2"></i><span>Warehouses</span></a>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">HRM</h6>
                    <ul>
                        <li><a href="employees-grid.html"><i
                                    class="ti ti-user fs-16 me-2"></i><span>Employees</span></a></li>
                        <li><a href="department-grid.html"><i
                                    class="ti ti-compass fs-16 me-2"></i><span>Departments</span></a></li>
                        <li><a href="designation.html"><i
                                    class="ti ti-git-merge fs-16 me-2"></i><span>Designation</span></a></li>
                        <li><a href="shift.html"><i
                                    class="ti ti-arrows-shuffle fs-16 me-2"></i><span>Shifts</span></a></li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i
                                    class="ti ti-user-cog fs-16 me-2"></i><span>Attendence</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="attendance-employee.html">Employee</a></li>
                                <li><a href="attendance-admin.html">Admin</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i
                                    class="ti ti-calendar fs-16 me-2"></i><span>Leaves</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="leaves-admin.html">Admin Leaves</a></li>
                                <li><a href="leaves-employee.html">Employee Leaves</a></li>
                                <li><a href="leave-types.html">Leave Types</a></li>
                            </ul>
                        </li>
                        <li><a href="holidays.html"><i
                                    class="ti ti-calendar-share fs-16 me-2"></i><span>Holidays</span></a>
                        </li>
                        <li class="submenu">
                            <a href="employee-salary.html"><i
                                    class="ti ti-file-dollar fs-16 me-2"></i><span>Payroll</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="employee-salary.html">Employee Salary</a></li>
                                <li><a href="payslip.html">Payslip</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">Reports</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="ti ti-chart-bar fs-16 me-2"></i><span>Sales
                                    Report</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="sales-report.html">Sales Report</a></li>
                                <li><a href="best-seller.html">Best Seller</a></li>
                            </ul>
                        </li>
                        <li><a href="purchase-report.html"><i class="ti ti-chart-pie-2 fs-16 me-2"></i><span>Purchase
                                    report</span></a></li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i
                                    class="ti ti-triangle-inverted fs-16 me-2"></i><span>Inventory Report</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="inventory-report.html">Inventory Report</a></li>
                                <li><a href="stock-history.html">Stock History</a></li>
                                <li><a href="sold-stock.html">Sold Stock</a></li>
                            </ul>
                        </li>
                        <li><a href="invoice-report.html"><i class="ti ti-businessplan fs-16 me-2"></i><span>Invoice
                                    Report</span></a></li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="ti ti-user-star fs-16 me-2"></i><span>Supplier
                                    Report</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="supplier-report.html">Supplier Report</a></li>
                                <li><a href="supplier-due-report.html">Supplier Due Report</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="ti ti-report fs-16 me-2"></i><span>Customer
                                    Report</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="customer-report.html">Customer Report</a></li>
                                <li><a href="customer-due-report.html">Customer Due Report</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i
                                    class="ti ti-report-analytics fs-16 me-2"></i><span>Product Report</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="product-report.html">Product Report</a></li>
                                <li><a href="product-expiry-report.html">Product Expiry Report</a></li>
                                <li><a href="product-quantity-alert.html">Product Quantity Alert</a></li>
                            </ul>
                        </li>
                        <li><a href="expense-report.html"><i class="ti ti-file-vector fs-16 me-2"></i><span>Expense
                                    Report</span></a></li>
                        <li><a href="income-report.html"><i class="ti ti-chart-ppf fs-16 me-2"></i><span>Income
                                    Report</span></a></li>
                        <li><a href="tax-reports.html"><i class="ti ti-chart-dots-2 fs-16 me-2"></i><span>Tax
                                    Report</span></a></li>
                        <li><a href="profit-and-loss.html"><i class="ti ti-chart-donut fs-16 me-2"></i><span>Profit &
                                    Loss</span></a></li>
                        <li><a href="annual-report.html"><i class="ti ti-report-search fs-16 me-2"></i><span>Annual
                                    Report</span></a></li>
                    </ul>
                </li>
                <li class="submenu-open">
                    <h6 class="submenu-hdr">User Management</h6>
                    <ul>
                        <li><a href="users.html"><i class="ti ti-shield-up fs-16 me-2"></i><span>Users</span></a></li>
                        <li><a href="roles-permissions.html"><i class="ti ti-jump-rope fs-16 me-2"></i><span>Roles &
                                    Permissions</span></a></li>
                        <li><a href="delete-account.html"><i class="ti ti-trash-x fs-16 me-2"></i><span>Delete Account
                                    Request</span></a></li>
                    </ul>
                </li>

                <li class="submenu-open">
                    <h6 class="submenu-hdr">Settings</h6>
                    <ul>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="ti ti-settings fs-16 me-2"></i><span>General
                                    Settings</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('site.setting.index') }}">Site Settings</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="signin.html"><i class="ti ti-logout fs-16 me-2"></i><span>Logout</span> </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
