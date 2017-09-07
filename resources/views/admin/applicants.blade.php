@extends('includes.admin-template')
	@section('content')
		@include('includes/breadcrumbs')
			<!-- START CONTAINER -->
			@include('includes/flash-message')
			<form id="DeleteApplicant" action="<?php echo url('admin/applicant/delete'); ?>" method="POST">
				{{ method_field('DELETE') }}
				{{ csrf_field() }} 
				<div class="dropdown">
					<button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-cog"></i> Action
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
						<li role="presentation"><a target="_blank" role="menuitem" tabindex="-1" href="<?php echo url('application-form/generate-key'); ?>">Go to Application Form</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo url('application-form/restrict-key'); ?>">Restrict Application Form</a></li>
						<li role="presentation"><a class="delete" data-form="#DeleteApplicant" role="menuitem" href="#">Delete</a></li>
					</ul>
				</div><br/>
				<div class="container-widget">
					<div class="panel panel-default">
						<div class="panel-title">
						  <ul class="panel-tools">
							<li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
						  </ul>
						</div> 
						<div class="panel-body">
							<table class="table display dataTable">
								<thead>
									<tr  class="no-sort">
										<th><div class="checkbox"><input type="checkbox" id="check_all"/><label for="check_all"></label></div></th>
										<th>#</th>
										<th>Name</th>
										<th>Contact Number</th>
										<th>Email address</th>
										<th>Birthday</th>
										<th>Date Applied</th>
										<th>Position</th>
										<th>Asking Salary</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$ctr = 1;
										foreach($applicants as $applicant){
											echo '
											<tr>
												<td style="text-align: left; padding-left: 18px;"><div class="checkbox"><input value="'.$applicant->personal_info_id.'" type="checkbox" name="applicant_id[]" id="applicant_id_'.$ctr.'"/><label for="applicant_id_'.$ctr.'"></label></div></td>
												<td width=50px>'.$ctr.'</td>
												<td>'.$applicant->fname.' '.$applicant->mname.' '.$applicant->lname.'</td>
												<td>'.$applicant->contact_number.'</td>
												<td>'.$applicant->email_address.'</td>
												<td>'.date('M d, Y',strtotime($applicant->birthday)).'</td> 
												<td>'.date('M d, Y',strtotime($applicant->created_at)).'</td>
												<td>'.$applicant->job_title.'</td>		
												<td>'.$applicant->salary.'</td>													
												<td align="right">
													<a href="'.url("admin/edit/applicant").'/'.$applicant->personal_info_id.'" class="modal-settings btn btn-xs btn-primary" href="#"><i class="fa fa-pencil"></i> Edit</a>
												</td>	 
											</tr>
											';
											$ctr++;
										}
									?>
								</tbody>
								<tfoot>
									<tr class="no-sort">
										<th><div class="checkbox"><input type="checkbox" id="check_all"/><label for="check_all"></label></div></th>
										<th>#</th>
										<th>Name</th>
										<th>Contact Number</th>
										<th>Email address</th>
										<th>Birthday</th>
										<th>Date Applied</th>
										<th>Job Title</th>
										<th>Asking Salary</th>
										<th class="text-right">Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</form>
			

			<!-- END CONTAINER -->
			<!-- //////////////////////////////////////////////////////////////////////////// -->
		@stop
		 