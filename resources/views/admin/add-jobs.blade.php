@extends('includes.admin-template')
	@section('content')
		@include('includes/breadcrumbs')
			<!-- START CONTAINER -->
			@include('includes/flash-message')
			<div class="container-widget">
				<a href="<?php echo url('admin/jobs'); ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back to list</a>
					<p></p>
					<div class="panel panel-default">
						<div class="panel-title">
						  <ul class="panel-tools">
							<li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
						  </ul>
						</div>
						<div class="panel-body">
							<form id="add-jobs" class="validate form-horizontal" action="<?php echo url('admin/process/add-job'); ?>" method="post">
								{{ method_field('PUT') }}
								{{ csrf_field() }} 								
								<div class="form-group">
								  <div class="col-sm-6">
								    <label class="control-label form-label">Job Title</label>
									<input placeholder="Job Title" type="text" class="form-control" id="job_title" name="job_title" required  />
								  </div>
								  <div class="col-sm-6">
									<label class="control-label form-label">Department</label><br/>
									<select name="department" class="selectpicker" >
										<option selected disabled>--SELECT DEPARTMENT--</option>
										<?php
											foreach($departments as $department){
												echo '<option value="'.$department->department_id.'">'.$department->department_name.'</option>';
											}
										?>
									</select>									
								  </div>
								  <div class="col-sm-12">
									<label class="control-label form-label">Job Description</label>
									<textarea  class="form-control" id="job_desc" name="job_desc"></textarea>
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
		