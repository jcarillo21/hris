@extends('includes.admin-template')
	@section('content')
		<div class="page-header">
            <h1 class="title"><?php echo $employee->fname.' '.$employee->lname?></h1>
            <ol class="breadcrumb">
                <li class="active">Edit Employee</li>
            </ol>
            <!-- Start Page Header Right Div -->
            <div class="right">
                <div class="btn-group" role="group" aria-label="...">
                    <a href="<?php echo url('admin/employees'); ?>" class="btn btn-light">Edit Employees</a>
                    <a onclick="location.reload()" href="#" class="btn btn-light"><i class="fa fa-refresh"></i></a>
                </div>
            </div>
            <!-- End Page Header Right Div -->
        </div>
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
							<form id="edit-employee" class="form-horizontal" action="<?php echo url('admin/process/edit-employee'); ?>" method="post">
								{{ method_field('PUT') }}
								{{ csrf_field() }} 				
								<input name="personal_info_id" value="<?php echo $employee->personal_info_id; ?>" type="hidden"  />								
								<div class="form-group">
								  <div class="col-sm-4">
								    <label class="control-label form-label">Lastname</label>
									<input value="<?php echo $employee->lname; ?>" placeholder="Lastname" type="text" class="form-control" id="lname" name="lname" required  />
								  </div>
								  <div class="col-sm-4">
									<label class="control-label form-label">Firstname</label>
									<input value="<?php echo $employee->fname; ?>" placeholder="Firstname"  type="text" class="form-control" id="fname" name="fname" required />
								  </div>
								  <div class="col-sm-4">
									<label class="control-label form-label">Middlename</label>
									<input value="<?php echo $employee->mname; ?>" placeholder="Middlename"  type="text" class="form-control" id="mname" name="mname" required />
								  </div>
								</div>
								
								<div class="form-group">
								  <div class="col-sm-4">
								   <label class="control-label form-label">Email Address</label>
									<input value="<?php echo $employee->email_address; ?>" placeholder="Email" type="email" class="form-control" id="email" name="email"required  />
								  </div>
								  <div class="col-sm-4">
									<label class="control-label form-label">Contact Number</label>
									<input value="<?php echo $employee->contact_number; ?>" placeholder="Contact #"  type="text" class="form-control" id="contact" name="contact"required  />
								  </div>
								  <div class="col-sm-4">
									<label class="control-label form-label">Birthday</label>
									<input value="<?php echo $employee->birthday; ?>" type="date" class="form-control" id="bday" name="bday" />
								  </div>
								</div>
								
								<div class="form-group">
								  <div class="col-sm-12">
								   <label class="control-label form-label">Address</label>
								   <input value="<?php echo $employee->address; ?>"  placeholder="Address" type="address" class="form-control" id="address" name="address" required  />
								  </div>
								</div>	
								
								<hr/>
								
								<div class="form-group">

								  <div class="col-sm-4">
									<label class="control-label form-label">Civil Status</label><br/>
									<select name="cstatus" class="selectpicker" >
										<option value="<?php echo $employee->civil_status; ?>" selected><?php echo $employee->civil_status; ?></option>
										<option disabled>----</option>
										<option value="Single">Single</option>
										<option value="Married">Married</option>
										<option value="Widowed">Widowed</option>
									</select>
								  </div>
								  <div class="col-sm-4">
									<label class="control-label form-label">User Role</label><br/>
									<select name="user_role" class="selectpicker" required >
										<option value="<?php echo $employee->user_role; ?>" selected><?php echo $employee->user_role; ?></option>
										<option disabled>----</option>
										<option value="admin">Admin</option>
										<option value="Employee">Employee</option>
										<option value="OJT">OJT</option>
									</select>
								  </div>
								  <div class="col-sm-4">
									<label class="control-label form-label">Employment Status</label><br/>
									<select name="employment_status" class="selectpicker" >
										<option value="<?php echo $employee->employment_status; ?>" selected><?php echo $employee->employment_status; ?></option>
										<option disabled>----</option>
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
												$dep_check = $employee->department_id == $department->department_id ? 'selected' : '';
												echo '<option '.$dep_check.' value="'.$department->department_id.'">'.$department->department_name.'</option>';
											}
											?>
										</select>
								  </div>
								  <div class="col-sm-4">
									<label class="control-label form-label">Job Title</label><br/>
										<select name="job_title" class="selectpicker" required >
											<?php
											foreach($jobs as $job){
												$job_check = $employee->job_id == $job->job_id ? 'selected' : '';
												echo '<option '.$job_check.' value="'.$job->job_id.'">'.$job->job_title.'</option>';
											}
											?>
										</select>
								  </div>
								  <div class="col-sm-4">
									<label class="control-label form-label">Salary</label>
									<input value="<?php echo $employee->salary; ?>" type="text" class="form-control" id="salary" name="salary" />
								  </div>								  
								  <div class="col-sm-4">
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-6">
											   <label class="control-label form-label">Gender</label><br/>
												<div class="radio radio-info radio-inline">
													<input <?php echo $employee->gender == 'Male' ? 'checked' : ''; ?> type="radio" id="gender-male" value="Male" name="gender"  />
													<label for="gender-male"> Male </label>
												</div>
												<div class="radio radio-info radio-inline">
													<input <?php echo $employee->gender == 'Female' ? 'checked' : ''; ?> type="radio" id="gender-female" value="Female" name="gender" />
													<label for="gender-female"> Female</label>
												</div>											
											</div>
											<div class="col-md-6">
											   <label class="control-label form-label">Status</label><br/>
												<div class="radio radio-info radio-inline">
													<input <?php echo $employee->status == 1 ? 'checked' : ''; ?> type="radio" id="status-enabled" value="1" name="status">
													<label for="status-enabled"> Enabled </label>
												</div>
												<div class="radio radio-info radio-inline">
													<input <?php echo $employee->status == 0 ? 'checked' : ''; ?> type="radio" id="status-disabled" value="0" name="status">
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
										<input value="<?php echo $employee->username; ?>" placeholder="Username"  type="text" class="form-control" id="username" name="username" required />
								  </div>	
								  <div class="col-sm-6">
									   <label class="control-label form-label">System Role</label><br/>
										<select name="system_role" class="selectpicker" required >
										<option value="<?php echo $employee->role; ?>" selected><?php echo ucfirst($employee->role); ?></option>
										<option disabled>----</option>
										<option value="admin">Admin</option>
										<option value="user">User</option>
										</select>
								  </div>									  
								  <div class="col-sm-6">
									   <label class="control-label form-label">New Password</label><br/>
										<input value="" placeholder="Password"  type="text" class="form-control" id="password" name="password"  />
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
		