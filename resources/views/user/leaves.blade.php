@extends('includes.user-template')
	@section('content')
		@include('includes/breadcrumbs')
			<!-- START CONTAINER -->
			@include('includes/flash-message')
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
										<th>#</th>
										<th>From</th>
										<th>To</th>
										<th>Leave Type</th>
										<th>Status</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$ctr = 1;
										foreach($leaves as $leave){
											if($leave->status == 0){
												$status = "<span class='label label-warning'>Pending</span>";
											}else if($leave->status == 1){
												$status = "<span class='label label-success'>Approved</span>";
											}else{
												$status = "<span class='label label-danger'>Disapproved</span>";
											}
											echo '
												<tr>
													<td>'.$ctr.'</td>
													<td>'.date('M d, Y',strtotime($leave->from)).'</td>
													<td>'.date('M d, Y',strtotime($leave->to)).'</td>
													<td>'.$leave->leave_type.'</td>
													<td>'.$status.'</td>
													<td class="text-right"><a href="'.url("user/view-leave").'/'.$leave->leave_id.'" class="btn btn-xs btn-danger"><i class="fa fa-eye"></i> View</a></td>
												</tr>
											';
											$ctr++;
										}
									?>
								</tbody>
								<tfoot>
									<tr class="no-sort">
										<th>#</th>
										<th>From</th>
										<th>To</th>
										<th>Leave Type</th>
										<th>Status</th>
										<th class="text-right">Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
			</div>
	
			<!-- END CONTAINER -->
			<!-- //////////////////////////////////////////////////////////////////////////// -->
		@stop
		 