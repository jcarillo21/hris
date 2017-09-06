@extends('includes.user-template')
	@section('content')
		@include('includes/breadcrumbs')
			<!-- START CONTAINER -->
			@include('includes/flash-message')
			<div class="container-widget">
<<<<<<< HEAD
				<a href="<?php echo url('user/leaves'); ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back to list</a>
=======
				<a href="/user/leaves" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back to list</a>
>>>>>>> b42320356f7f99679c074c7317143e6e872a9658
					<p></p>
					<div class="panel panel-default">
						<div class="panel-title">
						  <ul class="panel-tools">
							<li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
						  </ul>
						</div>
						<div class="panel-body">		
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Field</th>
										<th>Value</th>
									</tr>
								</thead>
								<tr>
									<td><label class="control-label form-label">Date(s) Affected : </label></td>
									<td><?php echo date('M d, Y',strtotime($leave->from)).' - '.date('M d, Y',strtotime($leave->to)); ?></td>
								</tr>
								<tr>
									<td><label class="control-label form-label">Leave Type : </label></td>
									<td><?php echo $leave->leave_type; ?></td>
								</tr>
								<tr>
									<td><label class="control-label form-label">Reasons : </label></td>
									<td><?php echo addslashes($leave->reasons); ?></td>
								</tr>
								<tr>
									<td><label class="control-label form-label">Status : </label></td>
									<td>
										<?php 
											if($leave->status == 0){
												echo "<span class='label label-warning'>Pending</span>";
											}else if($leave->status == 1){
												echo "<span class='label label-success'>Approved</span>";
											}else{
												echo "<span class='label label-danger'>Disapproved</span>";
											}
										?>
									</td>
								</tr>		
								<tr>
									<td><label class="control-label form-label">File Attachment : </label></td>
									<td><a class="btn-xs btn btn-default" href="<?php echo $leave->file_attachment; ?>"> View File</a></td>
								</tr>	
								<tr>
									<td><label class="control-label form-label">Reviewed By : </label></td>
									<td><?php echo $leave->fname.' '.$leave->lname; ?></td>
								</tr>								
							</table>
						</div>
					</div>
					
			</div>
			<!-- END CONTAINER -->
			<!-- //////////////////////////////////////////////////////////////////////////// -->
		@stop
		