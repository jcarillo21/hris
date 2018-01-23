@extends('includes.user-template')
	@section('content')
		@include('includes/breadcrumbs')
			@include('includes/flash-message')
			<div class="container-widget">
				<a href="<?php echo url('user/overtime'); ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back to list</a>
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
									<td><?php echo date('M d, Y',strtotime($overtime->date_requested)); ?></td>
								</tr>
								<tr>
									<td><label class="control-label form-label">Hours : </label></td>
									<td><?php echo $overtime->hours; ?></td>
								</tr>
								<tr>
									<td><label class="control-label form-label">Client(s) Involved : </label></td>
									<td><?php echo $overtime->client; ?></td>
								</tr>
								<tr>
									<td><label class="control-label form-label">Reasons : </label></td>
									<td><?php echo addslashes($overtime->reasons); ?></td>
								</tr>
								<tr>
									<td><label class="control-label form-label">Status : </label></td>
									<td>
										<?php 
											if($overtime->status == 0){
												echo "<span class='label label-warning'>Pending</span>";
											}else if($overtime->status == 1){
												echo "<span class='label label-success'>Approved</span>";
											}else{
												echo "<span class='label label-danger'>Disapproved</span>";
											}
										?>
									</td>
								</tr>		
								<tr>
									<td><label class="control-label form-label">Reviewed By : </label></td>
									<td><?php echo $overtime->fname.' '.$overtime->lname; ?></td>
								</tr>								
							</table>
						</div>
					</div>
					
			</div>
		@stop
		