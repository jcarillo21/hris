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
							<form id="add-jobs" class="form-horizontal" action="<?php echo url('admin/process/edit-job'); ?>" method="post">
								{{ method_field('PUT') }}
								{{ csrf_field() }} 					
								<input type="hidden" name="job_id" value="<?php echo $job->job_id; ?>" />								
								<div class="form-group">
								  <div class="col-sm-6">
								    <label class="control-label form-label">Job Title</label>
									<input value="<?php echo $job->job_title; ?>" type="text" class="form-control" id="job_title" name="job_title" required  />
								  </div>
								  <div class="col-sm-6">
									<label class="control-label form-label">Department</label><br/>
									<select name="department" class="selectpicker" >
										<option selected disabled>--SELECT DEPARTMENT--</option>
										<?php
											foreach($departments as $department){
												$selected = $department->department_id == $job->department_id ? 'selected' : '';
												echo '<option '.$selected.' value="'.$department->department_id.'">'.$department->department_name.'</option>';
											}
										?>
									</select>									
								  </div>
								  <div class="col-sm-12">
									<label class="control-label form-label">Job Description</label>
									<textarea  class="form-control" id="job_desc" name="job_desc"><?php echo $job->job_desc; ?></textarea>
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
		