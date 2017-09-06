@include('includes.user.user-header')
@include('includes.user.top-user')
@include('includes.user.sidebar')
    <!-- START CONTENT -->
    <div class="content">
		@yield('content')
		@include('includes.user.user-foot')
    </div>
    <!-- END CONTENT -->
@include('includes.user.user-footer')