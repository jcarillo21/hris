@include('includes.admin.admin-header')
@include('includes.top')
@include('includes.admin.sidebar')
    <!-- START CONTENT -->
    <div class="content">
		@yield('content')
		@include('includes.admin.admin-foot')
    </div>
    <!-- END CONTENT -->
@include('includes.admin.admin-footer')