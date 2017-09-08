@extends('includes.user-template')
	@section('content')
		@include('includes/breadcrumbs')
			<!-- START CONTAINER -->
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
							<!-- Start Top -->
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
							<!-- End Top -->
							<!-- Start Social Content -->
							<div class="social-content clearfix">
							  <!-- Start Left -->
							  <div class="col-md-8 col-lg-7">
								<!-- Start Post -->
								  <div class="panel panel-default">
									<h3>Personal Information</h3>
									<form id="edit-profile" class="validate-user-edit form-horizontal" action="<?php echo url('user/process/edit-profile'); ?>" method="post" >
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
											<input value="<?php echo $profile->email_address; ?>" placeholder="Email" type="email" class="form-control" id="email" name="email" required  />
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
												<option >----</option>
												<option value="Single">Single</option>
												<option value="Married">Married</option>
												<option value="Widowed">Widowed</option>
											</select>
										  </div>
										  <div class="col-sm-4">
											<label class="control-label form-label">User Role</label><br/>
											<input readonly value="<?php echo $profile->user_role; ?>"  placeholder="Employment Status" type="text" class="form-control" id="user_role" name="user_role" required readonly />
										  </div>
										  <div class="col-sm-4">
											<label class="control-label form-label">Employment Status</label><br/>
											<input readonly value="<?php echo $profile->employment_status; ?>"  placeholder="Employment Status" type="text" class="form-control" id="employment_status" name="employment_status" required  />
										  </div>			
										</div>
										
										<div class="form-group">
										
										  <div class="col-sm-4">
											   <label class="control-label form-label">Department</label><br/>
											<input  value="<?php echo $departments->department_name; ?>" type="text" class="form-control" id="department_text" name="department_text" readonly  />
											<input  value="<?php echo $profile->department_id; ?>" type="hidden" class="form-control" id="department" name="department" readonly />							
										  </div>
										  <div class="col-sm-4">
											<label class="control-label form-label">Job Title</label><br/>
											<input  value="<?php echo $jobs->job_title; ?>" type="text" class="form-control" id="job_title_text" name="job_title_text" readonly  />
											<input  value="<?php echo $profile->job_id; ?>" type="hidden" class="form-control" id="job_title" name="job_title" readonly />
										  </div>
										  <div class="col-sm-4">
											<label class="control-label form-label">Salary</label>
											<input readonly value="<?php echo $profile->salary; ?>" type="text" class="form-control" id="salary" name="salary" />
										  </div>

										</div>
										<div class="form-group">
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
								<!-- End Post -->
							  </div>
							  <!-- End Left -->
							  <!-- Start Left -->
							  <div class="col-md-4 col-lg-5">
								<!-- Start Post -->
								  <div class="panel panel-default">
									<h3>Login Information</h3>
									<form id="edit-login" class="validate-user-edit form-horizontal" action="<?php echo url('user/process/edit-login'); ?>" method="post" >
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
												<input readonly value="<?php echo ucfirst($profile->role); ?>" placeholder="System Role"  type="text" class="form-control" id="username" name="system_role" required />	
											</div>												  
											<div class="col-sm-6">
												<label class="control-label form-label">New Password</label><br/>
												<input required placeholder="Password"  type="password" class="form-control" id="password" name="password"  />
											</div>
											<div class="col-sm-6">
												<label class="control-label form-label">Confirm New Password</label><br/>
												<input required placeholder="Confirm Password"  type="password" class="form-control" id="confirm_password" name="confirm_password"  />
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
								<!-- End Post -->

							</div>
								<!-- End Left -->

							</div>
							<!-- End Social Content -->
						</div>		
						<div class="social-content">
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<h3>Educational Background</h3><br/>
										<table class="table-striped table">
											<thead>
												<tr>
													<th>School</th>
													<th>From</th>
													<th>To</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach($education as $edu){ 
														echo '
															<tr>
																<td>'.$edu->school_name.'</td>
																<td>'.$edu->from.'</td>
																<td>'.$edu->to.'</td>
															</tr>
														';
													}
												?>
											</tbody>
										</table>										
									</div>		
								</div>
									  
								<div class="col-md-12">
									<div class="panel panel-default">
										<h3>Employment Background</h3><br/>  
										<table class="table-striped table">
											<thead>
												<tr>
													<th>Company name</th>
													<th>Position</th>
													<th>Start</th>
													<th>End</th>
													<th>Reason of leaving</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach($employment as $emp){
														echo '
															<tr>
																<td>'.$emp->company_name.'</td>
																<td>'.$emp->position.'</td>
																<td>'.$emp->from.'</td>
																<td>'.$emp->to.'</td>
																<td>'.$emp->reason_of_leaving.'</td>
															</tr>
														';
													}
												?>
											</tbody>
										</table>										
									</div>	
								</div>
									  
								<div class="col-md-12">
									<div class="panel panel-default">
										<h3>References </h3><br/>
										<table class="table-striped table">
											<thead>
												<tr>
													<th>Reference Name</th>
													<th>Reference Position</th>
													<th>Company / Organization / Affiliation</th>
													<th>Contanct</th>
												</tr>
											</thead>
											<tbody>
												<?php
													foreach($reference as $ref){
														echo '
															<tr>
																<td>'.$ref->name_of_reference.'</td>
																<td>'.$ref->position.'</td>
																<td>'.$ref->company_name.'</td>
																<td>'.$ref->contact_number.'</td>
															</tr>
														';
													}
												?>
											</tbody>
										</table>										
									</div>	
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END CONTAINER -->
			<!-- //////////////////////////////////////////////////////////////////////////// -->
		@stop
		 