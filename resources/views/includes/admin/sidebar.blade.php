
    <div class="sidebar clearfix">
        <ul class="sidebar-panel nav">
            <li class="sidetitle">MAIN</li>
            <li><a <?php echo($page == 'Dashboard') ? 'class="active"' : '' ;?> href="<?php echo url('/'); ?>"><span class="icon color5"><i class="fa fa-home"></i></span>Dashboard</a></li>
			<li><a <?php echo($page == 'Profile') ? 'class="active"' : '' ;?> href="<?php echo url('admin/profile'); ?>"><span class="icon color5"><i class="fa fa-user"></i></span>Profile</a></li>
			<li><a <?php echo($page == 'Departments') ? 'class="active"' : '' ;?> href="<?php echo url('admin/departments'); ?>"><span class="icon color5"><i class="fa fa-coffee "></i></span>Departments</a></li>
            <li><a <?php echo($openable == 'Human Resource') ? 'class="active"' : '' ;?> href="#"><span class="icon color7"><i class="fa fa-users"></i></span>Human Resource<span class="caret"></span></a>
                <ul <?php echo($openable == 'Human Resource') ? 'style="display:block;"' : '' ;?>>
                    <li><a <?php echo($page == 'Employees') ? 'class="active"' : '' ;?> href="<?php echo url('admin/employees'); ?>">Employees</a></li>
					<li><a <?php echo($page == 'Applicants') ? 'class="active"' : '' ;?> href="<?php echo url('admin/applicants'); ?>">Applicants</a></li>
			
                </ul>
            </li>
         
            <li><a <?php echo($openable == 'Leaves') ? 'class="active"' : '' ;?> href="#"><span class="icon color9"><i class="fa fa-plane"></i></span>Leaves<span class="caret"></span></a>
                <ul <?php echo($openable == 'Leaves') ? 'style="display:block;"' : '' ;?>>
                    <li><a <?php echo($page == 'Leaves') ? 'class="active"' : '' ;?> href="<?php echo url('admin/leaves'); ?>">View / Edit</a></li>
					<li><a <?php echo($page == 'Add Leave') ? 'class="active"' : '' ;?> href="<?php echo url('admin/add-leave'); ?>">Add</a></li>
                </ul>
            </li>
            <li><a href="#"><span class="icon color9"><i class="fa fa-barcode "></i></span>Biometrics<span class="caret"></span></a>
                <ul>
                    <li><a href="<?php echo url('admin/attendance'); ?>">View / Edit</a></li>
                </ul>
            </li>
            <li><a <?php echo($openable == 'Overtime') ? 'class="active"' : '' ;?> href="#"><span class="icon color9"><i class="fa fa-clock-o"></i></span>Overtime<span class="caret"></span></a>
                <ul <?php echo($openable == 'Overtime') ? 'style="display:block;"' : '' ;?>>
                    <li><a <?php echo($page == 'Overtime') ? 'class="active"' : '' ;?> href="<?php echo url('admin/overtime'); ?>">View / Edit</a></li>
					<li><a <?php echo($page == 'Add Overtime') ? 'class="active"' : '' ;?> href="<?php echo url('admin/add-overtime'); ?>">Add</a></li>
                </ul>
            </li>
            <li>
				<a <?php echo($openable == 'Job Settings') ? 'class="active"' : '' ;?> href="#"><span class="icon color10"><i class="fa fa-flask"></i></span>Job Settings<span class="caret"></span></a>
                <ul <?php echo($openable == 'Job Settings') ? 'style="display:block;"' : '' ;?>>
                    <li><a <?php echo($page == 'Job Titles') ? 'class="active"' : '' ;?> href="<?php echo url('admin/jobs'); ?>">Job Titles</a></li>
                </ul>
            </li>
            <li><a <?php echo($openable == 'Payslip') ? 'class="active"' : '' ;?> href="#"><span class="icon color9"><i class="fa fa-dollar"></i></span>Payslip<span class="caret"></span></a>
                <ul <?php echo($openable == 'Payslip') ? 'style="display:block;"' : '' ;?>>
                    <li><a <?php echo($page == 'Payslip') ? 'class="active"' : '' ;?> href="<?php echo url('admin/payslip'); ?>">View / Edit</a></li>
					<li><a <?php echo($page == 'Add Payslip') ? 'class="active"' : '' ;?> href="<?php echo url('admin/payslip/new'); ?>">Add</a></li>
                </ul>
            </li>
            <li>
				<a href="#"><span class="icon color10"><i class="fa fa-files-o"></i></span>Admin Reports<span class="caret"></span></a>
                <ul>
					<li><a target="_blank" href="<?php echo url('admin/reports/employee-list'); ?>">Employee Lists</a></li>
                    <li><a target="_blank" data-toggle="modal" data-target="#employee-reports" href="#">Employee Reports</a></li>
					<li><a data-toggle="modal" data-target="#applicant-reports" href="#">Applicant Reports</a></li>
					<li><a data-toggle="modal" data-target="#payslip-reports" href="#">Payslip Generator</a></li>
					<li><a data-toggle="modal" data-target="#attendance-reports" href="#">Biometrics Report</a></li>
					<li><a data-toggle="modal" data-target="#resume-reports" href="#">CV's / Resumes</a></li>
					<li><a data-toggle="modal" data-target="#leaves-reports"href="#">Leaves</a></li>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-panel nav">
            <li class="sidetitle">MORE</li>
			<li><a <?php echo($page == 'Files') ? 'class="active"' : '' ;?> href="<?php echo url('admin/files'); ?>"><span class="icon color15"><i class="fa fa-file-o"></i></span>Files</a></li>
            <li><a <?php echo($page == 'System Settings') ? 'class="active"' : '' ;?> href="<?php echo url('admin/settings'); ?>"><span class="icon color15"><i class="fa fa-cog"></i></span>System Settings</a></li>
			<li><a href="<?php echo url('lock'); ?>"><span class="icon color7"><i class="fa fa-lock"></i></span>Lock Account</a></li>
		    <li><a href="<?php echo url('process/logout'); ?>"><span class="icon color7"><i class="fa fa-sign-out"></i></span>Logout</a></li>
        </ul>
    </div>
	
	<div id="payslip-reports" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Payslip Reports</h4>
		  </div>
		  <div class="modal-body">
			<p>Waiting for admin forms...</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	 
	<div id="applicant-reports" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<form class="" action ="<?php echo url('admin/reports/applicant'); ?>" method="post" target="_blank">
		{{ csrf_field() }} 		
		<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Applicant Reports</h4>
			  </div>
			  <div class="modal-body">
				<select name="applicant_id" class="selectpicker" required="" style="display: none;">
					<option disabled selected>---SELECT APPLICANT--</option>
					<?php
						foreach($applicants_reports as $applicant){
							echo '<option value="'.$applicant->personal_info_id.'">'.$applicant->fname.' '.$applicant->lname.'</option>';
						}
					?>
				</select>				
			  </div>
			  <div class="modal-footer">
				<button  class="btn btn-default" >Generate Report</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			  </div>
			</div>
		</form>
	  </div>
	</div>
	
	<div id="employee-reports" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<form class="" action ="<?php echo url('admin/reports/employee'); ?>" method="post" target="_blank">
		{{ csrf_field() }} 		
		<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Employee Reports</h4>
			  </div>
			  <div class="modal-body">
				<select name="personal_info_id" class="selectpicker" required="" style="display: none;">
					<option disabled selected>---SELECT EMPLOYEE--</option>
					<?php
						foreach($employee_reports as $employee){
							echo '<option value="'.$employee->personal_info_id.'">'.$employee->fname.' '.$employee->lname.'</option>';
						}
					?>
				</select>				
			  </div>
			  <div class="modal-footer">
				<button  class="btn btn-default" >Generate Report</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			  </div>
			</div>
		</form>
	  </div>
	</div>
	
	<div id="attendance-reports" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<div class="modal-content"> 
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Attendance Reports</h4>
		  </div>
		  <div class="modal-body">

		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>

	
	<div id="resume-reports" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Resumes</h4>
		  </div>
		  <div class="modal-body">
			<p>Waiting for admin forms...</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>
	
	<div id="leaves-reports" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Leaves</h4>
		  </div>
		  <div class="modal-body">
			<p>Waiting for admin forms...</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		  </div>
		</div>
	  </div>
	</div>