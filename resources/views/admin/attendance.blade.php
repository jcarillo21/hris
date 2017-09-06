@extends('includes.admin-template')
	@section('content')
		@include('includes/breadcrumbs')
			<!-- START CONTAINER -->
			@include('includes/flash-message')
			<form id="DeleteAttendance" action="<?php echo url('admin/attendance/delete'); ?>" method="POST">
				{{ method_field('DELETE') }}
				{{ csrf_field() }} 
				<div class="dropdown">
					<button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-cog"></i> Action
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
						<li role="presentation"><a role="menuitem" tabindex="-1" data-toggle="modal" data-target="#addAttendance">Add New Attendance</a></li>
						<li role="presentation"><a role="menuitem" href="<?php echo url('files/templates/attendance.csv'); ?>">Download CSV Template</a></li>
						<li role="presentation"><a class="delete" data-form="#DeleteAttendance" role="menuitem" href="#">Delete</a></li>
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
										<th>Date</th>
										<th>Clock In</th>
										<th>Clock Out</th>
										<th>Time Table</th>
										<th>Remarks</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$ctr = 1;
										foreach($attendance as $row){
											echo '
											<tr>
												<td style="text-align: left; padding-left: 18px;"><div class="checkbox"><input value="'.$row->attendance_id.'" type="checkbox" name="attendance_id[]" id="attendance_id_'.$ctr.'"/><label for="attendance_id_'.$ctr.'"></label></div></td>
												<td width=50px>'.$ctr.'</td>
												<td>'.$row->fname.' '.$row->lname.'</td>
												<td>'.date('M d, Y',strtotime($row->date)).'</td>
												<td>'.date('h:i A', strtotime($row->clock_in)).'</td>
												<td>'.date('h:i A', strtotime($row->clock_out)).'</td>
												<th>'.$row->timetable.'</th>
												<td>';
													$undertime = $helper->getAttendanceStatus('undertime',$row->timetable,strtotime($row->clock_in),strtotime($row->clock_out));
													$late = $helper->getAttendanceStatus('late',$row->timetable,strtotime($row->clock_in),strtotime($row->clock_out));
													if($late == 'Late'){
														echo '<span class="label label-danger">Late</span>';
													}else{
														echo '<span class="label label-success">Ontime</span>';
													}
													if($undertime == 'undertime'){
														echo '<span class="label label-warning">Undertime</span>';
													}
													echo' 
												</td>
												<td align="right">
													<a href="'.url("admin/edit/attendance/").''.$row->attendance_id.'" class="modal-settings btn btn-xs btn-primary" href="#"><i class="fa fa-pencil"></i> Edit</a>
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
										<th>Date</th>
										<th>Clock In</th>
										<th>Clock Out</th>
										<th>Time Table</th>
										<th>Remark</th>
										<th class="text-right">Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</form>
			<!-- Modal -->
			<form class="validate-admin" action="<?php echo url('admin/process/add-attendance'); ?>" method="post" enctype="multipart/form-data">
				{{ method_field('PUT') }}
				{{ csrf_field() }} 		
				<div class="modal fade" id="addAttendance" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add Attendance (.csv)</h4>
					  </div>
					  <div class="modal-body">
						<div class="dropzone">
							<label class="btn btn-default btn-file">
								<span class="text-rep">CLICK HERE TO SELECT FILE</span> <span class="fa fa-cloud-upload"></span>
								<input class="dropzone file" type="file" name="attendance" required>
							</label>
							<br><br> 
							Upload a csv file
							<br>
							File types (.csv)
						</div>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-default">Upload</button>
					  </div>
					</div>
				  </div>
				</div>		
			</form>

			<!-- END CONTAINER -->
			<!-- //////////////////////////////////////////////////////////////////////////// -->
		@stop
		 