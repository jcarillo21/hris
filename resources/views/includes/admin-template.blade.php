@include('includes.admin.admin-header')
@include('includes.top')
@include('includes.admin.sidebar')
    <div class="content">
		@yield('content')
		@include('includes.admin.admin-foot')
    </div>
@include('includes.admin.admin-footer')