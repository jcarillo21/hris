@extends('includes.admin-template')
	@section('content')
		@include('includes/breadcrumbs')
			@include('includes/flash-message')
			<div class="container-widget">
				<a href="<?php echo url('admin/leaves'); ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back to list</a>
					<p></p>
					<div class="panel panel-default">
						<div class="panel-title">
						  <ul class="panel-tools">
							<li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
						  </ul>
						</div>
						<div class="panel-body">
							<form class="validate-admin" action="<?php echo url('admin/process/edit-leave'); ?>" method="POST">
								{{ method_field('PUT') }}
								{{ csrf_field() }}
								<input type="hidden" name="user_id" value="<?php echo $leave->personal_info_id; ?>" />
								<input type="hidden" name="leave_id" value="<?php echo $leave->leave_id; ?>" />
								<input type="hidden" name="reviewed_by" value="<?php echo $pid; ?>" />
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Field</th>
											<th>Value</th>
										</tr>
									</thead>
									<tr>
										<td><label class="control-label form-label">Name : </label></td>
										<td>
											<p><?php echo $leave->firstname.' '.$leave->lastname; ?></p>
										</td>
									</tr>
									<tr>
										<td><label class="control-label form-label">Date(s) Affected : </label></td>
										<td>
											<div class="container-fluid">
												<div class="row">
													<div class="col-md-6">
														<label>From : </label>
														<input type="date" class="form-control" name="from" value="<?php echo $leave->from; ?>"/>												
													</div>
													<div class="col-md-6">
														<label>To : </label>
														<input type="date" class="form-control" name="to" value="<?php echo $leave->to; ?>"/>												
													</div>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<label class="control-label form-label">Leave Type : </label>
										</td>
										<td>
											<select name="leave_type" class="selectpicker">
												<option value="<?php echo $leave->leave_type; ?>">
												<?php
													if($leave->leave_type == "SL"){
														echo 'Sick Leave (SL)';
													}else if($leave->leave_type == "VL"){
														echo 'Vacation Leave (VL)';
													}
													else if($leave->leave_type == "EL"){
														echo 'Emergency Leave (EL)';
													}
												?>
												</option>
												<option disabled>----</option>
												<option value="SL">Sick Leave (SL)</option>
												<option value="VL">Vacation Leave (VL)</option>
												<option value="EL">Emergency Leave (EL)</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><label class="control-label form-label">Reasons : </label></td>
										<td><textarea name="reasons" class="form-control"><?php echo addslashes($leave->reasons); ?></textarea></td>
									</tr>
									<tr>
										<td><label class="control-label form-label">Status : </label></td>
										<td>
											<div class="radio radio-info radio-block">
												<input <?php if($leave->status == 0) echo 'checked';?> type="radio" id="pending" value="0" name="status">
												<label for="pending"> Pending </label>
											</div>
											<div class="radio radio-info radio-block">
												<input  <?php if($leave->status == 2) echo 'checked';?> type="radio" id="disapprove" value="2" name="status">
												<label for="disapprove"> Disapprove </label>
											</div>
											<div class="radio radio-info radio-block">
												<input <?php if($leave->status == 1) echo 'checked';?> type="radio" id="approve" value="1" name="status">
												<label for="approve"> Approve </label>
											</div>
										</td>
									</tr>		
									<tr>
										<td><label class="control-label form-label">File Attachment : </label></td>
										<td><a target="_target" class="btn-xs btn btn-default" href="<?php echo $leave->file_attachment; ?>"> View File</a></td>
									</tr>	
									<tr>
										<td><label class="control-label form-label">Reviewed By : </label></td>
										<td><?php echo $leave->rfname.' '.$leave->rlname; ?></td>
									</tr>	
									<tr>
										<td></td>
										<td>
											<button class="btn btn-primary"> Save</button>
										</td>
									</tr>									
								</table>
							</form>
						</div>
					</div>
			</div>
		@stop
		