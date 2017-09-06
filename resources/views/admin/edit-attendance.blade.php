@extends('includes.admin-template')
	@section('content')
		<div class="page-header">
            <h1 class="title"><?php echo $attendance->fname.' '.$attendance->lname?></h1>
            <ol class="breadcrumb">
                <li class="active">Edit Attendance</li>
            </ol>

            <!-- Start Page Header Right Div -->
            <div class="right">
                <div class="btn-group" role="group" aria-label="...">
                    <a href="/" class="btn btn-light">Edit Attendance</a>
                    <a onclick="location.reload()" href="#" class="btn btn-light"><i class="fa fa-refresh"></i></a>
                </div>
            </div>
            <!-- End Page Header Right Div -->
        </div>
			<!-- START CONTAINER -->
			@include('includes/flash-message')
			<div class="container-widget">
				<a href="<?php echo url('admin/applicants'); ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back to list</a>
					<p></p>
					<div class="panel panel-default">
						<div class="panel-title">
						  <ul class="panel-tools">
							<li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
						  </ul>
						</div>
						<div class="panel-body">
							<form id="edit-attendance" class="validate form-horizontal" action="<?php echo url('admin/process/edit-attendance'); ?>" method="post">
								{{ method_field('PUT') }}
								{{ csrf_field() }} 				
								<input type="hidden" name="id" value="<?php echo $attendance->attendance_id; ?>">
								<div class="form-group">
								  <div class="col-sm-6">
								   <label class="control-label form-label">Date</label>
									<input value="<?php echo $attendance->date; ?>" type="date" class="form-control" id="date" name="date" required  />
								  </div>
								  <div class="col-sm-6">
									<label class="control-label form-label">Time Table</label>
									<select name="timetable" class="selectpicker" >
										<option value="<?php echo $attendance->timetable; ?>" selected><?php echo $attendance->timetable; ?></option>
										<option disabled>----</option>
										<option value="11-8">11-8</option>
										<option value="12-9">12-9</option>
										<option value="3-12">3-12</option>
										<option value="8-5">8-5</option>
									</select>
								  </div>
								  <div class="col-sm-6">
									<label class="control-label form-label">Clock-in</label>
									<input value="<?php echo $attendance->clock_in; ?>" type="time" class="form-control" id="clock_in" name="clock_in" required />
								  </div>
								  <div class="col-sm-6">
									<label class="control-label form-label">Clock-out</label>
									<input value="<?php echo $attendance->clock_out; ?>" type="time" class="form-control" id="clock_out" name="clock_out" required />
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
		