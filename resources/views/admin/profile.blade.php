@extends('includes.admin-template')
	@section('content')
		@include('includes/breadcrumbs')
			@include('includes/flash-message')
			<div class="container-widget">
				<div class="panel panel-default">
					<div class="panel-title">
					  <ul class="panel-tools">
						<li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
					  </ul>
					</div>
					<div class="panel-body">
						<div class="social-profile">
							<div class="social-top">
							  <div class="profile-left">
								<?php
									if($profile->display_pic==null){
										$dp = 'default.png';
									}else{
										$dp = $profile->display_pic;
									}
								?>
								<img src="<?php echo url('/img/'.$dp.''); ?>" alt="Profile Picture" title="Profile Picture" class="profile-img">
								<h1 class="name"><?php echo $profile->fname.' '.$profile->lname; ?></h1>
								<p class="profile-text">My profile</p>
							  </div>
								<ul class="social-stats">
								  <li><b><?php echo $count; ?></b>Files</li>
								</ul>
							</div>
							<div class="social-content clearfix">
							  <div class="col-md-8 col-lg-7">
								  <div class="panel panel-default">
									<h3>Personal Information</h3>
									<form id="edit-profile" class="validate form-horizontal" action="<?php echo url('admin/process/edit-profile'); ?>" method="post" >
										{{ method_field('PUT') }}
										{{ csrf_field() }} 		
										<input name="personal_info_id" value="<?php echo $profile->personal_info_id; ?>" type="hidden" />										
										<div class="form-group">
										  <div class="col-sm-4">
											<label class="control-label form-label">Lastname</label>
											<input value="<?php echo $profile->lname; ?>" placeholder="Lastname" type="text" class="form-control" id="lname" name="lname" required  />
										  </div>
										  <div class="col-sm-4">
											<label class="control-label form-label">Firstname</label>
											<input value="<?php echo $profile->fname; ?>" placeholder="Firstname"  type="text" class="form-control" id="fname" name="fname" required />
										  </div>
										  <div class="col-sm-4">
											<label class="control-label form-label">Middlename</label>
											<input value="<?php echo $profile->mname; ?>" placeholder="Middlename"  type="text" class="form-control" id="mname" name="mname" required />
										  </div>
										</div>
										
										<div class="form-group">
										  <div class="col-sm-4">
											<label class="control-label form-label">Email Address</label>
											<input value="<?php echo $profile->email_address; ?>" placeholder="Email" type="email" class="form-control" id="email" name="email"required  />
										  </div>
										  <div class="col-sm-4">
											<label class="control-label form-label">Contact Number</label>
											<input value="<?php echo $profile->contact_number; ?>" placeholder="Contact #"  type="text" class="form-control" id="contact" name="contact"required  />
										  </div>
										  <div class="col-sm-4">
											<label class="control-label form-label">Birthday</label>
											<input value="<?php echo $profile->birthday; ?>" type="date" class="form-control" id="bday" name="bday" />
										  </div>
										</div>
										<div class="form-group">
										  <div class="col-sm-12">
										   <label class="control-label form-label">Address</label>
										   <input value="<?php echo $profile->address; ?>"  placeholder="Address" type="address" class="form-control" id="address" name="address" required  />
										  </div>
										</div>											
										<hr/>
										
										<div class="form-group">

										  <div class="col-sm-4">
											<label class="control-label form-label">Civil Status</label><br/>
											<select name="cstatus" class="selectpicker" >
												<option value="<?php echo $profile->civil_status; ?>" selected><?php echo $profile->civil_status; ?></option>
												<option disabled>----</option>
												<?php
													foreach($helper->civil_status() as $text => $value){
														echo '<option value="'.$value.'">'.$text.'</option>';
													}
												?>	
											</select>
										  </div>
										  <div class="col-sm-4">
											<label class="control-label form-label">User Role</label><br/>
											<select name="user_role" class="selectpicker" required >
												<option value="<?php echo $profile->user_role; ?>" selected><?php echo $profile->user_role; ?></option>
												<option disabled>----</option>
												<?php
													foreach($helper->system_role() as $text => $value){
														echo '<option value="'.$value.'">'.$text.'</option>';
													}
												?>	
											</select>
										  </div>
										  <div class="col-sm-4">
											<label class="control-label form-label">Employment Status</label><br/>
											<select name="employment_status" class="selectpicker" required >
												<option value="<?php echo $profile->employment_status; ?>" selected><?php echo $profile->employment_status; ?></option>
												<option disabled>----</option>
												<?php
													foreach($helper->employment_status() as $text => $value){
														echo '<option value="'.$value.'">'.$text.'</option>';
													}
												?>	
											</select>
										  </div>			
										</div>
										
										<div class="form-group">
										
										  <div class="col-sm-4">
											   <label class="control-label form-label">Department</label><br/>
												<select id="department" name="department" class="selectpicker" required >
													<option value="0" selected>--Select--</option>
													<?php
													foreach($departments as $department){
														$selected = $department->department_id == $profile->department_id ? 'selected' : '';
														echo '<option '.$selected.' value="'.$department->department_id.'">'.$department->department_name.'</option>';
													}
													?>
												</select>
										  </div>
										  <div class="col-sm-4">
											<label class="control-label form-label">Job Title</label><br/>
												<select name="job_title" class="selectpicker" required >
													<option value="0" selected >--Select--</option>
													<?php
													foreach($jobs as $job){
														$selected = $job->job_id == $profile->job_id ? 'selected' : '';
														echo '<option '.$selected.' value="'.$job->job_id.'">'.$job->job_title.'</option>';
													}
													?>
												</select>
										  </div>
										  <div class="col-sm-4">
											<label class="control-label form-label">Salary</label>
											<input value="<?php echo $profile->salary; ?>" type="text" class="form-control" id="salary" name="salary" />
										  </div>

										</div>
										<div class="form-group">
										  <div class="col-sm-4">
											<label class="control-label form-label">Employee #</label><br/>
											<p><?php echo $profile->employee_id; ?></p>
										  </div>
										  <div class="col-sm-4">
											   <label class="control-label form-label">Gender</label><br/>
												<div class="radio radio-info radio-inline">
													<input <?php  echo $profile->gender == 'Male' ? 'checked' : '' ; ?> type="radio" id="gender-male" value="Male" name="gender"  />
													<label for="gender-male"> Male </label>
												</div>
												<div class="radio radio-info radio-inline">
													<input <?php  echo $profile->gender == 'Female' ? 'checked' : '' ; ?> type="radio" id="gender-female" value="Female" name="gender" />
													<label for="gender-female"> Female</label>
												</div>
										  </div>	
											  
										</div>	
										<hr/>
										<div class="form-group">
										  <div class="col-sm-12 text-right">
											<button type="submit" class="btn btn-default">Save Profile</button>
										  </div>
										</div>
									</form>
								  </div>
							  </div>
							  <div class="col-md-4 col-lg-5">
								  <div class="panel panel-default">
									<h3>Login Information</h3>
									<form id="edit-login" class="form-horizontal" action="<?php echo url('admin/process/edit-login'); ?>" method="post" >
										{{ method_field('PUT') }}
										{{ csrf_field() }} 								
										<input name="personal_info_id" value="<?php echo $profile->personal_info_id; ?>" type="hidden" />
										<div class="form-group">
											<div class="col-sm-6">
												<label class="control-label form-label">Username</label><br/>
												<input readonly value="<?php echo $profile->username; ?>" placeholder="Username"  type="text" class="form-control" id="username" name="username" required />
											</div>	
											<div class="col-sm-6">
												<label class="control-label form-label">System Role</label><br/>
												<select name="system_role" class="selectpicker" required >
													<option value="<?php echo $profile->role; ?>" selected><?php echo ucfirst($profile->role); ?></option>
													<option disabled>----</option>
													<?php
														foreach($helper->system_role() as $text => $value){
															echo '<option value="'.$value.'">'.$text.'</option>';
														}
													?>	
												</select>	
											</div>												  
											<div class="col-sm-6">
												<label class="control-label form-label">New Password</label><br/>
												<input placeholder="Password"  type="password" class="form-control" id="password" name="password"  />
											</div>
											<div class="col-sm-6">
												<label class="control-label form-label">Confirm New Password</label><br/>
												<input placeholder="Confirm Password"  type="password" class="form-control" id="confirm_password" name="confirm_password"  />
											</div>
									
										</div>
										<hr/>
										<div class="form-group">
										  <div class="col-sm-12 text-right">
											<button type="submit" class="btn btn-default">Save Login</button>
										  </div>
										</div>
									</form>
								  </div>

								  <div class="panel panel-default">
									<h3>Statutories</h3>
									<form id="edit-statutories" class="form-horizontal" action="<?php echo url('admin/process/edit-statutories'); ?>" method="post" >
										{{ method_field('PUT') }}
										{{ csrf_field() }} 								
										<input name="personal_info_id" value="<?php echo $profile->personal_info_id; ?>" type="hidden" />
										<div class="form-group">
											<div class="col-sm-6">
												<label class="control-label form-label">SSS #</label><br/>
												<input  placeholder="SSS #" value="<?php echo $profile->sss; ?>" type="text" class="form-control" id="sss" name="sss" />
											</div>	
											<div class="col-sm-6">
												<label class="control-label form-label">PAGIBIG #</label><br/>
												<input  placeholder="PAGIBIG #" value="<?php echo $profile->pagibig; ?>" type="text" class="form-control" id="pagibig" name="pagibig" />
											</div>												  
											<div class="col-sm-6">
												<label class="control-label form-label">PHILHEALTH #</label><br/>
												<input placeholder="PHILHEALTH #"  value="<?php echo $profile->philhealth; ?>" type="text" class="form-control" id="philhealth" name="philhealth"  />
											</div>
											<div class="col-sm-6">
												<label class="control-label form-label">TIN #</label><br/>
												<input placeholder="TIN #"  value="<?php echo $profile->tin; ?>" type="text" class="form-control" id="tin" name="tin"  />
											</div>
									
										</div>
										<hr/>
										<div class="form-group">
										  <div class="col-sm-12 text-right">
											<button type="submit" class="btn btn-default">Save Info</button>
										  </div>
										</div>
									</form>
								  </div>								  
								  
							  </div>
							</div>
						</div>		
					</div>
				</div>
			</div>
		@stop
		 