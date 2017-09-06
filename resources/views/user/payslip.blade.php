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
										<th>Payslip #</th>
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
													<td>'.$ctr.'</td>
													<td>'.$payslip->payslip_id.'</td>
													<td>'.date('M d, Y',strtotime($payslip->from)).'</td>
													<td>'.date('M d, Y',strtotime($payslip->to)).'</td>
													<td>'.date('M d, Y',strtotime($payslip->generated_at)).'</td>
<<<<<<< HEAD
													<td class="text-right"><a target="_blank" href="'.url("user/generate-pdf/").''.$payslip->payslip_id.'" class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i> Generate PDF</a></td>
=======
													<td class="text-right"><a target="_blank" href="/user/generate-pdf/'.$payslip->payslip_id.'" class="btn btn-xs btn-danger"><i class="fa fa-file-pdf-o"></i> Generate PDF</a></td>
>>>>>>> b42320356f7f99679c074c7317143e6e872a9658
												</tr>
											';
											$ctr++;
										}
									?>
								</tbody>
								<tfoot>
									<tr class="no-sort">
										<th>#</th>
										<th>Payslip #</th>
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
	
			<!-- END CONTAINER -->
			<!-- //////////////////////////////////////////////////////////////////////////// -->
		@stop
		 