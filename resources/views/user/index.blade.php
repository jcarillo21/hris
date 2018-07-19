@extends('includes.user-template')
	@section('content')
	@include('includes/breadcrumbs')
        <div class="container-widget">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
					  <ul class="topstats clearfix">
						<li class="col-xs-6 col-lg-3">
							<span class="title"><i class="fa fa-dot-circle-o"></i> Total VL Filed</span>
							<h3><?php echo $vl; ?></h3>
							<span class="diff">This year</span>
						</li>
						<li class="col-xs-6 col-lg-3">
							<span class="title"><i class="fa fa-dot-circle-o"></i>Total SL Filed </span>
							<h3><?php echo $sl; ?></h3>
						  <span class="diff">This year</span>
						</li>		
						<li class="col-xs-6 col-lg-3">
							<span class="title"><i class="fa fa-dot-circle-o"></i> Total Lates </span>
							<h3><?php echo $late; ?></h3>
							<span class="diff">This year</span>
						</li>	
						<li class="col-xs-6 col-lg-3">
							<span class="title"><i class="fa fa-dot-circle-o"></i>Total Undertime </span>
							<h3><?php echo $undertime; ?></h3>
							<span class="diff">This year</span>
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
										<th>Time</th>
										<th>Remarks</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$ctr = 1; 
										foreach($attendance as $row){
											if($ctr>8){break;}
											echo '
											<tr>
												
												<td>'.date('h:i A', strtotime($row->clock_in)).' - '.date('h:i A', strtotime($row->clock_out)).'</td>
												<td>';
													if($row->timetable == '11-8'){
														$grace_period = strtotime("23:20:00");
														$out = strtotime("08:00:00");
													}
													else if($row->timetable == '9-6'){
														$grace_period = strtotime("21:20:00");
														$out = strtotime("06:00:00");
													}
													else if($row->timetable == '8-5'){
														$grace_period = strtotime("8:20:00");
														$out = strtotime("17:00:00");
				
													}
													else if($row->timetable == '3-12'){
														$grace_period = strtotime("03:20:00");
														$out = strtotime("12:00:00");
								
													}	
													else if($row->timetable == '0-9'){
														$grace_period = strtotime("0:20:00");
														$out = strtotime("9:00:00");
								
													}
													else if($row->timetable == '1-10'){
														$grace_period = strtotime("01:20:00");
														$out = strtotime("10:00:00");
								
													}
													if($grace_period <= strtotime($row->clock_in)){
														echo '<span class="label label-danger">Late</span>';
													}else{
														echo '<span class="label label-success">Ontime</span>';
													}
													if($out > strtotime($row->clock_out)){
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
		<script type="text/javascript" src="{{ URL::asset('js/moment/moment.min.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('js/full-calendar/fullcalendar.js') }}"></script>
		<script>
		$(function(e){
		$('#calendar').fullCalendar({
				height: 450,	
				displayEventEnd	: true,		  
				events: [
					<?php
						foreach($leaves as $leave){
							if($leave->status == 0){ $color =  "#f39c12"; } else if($leave->status == 1){ $color = "#26a65b"; } else{$color = "#ef4836";} 
							echo "
							{
								title  : '".$leave->leave_type."',
								start  : '".$leave->from."',
								end    : '".date('Y-M-d',strtotime($leave->to . ' +1 day'))."',
								color  : '".$color."',
								url    : '".url('/')."/user/view-leave/".$leave->leave_id."'
							 },
							";
						}
					?>
				 ]
			});		
		});
		</script>
		@stop
		