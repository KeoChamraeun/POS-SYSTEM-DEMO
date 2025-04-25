<!DOCTYPE html>
<html lang="en" data-layout-mode="light_mode">
@include('admin.layout.head')

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        @include('admin.layout.header')
        <!-- /Header -->

        <!-- Sidebar -->
        @include('admin.layout.sidebar')
        <!-- /Sidebar -->



        <div class="page-wrapper">
            <div class="content">

                @yield('content')

            </div>
            <div
                class="copyright-footer d-flex align-items-center justify-content-between border-top bg-white gap-3 flex-wrap">
                <p class="fs-13 text-gray-9 mb-0">2016 - {{ date('Y') }} &copy; {{ site_settings()->site_name }}. All
                    Right Reserved</p>
                <p>Designed & Developed By <a href="https://nebulait.com" target="_blank" class="link-primary">Nebula
                        IT</a></p>
            </div>
        </div>

    </div>
    <!-- /Main Wrapper -->
    @include('admin.layout.script')
</body>

</html>

</html>
