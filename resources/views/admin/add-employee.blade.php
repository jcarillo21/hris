@extends('includes.admin-template')
	@section('content')
		@include('includes/breadcrumbs')
			<!-- START CONTAINER -->
			@include('includes/flash-message')
			<div class="container-widget">
				<a href="<?php echo url('admin/employees'); ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back to list</a>
					<p></p>
					<div class="panel panel-default">
						<div class="panel-title">
						  <ul class="panel-tools">
							<li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
						  </ul>
						</div>
						<div class="panel-body">
							<form id="add-employee" class="validate form-horizontal" action="<?php echo url('admin/process/add-employee'); ?>" method="post">
								{{ method_field('PUT') }}
								{{ csrf_field() }} 								
								<div class="form-group">
								  <div class="col-sm-4">
								    <label class="control-label form-label">Lastname</label>
									<input placeholder="Lastname" type="text" class="form-control" id="lname" name="lname" required  />
								  </div>
								  <div class="col-sm-4">
									<label class="control-label form-label">Firstname</label>
									<input placeholder="Firstname"  type="text" class="form-control" id="fname" name="fname" required />
								  </div>
								  <div class="col-sm-4">
									<label class="control-label form-label">Middlename</label>
									<input placeholder="Middlename"  type="text" class="form-control" id="mname" name="mname" required />
								  </div>
								</div>
								
								<div class="form-group">
								  <div class="col-sm-4">
								   <label class="control-label form-label">Email Address</label>
									<input placeholder="Email" type="email" class="form-control" id="email" name="email"required  />
								  </div>
								  <div class="col-sm-4">
									<label class="control-label form-label">Contact Number</label>
									<input placeholder="Contact #"  type="text" class="form-control" id="contact" name="contact"required  />
								  </div>
								  <div class="col-sm-4">
									<label class="control-label form-label">Birthday</label>
									<input requried type="date" class="form-control" id="bday" name="bday" />
								  </div>
								</div>
								
								<div class="form-group">
								  <div class="col-sm-12">
								   <label class="control-label form-label">Address</label>
								   <input placeholder="Address" type="address" class="form-control" id="address" name="address" required  />
								  </div>
								</div>	
								
								<hr/>
								
								<div class="form-group">

								  <div class="col-sm-4">
									<label class="control-label form-label">Civil Status</label><br/>
									<select name="cstatus" class="selectpicker" required >
										<option disabled>--Select--</option>
										<option value="Single">Single</option>
										<option value="Married">Married</option>
										<option value="Widowed">Widowed</option>
									</select>
								  </div>
								  <div class="col-sm-4">
									<label class="control-label form-label">User Role</label><br/>
									<select name="user_role" class="selectpicker" required >
										<option disabled>--Select--</option>
										<option value="admin">Admin</option>
										<option value="Employee">Employee</option>
										<option value="OJT">OJT</option>
									</select>
								  </div>
								  <div class="col-sm-4">
									<label class="control-label form-label">Employment Status</label><br/>
									<select name="employment_status" class="selectpicker" >
										<option disabled>--Select--</option>
										<option value="Regular">Regular</option>
										<option value="Part-time / Consultant">Part-time / Consultant</option>
										<option value="OJT">OJT</option>
									</select>
								  </div>

								</div>
								
								<div class="form-group">
								
								  <div class="col-sm-4">
									   <label class="control-label form-label">Department</label><br/>
										<select id="department" name="department" class="selectpicker" required >
											<?php
											foreach($departments as $department){
												echo '<option value="'.$department->department_id.'">'.$department->department_name.'</option>';
											}
											?>
										</select>
								  </div>
								  <div class="col-sm-4">
									<label class="control-label form-label">Job Title</label><br/>
										<select name="job_title" class="selectpicker" required >
											<?php
											foreach($jobs as $job){	
												echo '<option  value="'.$job->job_id.'">'.$job->job_title.'</option>';
											}
											?>
										</select>
								  </div>
								  <div class="col-sm-4">
									<label class="control-label form-label">Salary</label>
									<input type="number" class="form-control" id="salary" name="salary" />
								  </div>								  
								  <div class="col-sm-4">
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-6">
											   <label class="control-label form-label">Gender</label><br/>
												<div class="radio radio-info radio-inline">
													<input type="radio" id="gender-male" value="Male" name="gender"  />
													<label for="gender-male"> Male </label>
												</div>
												<div class="radio radio-info radio-inline">
													<input type="radio" id="gender-female" value="Female" name="gender" />
													<label for="gender-female"> Female</label>
												</div>											
											</div>
											<div class="col-md-6">
											   <label class="control-label form-label">Status</label><br/>
												<div class="radio radio-info radio-inline">
													<input type="radio" id="status-enabled" value="1" name="status">
													<label for="status-enabled"> Enabled </label>
												</div>
												<div class="radio radio-info radio-inline">
													<input  type="radio" id="status-disabled" value="0" name="status">
													<label for="status-disabled"> Disabled </label>
												</div>											
											</div>
										</div>
									</div>
								  </div>

								</div>
								<hr/>
								<div class="form-group">
								  
								  <div class="col-sm-6">
									   <label class="control-label form-label">Username</label><br/>
										<input  placeholder="Username"  type="text" class="form-control" id="username" name="username" required />
								  </div>	
								  <div class="col-sm-6">
									   <label class="control-label form-label">System Role</label><br/>
										<select name="system_role" class="selectpicker" required >
										<option disabled>--Select--</option>
										<option value="admin">Admin</option>
										<option value="user">User</option>
										</select>
								  </div>									  
								  <div class="col-sm-6">
									   <label class="control-label form-label">New Password</label><br/>
										<input value="" placeholder="Password"  type="password" class="form-control" id="password" name="password"  />
								  </div>
								  <div class="col-sm-6">
									   <label class="control-label form-label">Confirm New Password</label><br/>
										<input placeholder="Confirm Password"  type="password" class="form-control" id="confirm_password" name="confirm_password"  />
								  </div>
		
								</div>
								
								<hr/>
								<div class="form-group">
								  <div class="col-sm-12 text-right">
									<button type="submit" class="btn btn-default">Submit</button>
								  </div>
								</div>
							</form>
						</div>
					</div>
					
			</div>
			<!-- END CONTAINER -->
			<!-- //////////////////////////////////////////////////////////////////////////// -->
		@stop
		