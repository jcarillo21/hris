@extends('includes.admin-template')
	@section('content')
		@include('includes/breadcrumbs')
			<!-- START CONTAINER -->
			@include('includes/flash-message')
			<form id="DeleteDepartments" action="<?php echo url('admin/departments/delete'); ?>" method="POST">
				{{ method_field('DELETE') }}
				{{ csrf_field() }} 
				<div class="dropdown">
					<button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-cog"></i> Action
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
						<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo url('admin/department/new'); ?>">Add New Department</a></li>
						<li role="presentation"><a class="delete" data-form="#DeleteDepartments" role="menuitem" href="#">Delete</a></li>
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
										<th>Department Name</th>
										<th>Department Desc</th>
										<th class="text-right">System Status</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$ctr = 1;
										foreach($departments as $department){
											echo '
											<tr>
												<td style="text-align: left; padding-left: 18px;"><div class="checkbox"><input value="'.$department->department_id.'" type="checkbox" name="department_id[]" id="department_id_'.$ctr.'"/><label for="department_id_'.$ctr.'"></label></div></td>
												<td width=50px>'.$ctr.'</td>
												<td>'.$department->department_name.'</td>
												<td>'.$department->department_desc.'</td>
												<td align="right">';
												echo (($department->status == 1) ? '<span class="label label-success">Enabled</span>' : '<span class="label label-danger">Disabled</span>');
												echo'
												</td>
												<td align="right">
													<a href="'.url("admin/edit/department/").''.$department->department_id.'" class="modal-settings btn btn-xs btn-primary" href="#"><i class="fa fa-pencil"></i> Edit</a>
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
										<th>Department Name</th>
										<th>Department Desc</th>
										<th class="text-right">System Status</th>
										<th class="text-right">Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</form>
			

			<!-- END CONTAINER -->
			<!-- //////////////////////////////////////////////////////////////////////////// -->
		@stop
		 