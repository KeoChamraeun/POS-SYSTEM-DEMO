
@include('admin.layout.head')

<body>
    <div id="global-loader">
		<div class="whirly-loader"> </div>
	</div>
	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
		@include('admin.layout.header')
		<!-- /Header -->

		<!-- Sidebar -->
		@include('admin.layout.sidebar')
		<!-- /Sidebar -->

		<div class="page-wrapper">
			@yield('content')
			
            @include('admin.layout.footer')
		</div>

	</div>
	<!-- /Main Wrapper -->

    @include('admin.layout.script')
</body>

</html>