@extends('includes.admin-template')
	@section('content')
		@include('includes/breadcrumbs')
			<!-- START CONTAINER -->
			@include('includes/flash-message')
			<div class="container-widget">
				<a href="<?php echo url('admin/overtime'); ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back to list</a>
					<p></p>
					<div class="panel panel-default">
						<div class="panel-title">
						  <ul class="panel-tools">
							<li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
						  </ul>
						</div>
						<div class="panel-body">		
							<form class="validate-admin" action="<?php echo url('admin/process/request-overtime'); ?>" method="POST">
								{{ method_field('PUT') }}
								{{ csrf_field() }} 								
								<input value="<?php echo $pid; ?>" class="form-control" name="reviewed_by" type="hidden" required />
								<input value="<?php echo $overtime->overtime_id; ?>" class="form-control" name="overtime_id" type="hidden" required />
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Field</th>
											<th>Value</th>
										</tr>
									</thead>
									<tr>
										<td><label class="control-label form-label">Name </label></td>
										<td><p><?php echo $overtime->firstname.' '.$overtime->lastname; ?></p></td>
									</tr>									
									<tr>
										<td><label class="control-label form-label">Date(s) Affected : </label></td>
										<td><input value="<?php echo $overtime->date_requested; ?>" class="form-control" name="date_affected" type="date" required /></td>
									</tr>
									<tr>
										<td><label class="control-label form-label">Hours : </label></td>
										<td><input value="<?php echo $overtime->hours; ?>" placeholder="Hours" class="form-control" name="hours" type="number" required /></td>
									</tr>
									<tr>
										<td><label class="control-label form-label">Client(s) Involved: </label></td>
										<td><input value="<?php echo $overtime->client; ?>" placeholder="Client(s) Involved" class="form-control" name="client" type="text" required /></td>
									</tr>
									<tr>
										<td><label class="control-label form-label">Reasons : </label></td>
										<td><textarea placeholder="Reasons..." name="reasons" class="form-control"><?php echo addslashes($overtime->reasons); ?></textarea></td>
									</tr>
									<tr>
										<td><label class="control-label form-label">Status : </label></td>
										<td>
											<div class="radio radio-info radio-block">
												<input <?php if($overtime->status == 0) echo 'checked';?> type="radio" id="pending" value="0" name="status" />
												<label for="pending"> Pending </label>
											</div>
											<div class="radio radio-info radio-block">
												<input <?php if($overtime->status == 1) echo 'checked';?> type="radio" id="approve" value="1" name="status" />
												<label for="approve"> Approve </label>
											</div>
											<div class="radio radio-info radio-block">
												<input <?php if($overtime->status == 2) echo 'checked';?> type="radio" id="disapprove" value="2" name="status" />
												<label for="disapprove"> Disapprove </label>
											</div>
										</td>
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
		