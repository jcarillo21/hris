@extends('includes.admin-template')
	@section('content')
		@include('includes/breadcrumbs')
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
							<form class="validate-admin" action="<?php echo url('admin/process/add-overtime'); ?>" method="POST">
								{{ method_field('PUT') }}
								{{ csrf_field() }} 								
								<input value="<?php echo $pid; ?>" class="form-control" name="reviewed_by" type="hidden" required />
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Field</th>
											<th>Value</th>
										</tr>
									</thead>
									<tr>
										<td><label class="control-label form-label">Employee </label></td>
										<td>
											<select name="employee">
												<?php foreach($employees as $employee){ ?>
													<option value="<?php echo $employee->personal_info_id?>"><?php echo $employee->fname.' '.$employee->lname; ?></option>
												<?php } ?>
											</select>
										</td>
									</tr>									
									<tr>
										<td><label class="control-label form-label">Date Affected : </label></td>
										<td><input value="" class="form-control" name="date_affected" type="date" required /></td>
									</tr>
									<tr>
										<td><label class="control-label form-label">Hours : </label></td>
										<td><input value="" placeholder="Hours" class="form-control" name="hours" type="text" required /></td>
									</tr>
									<tr>
										<td><label class="control-label form-label">Client(s) Involved: </label></td>
										<td><input value="" placeholder="Client(s) Involved" class="form-control" name="client" type="text" required /></td>
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
		@stop
		