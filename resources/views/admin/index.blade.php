@extends('includes.admin-template')
	@section('content')
	@include('includes/breadcrumbs')
        <!-- START CONTAINER -->
        <div class="container-widget">
			<div class="container-fluid ">
				<!--<div class="row">
					<div class="top-note">
						<form id="announcement-form" onsubmit="return false" action="#" method="POST">
							<textarea id="announcement" name="announcement" class="form-control" placeholder="What's on your mind?"></textarea>
							<div align="right">
								<button class="btn-xs btn btn-warning">Edit</button>
								<button id="announcement-btn" class="btn-xs btn btn-primary">Post</button>
							</div>
						</form>
						<script type="text/javascript">
							$(function(e){
								//console.log(e);
								var flag = false;
								var textarea = $('#announcement');
								var form = $('#announcement-form');
								$('#announcement-btn').click(function(){
									console.log(textarea.val());
									if(!flag && jQuery.trim(textarea.val()).length > 0){
										textarea.hide();
										form.append('<p class="announcement-content">'+textarea.val()+'</p>');
										flag = true;
									}
								});
							});
						</script>
					</div>
				</div>-->
				<div class="row">
					<div class="col-md-12">
					  <ul class="topstats clearfix">
						<li class="col-xs-6 col-lg-3">
						  <span class="title"><i class="fa fa-dot-circle-o"></i> Total Employees</span>
						  <h3><?=$emp_count;?></h3>
						  <span class="diff">Using this system</span>
						</li>
						<li class="col-xs-6 col-lg-3">
						  <span class="title"><i class="fa fa-dot-circle-o"></i> Total Departments </span>
						  <h3><?=$dep_count;?></h3>
						  <span class="diff">Active</span>
						</li>	
						<li class="col-xs-6 col-lg-3">
						  <span class="title"><i class="fa fa-dot-circle-o"></i>Employees that is on leave </span>
						  <h3><?=$leave_count;?></h3>
						  <span class="diff">This week</span>
						</li>	
						<li class="col-xs-6 col-lg-3">
						  <span class="title"><i class="fa fa-dot-circle-o"></i>Total Applicants </span>
						  <h3><?=$applicant_count;?></h3>
						  <span class="diff">Active</span>
						</li>						
					  </ul>
					</div>		
				</div>	

				<div class="row">
					<div class="col-md-9">
						<h3>Leaves</h3>
						<span class="label label-warning">Pending</span>
						<span class="label label-success">Approved</span>
						<span class="label label-danger">Disapproved</span>
						<div id="calendar">
						</div><br/>
					</div>
					<div class="col-md-3">
						<h3>Latest Attendance Feed</h3>
						<div class="attendance-table">
							<table class="table display">
								<thead>
									<tr  class="no-sort">
										<th>Name</th>
										<th>Time</th>
										<th>Remarks</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$ctr = 1; 
										foreach($attendance as $row){
											if($ctr > 8){break;}
											echo '
											<tr>
												<td>'.$row->fname.' '.$row->lname.'</td>
												<td>'.date('h:i A', strtotime($row->clock_in)).' - '.date('h:i A', strtotime($row->clock_out)).'</td>
												<td>';
													$late = $helper->getAttendanceStatus('late',$row->timetable,strtotime($row->clock_in),strtotime($row->clock_out));
													$undertime = $helper->getAttendanceStatus('undertime',$row->timetable,strtotime($row->clock_in),strtotime($row->clock_out));
													//Remarks
													if($late == 'Late'){
														echo '<span class="label label-danger">Late</span>';
													}else{
														echo '<span class="label label-success">Ontime</span>';
													}
													if($undertime == 'Undertime'){
														echo '<span class="label label-danger">Undertime</span>';
													}	
													echo' 
												</td>	
											</tr>
											';
											$ctr++;
										} 
									?>
								</tbody>
								<tfoot>
									<tr class="no-sort">
										<th>Name</th>
										<th>Time</th>
										<th>Remarks</th>
									</tr>
								</tfoot>
							</table>	
						</div>
					</div>
				</div>				
			</div>
        </div>
		<script src="{{ URL::asset('js/moment/moment.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/full-calendar/fullcalendar.js') }}"></script>
		<script>
		$(function(){
		 $('#calendar').fullCalendar({
				height: 450,	
				displayEventEnd	: true,		  
				events: [
					<?php
						foreach($leaves as $leave){
							if($leave->status == 0){ $color =  "#f39c12"; } else if($leave->status == 1){ $color = "#26a65b"; } else{$color = "#ef4836";} 
							echo "
							{
								title  : '".$leave->firstname." ".$leave->lastname." (".$leave->leave_type.")',
								start  : '".$leave->from."',
								end    : '".date('Y-M-d',strtotime($leave->to . ' +1 day'))."',
								color  : '".$color."',
								url    : '/admin/edit-leave/".$leave->leave_id."'
							 },
							";
						}
					?>
				 ]
			});		
		});
		</script>
        <!-- END CONTAINER -->
        <!-- //////////////////////////////////////////////////////////////////////////// -->
		@stop
		