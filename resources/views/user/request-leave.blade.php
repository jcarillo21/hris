@extends('includes.user-template')
	@section('content')
		@include('includes/breadcrumbs')
			@include('includes/flash-message')
			<div class="container-widget">
				<div class="panel panel-default">
					<div class="panel-title">
					  <ul class="panel-tools">
						<li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
					  </ul>
					</div>
					<div class="panel-body">
						<form id="request-leave" class="validate-user form-horizontal" action="<?php echo url('user/process/request-leave'); ?>" method="post" enctype="multipart/form-data">
								{{ method_field('PUT') }}
								{{ csrf_field() }} 					
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label form-label">Date From </label>
										<input placeholder="Date From" type="date" class="form-control" id="from" name="from" required  />										
									</div>
									<div class="col-sm-6">
										<label class="control-label form-label">Date To </label>
										<input placeholder="Date To" type="date" class="form-control" id="to" name="to" required  />											
									</div>
								</div>			
								<div class="form-group">
									<div class="col-sm-12">
										<label class="control-label form-label">Leave Type </label>
										<select name="leave_type" class="selectpicker" required >
											<option selected disabled>--Select--</option>
											<option value="SL">Sick Leave (SL)</option>
											<option value="VL">Vacation Leave (VL)</option>
											<option value="EL">Emergency Leave (EL)</option>
										</select>								
									</div>
								</div>			
								<div class="form-group">
									<div class="col-sm-12">
										<label class="control-label form-label">Reason(s) :  </label>
										<textarea name="reasons" rows="8" class="wysiwyg form-control"></textarea>
									</div>
								</div>		
								<div class="dropzone">
									<label class="btn btn-default btn-file">
										<span class="text-rep">CLICK HERE TO SELECT FILE</span> <span class="fa fa-cloud-upload"></span>
										<input class="dropzone file" type="file" name="leaveFile" />
									</label>
									<br/><br/> 
									Upload a scanned copy of your medical certificate, etc.. (Optional)
									<br/>
									File types (.rar,.zip,.jpg,.png)
								</div>	
								<hr/>
								<div class="form-group">
								  <div class="col-sm-12 text-right">
									<button type="submit" class="btn btn-default">Submit</button>
								  </div>
								</div>
						</form>		
					</div>							
				</div>
			</div>
		@stop
		 