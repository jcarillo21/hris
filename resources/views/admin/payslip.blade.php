@extends('includes.admin-template')
	@section('content')
		@include('includes/breadcrumbs')
			@include('includes/flash-message')
			<form id="DeletePayslip" action="<?php echo url('admin/payslip/delete'); ?>" method="POST">
				{{ method_field('DELETE') }}
				{{ csrf_field() }} 
				<div class="dropdown">
						<button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="false">
							<i class="fa fa-cog"></i> Action
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
							<li role="presentation"><a class="delete" data-form="#DeletePayslip" role="menuitem" href="#">Delete</a></li>
							<li role="presentation"><a role="menuitem" data-toggle="modal" data-target="#addPayslip" href="#">Bulk Upload</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="/admin/payslip/new">Add New Payslip</a></li>
							<li role="presentation"><a role="menuitem" href="<?php echo url('files/templates/payslip.csv'); ?>">Download CSV template</a></li>
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
											<th>Payslip #</th>
											<th>Name</th>
											<th>From</th>
											<th>To</th>
											<th>Date Generated</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$ctr = 1;
											foreach($payslips as $payslip){
												echo '
													<tr>
														<td style="text-align: left; padding-left: 18px;"><div class="checkbox"><input value="'.$payslip->payslip_id.'" type="checkbox" name="payslip_id[]" id="payslip_id_'.$ctr.'"/><label for="payslip_id_'.$ctr.'"></label></div></td>													
														<td>'.$ctr.'</td>
														<td>'.$payslip->payslip_id.'</td>
														<td>'.$payslip->fname.' '.$payslip->lname.'</td>
														<td>'.date('M d, Y',strtotime($payslip->from)).'</td>
														<td>'.date('M d, Y',strtotime($payslip->to)).'</td>
														<td>'.date('M d, Y',strtotime($payslip->generated_at)).'</td>
														<td class="text-right"><a target="_blank" href="'.url("admin/generate-pdf").'/'.$payslip->payslip_id.'" class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i> Generate PDF</a></td>
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
											<th>Payslip #</th>
											<th>Name</th>
											<th>From</th>
											<th>To</th>
											<th>Date Generated</th>
											<th class="text-right">Action</th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
				</div>
			</form>
			<form class="validate-admin" action="<?php echo url('admin/process/bulk-add-payslip'); ?>" method="post" enctype="multipart/form-data">
				{{ method_field('PUT') }}
				{{ csrf_field() }} 		
				<div class="modal fade" id="addPayslip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Add Payslip (.csv)</h4>
					  </div>
					  <div class="modal-body">
						<div class="dropzone">
							<label class="btn btn-default btn-file">
								<span class="text-rep">CLICK HERE TO SELECT FILE</span> <span class="fa fa-cloud-upload"></span>
								<input class="dropzone file" type="file" name="payslip" required>
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
		@stop 
		 