@extends('includes.admin-template')
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
									<th>Option</th>
									<th>Value</th>
									<th class="text-right">Status</th>
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$ctr = 1;
									foreach($settings as $setting){
										echo '
										<tr>
											<td width=50px>'.$ctr.'</td>
											<td>'.$setting->settings_name.'</td>
											<td>'.$setting->value.'</td>
											<td align="right">';
											echo (($setting->status == 1) ? '<span class="label label-success">Enabled</span>' : '<span class="label label-danger">Disabled</span>');
											echo'</td>
											<td align="right">
												<a data-status="'.$setting->status.'" data-target="#modal-settings"  data-toggle="modal" data-value="'.$setting->value.'" data-title="'.$setting->settings_name.'" data-id="'.$setting->settings_id.'" href="#" class="modal-settings btn btn-xs btn-primary" href="#"><i class="fa fa-pencil"></i> Edit</a>
											</td>	
										</tr>
										';
										$ctr++;
									}
								?>
							</tbody>
							<tfoot>
								<tr class="no-sort">
									<th>#</th>
									<th>Option</th>
									<th>Value</th>
									<th class="text-right">Status</th>
									<th class="text-right">Action</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
			<div class="modal fade" id="modal-settings" tabindex="-1" role="dialog" aria-hidden="true">
				<form class="form-horizontal" action="<?php echo url('admin/settings/update'); ?>" method="post">
				{{ method_field('PUT') }}
				{{ csrf_field() }} 
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title">Basic Modal</h4>
					  </div>
					  <div class="modal-body">
					  <input type="hidden" name="settings_id" id="settings_id" />
						<div class="form-group">
							<label class="col-md-2 control-label form-label">Value : </label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="settings_value" id="settings_value" />
							</div>
						</div>					  
						<div class="form-group">
							<label class="col-md-2 control-label form-label">Status : </label>
							<div class="col-md-10">
								<input id="status" value="{{$setting->status}}" class="toggle" data-onstyle="success" name="status" type="checkbox"  data-toggle="toggle" data-width ="75" />
							</div>
						</div>							

					  </div>
					  <div class="modal-footer">
						<button class="btn btn-white" data-dismiss="modal">Close</button>
						<button class="btn btn-default">Save changes</button>
					  </div>
					</div>
				  </div>
				</form>
            </div>

			<!-- END CONTAINER -->
			<!-- //////////////////////////////////////////////////////////////////////////// -->
		@stop
		 