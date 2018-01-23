@include('includes.user.user-header')
@include('includes.user.top-user')
@include('includes.user.sidebar')
    <div class="content">
		@yield('content')
		@include('includes.user.user-foot')
    </div>
@include('includes.user.user-footer')