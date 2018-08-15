@extends('includes.admin-template')
	@section('content')
		<div class="page-header">
            <h1 class="title"><?php echo $employee->fname.' '.$employee->lname?></h1>
            <ol class="breadcrumb">
                <li class="active">Edit Employee</li>
            </ol>
            <div class="right">
                <div class="btn-group" role="group" aria-label="...">
                    <a href="<?php echo url('admin/employees'); ?>" class="btn btn-light">Edit Employees</a>
                    <a onclick="location.reload()" href="#" class="btn btn-light"><i class="fa fa-refresh"></i></a>
                </div>
            </div>
        </div>
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
									<select name="cstatus" class="form-control" >
										<option value="<?php echo $employee->civil_status; ?>" selected><?php echo ucfirst($employee->civil_status); ?></option>
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
									<select name="user_role" class="form-control" required >
										<option value="<?php echo $employee->user_role; ?>" selected><?php echo ucfirst($employee->user_role); ?></option>
										<option disabled>----</option>
										<?php
											foreach($helper->user_role() as $text => $value){
												echo '<option value="'.$value.'">'.$text.'</option>';
											}
										?>	
									</select>
								  </div>
								  <div class="col-sm-4">
									<label class="control-label form-label">Employment Status</label><br/>
									<select name="employment_status" class="form-control" >
										<option value="<?php echo $employee->employment_status; ?>" selected><?php echo ucfirst($employee->employment_status); ?></option>
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
										<select  name="department" class="form-control" required >
											<?php
											foreach($departments as $department){
												 
												$dep_check = ''; 
												if($employee->department_id == $department->department_id){
													$dep_check = 'selected';
												}
												echo '<option '.$dep_check.' value="'.$department->department_id.'">'.$department->department_name.'</option>';
											}
											?>
										</select>
								  </div>
								  <div class="col-sm-4">
										<label class="control-label form-label">Job Title</label><br/>
										<select name="job_title" class="form-control"  >
											<?php
											foreach($jobs as $job){
												$job_check = $employee->job_id == $job->job_id ? 'selected' : '';
												echo '<option '.$job_check.' value="'.$job->job_id.'">'.$job->job_title.'</option>';
											}
											?>
										</select>
								  </div>
								  <div class="col-sm-4">
									<label class="control-label form-label">Salary (Use 0 if N/A)</label>
									<input required value="<?php echo $employee->salary; ?>" type="text" class="form-control" id="salary" name="salary" />
								  </div>								  
								</div>
								
								<div class="form-group">
									<div class="col-sm-3">
										<label class="control-label form-label">SSS #</label><br/>
										<input placeholder="SSS #" value="<?php echo $employee->sss; ?>" type="text" class="form-control" id="sss" name="sss" />
									</div>
									<div class="col-sm-3">
										<label class="control-label form-label">PAGIBIG #</label><br/>
										<input placeholder="PAGIBIG #" value="<?php echo $employee->pagibig; ?>" type="text" class="form-control" id="pagibig" name="pagibig" />
									</div>
									<div class="col-sm-3">
										<label class="control-label form-label">PHILHEALTH #</label><br/>
										<input placeholder="PHILHEALTH #" value="<?php echo $employee->philhealth; ?>" type="text" class="form-control" id="philhealth" name="philhealth" />
									</div>
									<div class="col-sm-3">
										<label class="control-label form-label">TIN #</label><br/>
										<input  placeholder="TIN #" value="<?php echo $employee->tin; ?>" type="text" class="form-control" id="tin" name="tin" />
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-4">
										<label class="control-label form-label">Gender</label><br/>
										<div class="radio radio-info radio-inline">
											<input <?php echo $employee->gender == 'Male' ? 'checked' : ''; ?> type="radio" id="gender-male" value="Male" name="gender"  />
											<label for="gender-male"> Male </label>
										</div>
										<div class="radio radio-info radio-inline">
											<input <?php echo $employee->gender == 'Female' ? 'checked' : ''; ?> type="radio" id="gender-female" value="Female" name="gender" />
											<label for="gender-female"> Female</label>
										</div>	
										<br/>
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
									<div class="col-md-4">
										<label class="control-label form-label">First Day of Work</label><br/>
										<input value="<?php echo $employee->first_day_of_work ?  $employee->first_day_of_work : date('Y-m-d') ; ?>" type="date" class="form-control" id="first_day" name="first_day" />										
									</div>
									<div class="col-md-4">
										<label class="control-label form-label">Employee #</label><br/>
										<input value="<?php echo $employee->employee_id; ?>" type="text" class="form-control" id="employee_id" name="employee_id" />										
									</div>
								</div>
								<hr/>
								<div class="form-group">
									<div class="col-sm-12">
										<h3>Educational Background</h3>
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
									<div class="col-sm-12">
										<h3>Employment Background </h3>
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
									<div class="col-sm-12">
										<h3>References </h3>
										<table class="table-striped table">
											<thead>
												<tr>
													<th>Reference Name</th>
													<th>Reference Position</th>
													<th>Company / Organization / Affiliation</th>
													<th>Contact #</th>
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
									<div class="col-sm-12">
										<h3>User Files </h3>
										<table class="dataTable table table-dic table-hover ">
										<thead>
											<tr>
												<th>File name</th>
												<th>File Type</th>
												<th>File Size</th>
												<th class="text-r">Date Uploaded</th>
												<th class="text-r">Action</th>
											</tr>
										</thead>
										<tbody>
												<?php
													foreach($files as $file){
														$ext = 'File';
														$ico = 'fa-file-o';
														$type = $file->extension;
														if($type == 'png'){ $ext = 'Image'; $ico = 'fa-file-image-o'; }
														if($type == 'jpg'){ $ext = 'Image'; $ico = 'fa-file-image-o'; }
														if($type == 'gif'){ $ext = 'Image'; $ico = 'fa-file-image-o'; }
														if($type == 'pdf'){ $ext = 'PDF';   $ico = 'fa-file-pdf-o'; }
														if($type == 'zip'){ $ext ='WinZip Archieve'; $ico = 'fa-file-zip-o'; }
														if($type == 'rar'){ $ext = 'WinRar Archieve'; $ico = 'fa-file-zip-o'; }
														if($type == 'txt'){ $ext = 'Text'; $ico = 'fa-file-text'; }
														if($type == 'css'){ $ext = 'CSS'; $ico = 'fa-file-code-o'; }
														if($type == 'exe'){ $ext = 'exe'; }
														echo '
														  <tr>
															<td><a target="_blank" href="'.url("files/user/").''.$file->uploaded_by.'/'.$file->file_name.'.'.$file->extension.'"><i class="fa '.$ico.'"></i>'.$file->file_name.'</a></td>
															<td>'.$ext.'</td>
															<td>'.round($file->file_size / 1024).' KB</td>
															<td class="text-r">'.date('m/d/y',strtotime($file->created_at)).'</td>
															<td class="text-r">	
																<a title="Copied!" data-clipboard-text="'.url("files/user").'/'.$file->uploaded_by.'/'.$file->file_name.'.'.$file->extension.'" href="#" class="clip btn btn-xs btn-primary"><i style="color:#fff; font-size:12px;" class="fa fa-copy"></i> Copy Link</a>
															</td>
														  </tr>											
														';
													}
													
												?>
										</tbody>
									</table>         
									</div>
								</div>								
								<div class="form-group">
								  <div class="col-sm-6">
									   <label class="control-label form-label">Username</label><br/>
										<input value="<?php echo $employee->username; ?>" placeholder="Username"  type="text" class="form-control" id="username" name="username" required />
								  </div>	
								  <div class="col-sm-6">
									   <label class="control-label form-label">System Role</label><br/>
										<select name="system_role" class="form-control" required >
										<option value="<?php echo $employee->role; ?>" selected><?php echo ucfirst($employee->role); ?></option>
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
										<input autocomplete="off" value="" placeholder="Password"  type="password" class="form-control" id="password" name="password"  />
								  </div>
								  <div class="col-sm-6">
									   <label class="control-label form-label">Confirm New Password</label><br/>
										<input autocomplete="off" placeholder="Confirm Password"  type="password" class="form-control" id="confirm_password" name="confirm_password"  />
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
		@stop
		