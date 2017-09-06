@extends('includes.user-template')
	@section('content')
		@include('includes/breadcrumbs')
			<!-- START CONTAINER -->
			@include('includes/flash-message')
			<div class="container-widget">
<<<<<<< HEAD
				<a href="<?php echo url('user/overtime'); ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back to list</a>
=======
				<a href="/user/overtime" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back to list</a>
>>>>>>> b42320356f7f99679c074c7317143e6e872a9658
					<p></p>
					<div class="panel panel-default">
						<div class="panel-title">
						  <ul class="panel-tools">
							<li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
						  </ul>
						</div>
						<div class="panel-body">		
<<<<<<< HEAD
							<form class="validate-user" action="<?php echo url('user/process/request-overtime'); ?>" method="POST">
=======
							<form class="validate-user" action="/user/process/request-overtime" method="POST">
>>>>>>> b42320356f7f99679c074c7317143e6e872a9658
								{{ method_field('PUT') }}
								{{ csrf_field() }} 								
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Field</th>
											<th>Value</th>
										</tr>
									</thead>
									<tr>
										<td><label class="control-label form-label">Date(s) Affected : </label></td>
										<td><input value="" class="form-control" name="date_affected" type="date" required /></td>
									</tr>
									<tr>
										<td><label class="control-label form-label">Hours : </label></td>
										<td><input placeholder="Hours" class="form-control" name="hours" type="number" required /></td>
									</tr>
									<tr>
										<td><label class="control-label form-label">Client(s) Involved: </label></td>
										<td><input placeholder="Client(s) Involved" class="form-control" name="client" type="text" required /></td>
									</tr>
									<tr>
										<td><label class="control-label form-label">Reasons : </label></td>
										<td><textarea placeholder="Reasons..." name="reasons" class="form-control"></textarea></td>
									</tr>
									<tr>
										<td></td>
										<td><button class="btn btn-primary">Save</button></td>
									</tr>
								</table>
							</form>
						</div>
					</div>
					
			</div>
			<!-- END CONTAINER -->
			<!-- //////////////////////////////////////////////////////////////////////////// -->
		@stop
		