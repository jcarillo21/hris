@include('includes/header')
	<div class="main-form">
		<div class="container">
			<div class="col-md-12">
				<div class="logo">
					<img src="//staffportal.optimizex.com/wp-content/uploads/2014/04/optimizex_logo3213.png" draggable="false" />
				</div>
                @foreach (['danger', 'warning', 'success', 'info'] as $mode)
                   @if(Session::has($mode))
                     <div class="kode-alert alert alert-{{ $mode }}">
						<a href="#" class="closed">&times;</a>
                       <p>{{ Session::get($mode) }}</p>
                     </div>
                   @endif
                @endforeach
				<form target="_blank" action="<?php echo url('application-form/submit'); ?>" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }} 					 	
				<h4>Basic Info</h4>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<label class="control-label form-label">Lastname*</label>
								<input placeholder="Lastname" type="text" class="form-control" id="lname" name="lname" required  />
							</div>
							<div class="col-sm-4">
								<label class="control-label form-label">Firstname*</label>
								<input placeholder="Firstname"  type="text" class="form-control" id="fname" name="fname" required />
							</div>
							<div class="col-sm-4">
								<label class="control-label form-label">Middlename*</label>
								<input placeholder="Middlename"  type="text" class="form-control" id="mname" name="mname" required />
							</div>
						</div>
					</div>	
					
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<label class="control-label form-label">Birthday*</label>
								<input placeholder="Birthday" type="date" class="form-control" id="bday" name="bday" required  />
							</div>
							<div class="col-sm-6">
								<label class="control-label form-label">Email Address*</label>
								<input placeholder="Emai Address"  type="email" class="form-control" id="email" name="email" required />
							</div>
						</div>
					</div>		
					
					<div class="form-group">
						<div class="row">
							<div class="col-sm-6">
								<label class="control-label form-label">Civil Status</label><br/>
								<select name="cstatus" class="form-control" >
									<option disabled>----</option>
									<option value="Single">Single</option>
									<option value="Married">Married</option>
									<option value="Widowed">Widowed</option>
								</select>
							</div>
							<div class="col-sm-6">
								<label class="control-label form-label">Contact Number*</label>
								<input placeholder="Contact Number"  type="text" class="form-control" id="contact" name="contact" required />
							</div>
						</div>	
					</div>	
					
					<div class="form-group">
						<div class="row">
							<div class="col-sm-12">
								<label class="control-label form-label">Address*</label><br/>
								<input placeholder="Address"  type="text" class="form-control" id="address" name="address" required />
							</div>
						</div>
					</div>	
					
					<div class="form-group">
						<div class="row"> 
							<div class="col-sm-6">
								<label class="control-label form-label">Desired Position</label><br/>
								<select name="position" class="form-control" required>
									<option value="">--POSITION--</option> 
									<?php
										foreach($positions as $position){
											echo '<option value="'.$position->job_id.'">'.$position->job_title.'</option>';
										}
									?>
								</select>
							</div>
							<div class="col-sm-6">
								<label class="control-label form-label">Desired Salary*</label>
								<input placeholder="Desired Salary"  type="number" class="form-control" id="salary" name="salary" required />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label class="control-label form-label">Gender*</label><br>
								<div class="radio radio-info radio-inline">
									<input checked="" type="radio" id="gender-male" value="Male" name="gender" required>
									<label for="gender-male"> Male </label>
								</div>
								<div class="radio radio-info radio-inline">
									<input type="radio" id="gender-female" value="Female" name="gender" required>
									<label for="gender-female"> Female</label>
								</div>											
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-12">
								<div class="dropzone">
									<h3>Upload Resume <span class="fa fa-cloud-upload"></span></h3>
									<input style="margin: auto;border: 0px;" class="file" type="file" name="resume" />
									<br/>
									<p>Allowed File types :  .ZIP | .RAR | .DOCX</p>
								</div>
							</div>
						</div>
					</div> 
					
					<h4>Educational Background</h4>
					<div class="text-right">
						<a id="btn-educ" data-target=".educ-container" class="btn btn-warning btn-xs" href="#"><span class="fa fa-plus"></span> Add Field</a>
					</div>	
					<section class="educ-container">					
						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<label class="control-label form-label">School name</label>
									<input placeholder="School name" type="text" class="form-control" id="school-name" name="school_name[]"  />
								</div>
								<div class="col-sm-3">
									<label class="control-label form-label">FROM</label>
									<select name="school_from[]" class="form-control" >
										<option selected disabled>--FROM--</option>
										<?php
											for($from = date('Y'); $from >= 1917; $from--){
												echo '<option value="'.$from.'">'.$from.'</option>';
											}
										?>
									</select>
								</div>
								<div class="col-sm-3">
									<label class="control-label form-label">TO</label>
									<select name="school_to[]" class="form-control" >
										<option selected disabled>--TO--</option>
										<?php
											for($to = date('Y'); $to >= 1917; $to--){
												echo '<option value="'.$to.'">'.$to.'</option>';
											}
										?>
									</select>
								</div>
							</div>
						</div>
					</section>
					
					<h4>Employment Background</h4>
					<div class="text-right">
						<a id="btn-emp" data-target=".emp-container" class="btn btn-warning btn-xs" href="#"><span class="fa fa-plus"></span> Add Field</a>
					</div>
					
					<section class="emp-container">
						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<label class="control-label form-label">Company Name</label>
									<input placeholder="Company name" type="text" class="form-control" id="emp_company_name" name="emp_company_name[]"  />
								</div>
								<div class="col-sm-6">
									<label class="control-label form-label">Position</label>
									<input placeholder="Position" type="text" class="form-control" id="emp_position" name="emp_position[]"  />
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<label class="control-label form-label">Start</label>
									<input placeholder="Start" type="month" class="form-control" id="emp_start" name="emp_start[]"  />
								</div>
								<div class="col-sm-6">
									<label class="control-label form-label">End</label>
									<input placeholder="End" type="month" class="form-control" id="emp_end" name="emp_end[]"  />
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="row">
								<div class="col-sm-12">
									<label class="control-label form-label">Reason of Leaving</label>
									<textarea  class="form-control" id="reason" name="reason[]" ></textarea>
								</div>
							</div>
						</div>
					</section>
					
					<h4>References</h4>
					<div class="text-right">
						<a id="btn-ref" data-target=".ref-container" class="btn btn-warning btn-xs" href="#"><span class="fa fa-plus"></span> Add Field</a>
					</div>		
					<section class="ref-container">
						<div class="form-group">
							<div class="row">
								<div class="col-sm-3">
									<label class="control-label form-label">Name of Reference</label>
									<input placeholder="Reference Name" type="text" class="form-control" id="ref_reference_name" name="ref_reference_name[]"  />
								</div>
								<div class="col-sm-3">
									<label class="control-label form-label">Position</label>
									<input placeholder="Position" type="text" class="form-control" id="ref_position" name="ref_position[]"  />
								</div>
								<div class="col-sm-3">
									<label class="control-label form-label">Company / Organization Name</label>
									<input placeholder="Company Name / Organization Name" type="text" class="form-control" id="ref_company_name" name="ref_company_name[]"  />
								</div>
								<div class="col-sm-3">
									<label class="control-label form-label">Contact</label>
									<input placeholder="Reference Contact #" type="text" class="form-control" id="ref_contact" name="ref_contact[]"  />
								</div>
							</div>
						</div>
					</section>
					
					<h4>Tests</h4>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<label class="control-label form-label">Typing Test* <a target="_blank" class="btn btn-xs btn-success" href="http://www.typingtest.com/">Link</a></label>
								<input placeholder="Typing Test Score" type="text" class="form-control" id="typing_test" name="typing_test" value="N/A" required />
							</div>
							<div class="col-sm-4">
								<label class="control-label form-label">Grammar Test* <a target="_blank" class="btn btn-xs btn-success" href="http://www.examenglish.com/leveltest/grammar_level_test.htm">Link</a></label>
								<input placeholder="Grammar Test Score" type="text" class="form-control" id="grammar_test" name="grammar_test" value="N/A" required />
							</div>
							<div class="col-sm-4">
								<label class="control-label form-label">Listening Test* <a target="_blank" class="btn btn-xs btn-success" href="http://examenglish.com/leveltest/listening_level_test.htm">Link</a></label>
								<input placeholder="Listening Test Score" type="text" class="form-control" id="listening_test" value="N/A" name="listening_test" value="N/A" required />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-sm-4">
								<label class="control-label form-label">Personality Test <a target="_blank" class="btn btn-xs btn-success" href="http://www.humanmetrics.com/cgi-win/jtypes2.asp">Link</a></label>
								<input placeholder="Personality Test Score" type="text" class="form-control" id="personality_test" name="personality_test" value="N/A" required />
							</div>
							<div class="col-sm-4">
								<label class="control-label form-label">IQ Test* <a target="_blank" class="btn btn-xs btn-success" href="http://www.iqtestexperts.com/iq-test/instructions.php">Link</a></label>
								<input placeholder="IQ Test Result" type="text" class="form-control" id="iq_test" name="iq_test" value="N/A" required />
							</div>
							<div class="col-sm-4">
								<label class="control-label form-label">EQ Test* <a target="_blank" class="btn btn-xs btn-success" href="https://www.mindtools.com/pages/article/ei-quiz.htm">Link</a></label>
								<input placeholder="EQ Test Result" type="text" class="form-control" id="eq_test" name="eq_test" value="N/A" required />
							</div>
						</div>
					</div>			
					<div class="form-group">
						<div class="row">			
							<div class="col-sm-12">
								<div class="dropzone">
									<h3>Upload Practical Test <span class="fa fa-cloud-upload"></span></h3>
										<input style="margin: auto;border: 0px;" class="file" type="file" name="practical_files" />
									<br/>
									<p>Allowed File types :  .ZIP | .RAR</p>
								</div>
							</div>
						</div>
					</div>
					<div class="alert alert-info" role="alert">
						<p>Note : Please call the examiner first before submitting the form for a review.</p>
					</div>
					<div class="text-right">
						<button class="btn btn-info">Submit <span class="fa fa-check"></span></button>
					</div>
				</form>
			</div>
		</div>
	</div>
@include('includes/footer')