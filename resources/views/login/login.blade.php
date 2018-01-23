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
	<div class="login-panel panel panel-default">
        <div class="panel-title">
		<div align="center">
			<img src="<?php echo url('img/'.$logo.'');?>" alt="{{$title}}" title="{{$title}}" />
		</div>
          <ul class="panel-tools">
            <li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
          </ul>
        </div>
		<?php if(count($errors) > 0){ ?>
			<div class="alert alert-danger">
				<div class="form-group margin-none">
					<strong>Oooppps!</strong>
					@foreach ($errors->all() as $error)
						<p>{{ $error }}</p>
					@endforeach
				</div>
			</div>
		<?php } ?>
            <div class="panel-body">
              <form action="<?php echo url('process/login'); ?>" method="POST" >
                <div class="form-group">
					 {{ csrf_field() }}
					<input placeholder="Username" type="text" class="form-control" name="username" id="username" required />
                </div>
                <div class="form-group">
                  <input placeholder="Password" type="password" class="form-control" name="password" id="password" required />
                </div>
				<div class="container-fluid">
					<div class="row">
						<div class="col md-6">
							<div class="checkbox checkbox-primary">
								<input id="remember_me" name="remember_me" type="checkbox" />
								<label for="remember_me">Remember me</label>
							</div>
						</div>
						<div class="col md-12">
							<button type="submit" class="fluid btn btn-default">Login</button><br/>
						</div>

					</div>
               </div>
              </form>
            </div>
      </div>

	  <p>&copy; <?php echo date('Y'); ?> CiceroHR</p>

@include('includes.admin.admin-footer')