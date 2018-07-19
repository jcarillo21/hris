@extends('includes.admin-template')
	@section('content')
		@include('includes/breadcrumbs')
			@include('includes/flash-message')
			<form id="overTimeStatus" action="<?php echo url('admin/process/bulk-overtime-process'); ?>" method="POST">
				{{ method_field('PUT') }}
				{{ csrf_field() }} 
				
				<select style="width:200px;" name="remark" id="approve-disapprove" class="form-control">
					<option selected disabled">--SELECT ACTION--</a></li>
					<option value="1">Bulk Approve</a></li>
					<option value="2">Bulk Disapprove</a></li>
				</select>
				<br/>
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
										<th>Date Affected</th>
										<th>Hours</th>
										<th>Status</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$ctr = 1;
										foreach($overtime as $ot){
											if($ot->status == 0){
												$status = "<span class='label label-warning'>Pending</span>";
											}else if($ot->status == 1){
												$status = "<span class='label label-success'>Approved</span>";
											}else{
												$status = "<span class='label label-danger'>Disapproved</span>";
											}
											echo '
												<tr>
													<td style="text-align: left; padding-left: 18px;"><div class="checkbox"><input value="'.$ot->overtime_id.'" type="checkbox" name="overtime_id[]" id="overtime_id'.$ctr.'"/><label for="overtime_id'.$ctr.'"></label></div></td>
													<td>'.$ctr.'</td>
													<td>'.$ot->firstname.' '.$ot->lastname.'</td>
													<td>'.date('M d, Y',strtotime($ot->date_requested)).'</td>
													<td>'.$ot->hours.'</td>
													<td>'.$status.'</td>
													<td class="text-right"><a href="'.url("admin/view-overtime").'/'.$ot->overtime_id.'" class="btn btn-xs btn-danger"><i class="fa fa-eye"></i> View</a></td>
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
										<th>Date Affected</th>
										<th>Hours</th>
										<th>Status</th>
										<th class="text-right">Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</form>
		@stop
		 