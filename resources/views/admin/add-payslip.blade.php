@extends('includes.admin-template')
	@section('content')
		@include('includes/breadcrumbs')
			@include('includes/flash-message')
			<div class="container-widget">
				<a href="<?php echo url('admin/payslip'); ?>" class="btn btn-info"><i class="fa fa-arrow-left"></i> Back to list</a>
					<p></p>
					<div class="panel panel-default">
						<div class="panel-title">
						  <ul class="panel-tools">
							<li><a class="icon expand-tool"><i class="fa fa-expand"></i></a></li>
						  </ul>
						</div>
						<div class="panel-body">
							<form id="add-payslip" class="validate-admin form-horizontal" action="<?php echo url('admin/process/add-payslip'); ?>" method="post">
								{{ method_field('PUT') }}
								{{ csrf_field() }} 								
								<div class="form-group">
									<div class="col-sm-12">
										<label class="control-label form-label">Employee* </label>
										<select id="employee_id" name="employee_id" class="form-control" required >
											<option value="" selected disabled>--Select--</option>
											<?php
												foreach($employees as $employee){
													echo '<option value="'.$employee->personal_info_id.'">'.$employee->fname.' '.$employee->mname.' '.$employee->lname.'</option>';
												}
											?>
										</select>									
									</div>
								</div>	
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label form-label">Date From* </label>
										<input placeholder="Date From" type="date" class="form-control" id="from" name="from" required  />
									</div>
									<div class="col-sm-6">
										<label class="control-label form-label">Date To* </label>
										<input placeholder="Date To" type="date" class="form-control" id="to" name="to" required  />
									</div>
								</div>
								<input type="hidden" value="" name="department" id="department" />
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label form-label">Tax Status* </label>
										<select name="tax_status" class="form-control" required >
											<option value="" selected disabled>--Select--</option>
											<option value="S">S</option>
											<option value="S1">S1</option>
											<option value="S2">S2</option>
											<option value="S3">S3</option>
											<option value="M">M</option>
											<option value="M1">M1</option>
											<option value="M2">M2</option>
											<option value="M3">M3</option>
										</select>
									</div>
								</div>	
								<h5><b>Payment Details</b></h5>	
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label form-label">Basic Pay* </label>
										<input placeholder="Basic Pay" type="number" class="form-control" id="basic_pay" name="basic_pay" value="0" required  />
									</div>
									<div class="col-sm-6">
										<label class="control-label form-label">Night Diff</label>
										<input placeholder="Night Diff" type="number" class="form-control" id="night_diff" name="night_diff" value="0"  />
									</div>
								</div>	
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label form-label">OT Pay</label>
										<input placeholder="OT Pay" type="number" class="form-control" id="ot_pay" name="ot_pay" value="0"  />
									</div>
									<div class="col-sm-6">
										<label class="control-label form-label">Holiday Pay</label>
										<input placeholder="Holiday Pay" type="number" class="form-control" id="holiday_pay" name="holiday_pay" value="0"  />
									</div>
								</div>	
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label form-label">DM* </label>
										<input placeholder="DM" type="number" class="form-control" id="dm" name="dm" value="0" required  />
									</div>
									<div class="col-sm-6">
										<label class="control-label form-label">COLA</label>
										<input placeholder="COLA" type="number" class="form-control" id="cola" name="cola" value="0"  />
									</div>
								</div>		
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label form-label">Other non-taxable amt./Bonus</label>
										<input placeholder="Other non-taxable amt./Bonus" type="number" class="form-control" id="bonus" name="bonus" value="0"  />
									</div>
								</div>		
								<h5><b>Deductions</b></h5>		
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label form-label">WTax*</label>
										<input placeholder="WTax" type="number" class="form-control" id="wtax" name="wtax" value="0" required  />
									</div>
									<div class="col-sm-6">
										<label class="control-label form-label">SSS* </label>
										<input placeholder="SSS" type="number" class="form-control" id="sss" name="sss" value="0" required  />
									</div>
								</div>	
								<div class="form-group">
									<div class="col-sm-6">
										<label class="control-label form-label">Philhealth* </label>
										<input placeholder="Philhealth" type="number" class="form-control" id="philhealth" name="philhealth" value="0" required  />
									</div>
									<div class="col-sm-6">
										<label class="control-label form-label">PAGIBIG* </label>
										<input placeholder="PAGIBIG" type="number" class="form-control" id="pagibig" name="pagibig" value="0" required  />
									</div>
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
		