@include('includes.admin.admin-header')
<style>
	.login-panel{
		background: #fff;
		border-radius: 5px;
		margin-top: 8%;
		max-width: 360px;
		margin:8% auto 0px auto;
	}
</style>
<div class="login-form">
<<<<<<< HEAD
      <form action="<?php echo url('process/signin'); ?>" method="POST">
	   {{ csrf_field() }}
        <div class="top">
          <img src="<?php echo url('img/'.$dp.''); ?>" alt="icon" class="icon profile">
=======
      <form action="/process/signin" method="POST">
	   {{ csrf_field() }}
        <div class="top">
          <img src="img/{{$dp}}" alt="icon" class="icon profile">
>>>>>>> b42320356f7f99679c074c7317143e6e872a9658
          <h1>{{$name}}</h1>
          <h4><i class="fa fa-lock"></i> Locked</h4>
        </div>
		<?php if(count($errors) > 0){ ?>
			<div style="margin:20px;" class="alert alert-danger">
				<div class="form-group margin-none">
					<strong>Oooppps!</strong>
					@foreach ($errors->all() as $error)
						<p>{{ $error }}</p>
					@endforeach
				</div>
			</div>
		<?php } ?>
        <div class="form-area">
          <div class="group">
			<input type="hidden" name="username" value="{{$username}}" class="form-control"  />
            <input type="password" name="password" class="form-control" placeholder="Password" required />
            <i class="fa fa-key"></i>
          </div>
          <button type="submit" class="btn btn-default btn-block">LOGIN</button>
        </div>
      </form>
      <div class="footer-links row">
<<<<<<< HEAD
        <div class="col-xs-6"><a href="<?php echo url('process/logout'); ?>"><i class="fa fa-external-link"></i> Sign-in as different user</a></div>
=======
        <div class="col-xs-6"><a href="/process/logout"><i class="fa fa-external-link"></i> Sign-in as different user</a></div>
>>>>>>> b42320356f7f99679c074c7317143e6e872a9658
        <div class="col-xs-6 text-right"><a href="#"><i class="fa fa-lock"></i> Forgot password</a></div>
      </div>
    </div>
@include('includes.admin.admin-footer')