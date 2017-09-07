<?php

namespace App\Http\Controllers;

/**
 * Traits
 */
use App\Http\Controllers\FileController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Crypt;
use App\Mail\Email;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests;

/**
 * Helpers
 */
use Session;
use Redirect;
use PDF; 
use DB; 
use Mail;
use Helper;

/**
 * Database Model
 */
use App\UpdateModel;
use App\InsertModel;
use App\DisplayModel;
use App\DeleteModel;

class AdminController extends Controller{
	
	protected $pub;
	
	public function __construct(){
		
		$this->middleware(function ($request, $next){
			//Lockscreen
			if(Session::has('locked')){
				if(Session::get('locked')){	
					//redirect to lockscreen when user locked his / her account
					return Redirect::to('/lock');
				}				
			}
			
			//If logged in
			if(Session::has('role')){

				$user = DisplayModel::getUserViaID(Auth::id());
				
				//die('Has Session.');
				if(Session::get('role') != 'admin'){	
					if(Session::get('role') == 'user'){	
						//redirect to user	
						return Redirect::to('/user');
					}
				}
				
				//Public variables
				$title   = DisplayModel::getSettingsViaMeta('site_name');
				$logo    = DisplayModel::getSettingsViaMeta('site_logo');
				$favicon = DisplayModel::getSettingsViaMeta('favicon');
				 
				$this->pub = array(
					'helper' =>  new Helper(),
					'title' => $title->value,
					'page' => '', //overwrite per page
					'openable' => '', //overwrite per page
					'desc' => '', //overwrite per page
					'name' => $user->fname.' '.$user->lname,
					'dp'   => $user->display_pic,
					'logo'   => $logo->value
				);
				
			//Redirect to log in screen when session does not exist.
			}else{
				return Redirect::to('/');
			}
			return $next($request);
		});
	}
	
	//Dashboard
	public function index(){
		$data = $this->pub;
		$data['page'] = 'Dashboard';
		$data['desc'] = 'Quick overview of the dashboard';
		$data['emp_count'] = count(DisplayModel::getAllEmployees());
		$data['applicant_count'] = count(DisplayModel::getAllApplicants());
		$data['leave_count'] = count(DisplayModel::getAllLeaveThisWeek());
		$data['dep_count'] = count(DisplayModel::getAllDepartments());
		$data['leaves'] = DisplayModel::getAllLeaves();
		$data['attendance'] = DisplayModel::getAttendance();
		return view('admin.index',$data);
	}
	//End Dashboard
	
	//Settings Module
	public function settings(){
		$data = $this->pub;
		$data['settings'] = DisplayModel::getAllSettings();
		$data['page'] = 'System Settings';
		$data['desc'] = 'Change the System Settings';
		return view('admin.settings',$data);
	}
	public function updateSettings(){		
		extract($_POST);		
		$data['result'] = UpdateModel::updateSettingsViaID($status,$settings_id,$settings_value);
		if($data['result']){
			Session::flash('success', 'Saving Success!');
		}else{
			Session::flash('danger', 'Can not save to database, the value doesn\'t change');
		}
	    return redirect()->back();

	}	  

	//End Settings Module
	
	//Profile Module
	public function profile(){
		$data = $this->pub;
		$data['profile'] = DisplayModel::getUserViaID(Session::get('pid'));
		$data['departments'] = DisplayModel::getAllDepartments();
		$data['count'] = count(DisplayModel::getAllUserFiles(Session::get('pid')));
		$data['jobs'] = DisplayModel::getAlljobs();
		$data['page'] = 'Profile';
		$data['desc'] = 'Edit your profile';
		return view('admin.profile',$data);
	}
	public function processEditProfile(){
		extract($_POST);	
		$data['update_personal_info'] = UpdateModel::updatePersonalInfo($personal_info_id,$fname,$mname,$lname,$email,$address,$contact,$bday,$cstatus,$user_role,$gender,$department,$job_title,$employment_status,$salary);
		Session::flash('success', 'User updated successfully!');
		return redirect()->back();			
	}
	public function processEditLogin(){
		extract($_POST);	
		$data['update_username'] = UpdateModel::updateUsername($personal_info_id,$username);	
		$data['update_user_status'] = UpdateModel::updateUserStatus($personal_info_id,$status = 1,$system_role);
		if($password!=null){
			$data['update_password'] = UpdateModel::updateUserPassword($personal_info_id,Hash::make($password));
		}
		Session::flash('success', 'Login updated successfully!');
		return redirect()->back();			
	}
	//End Profile Module
	
	//Files Module
	public function files(){
		$data = $this->pub;
		$data['files'] = DisplayModel::getAllFiles();
		$data['count'] = count(DisplayModel::getAllFiles());
		$data['page'] = 'Files';
		$data['desc'] = 'Admin Files';
		return view('admin.files',$data);
	}	
	//End Files
	
	//Payslip Module
	public function addPayslip(){
		$data = $this->pub;
		$data['page'] = 'Add Payslip';
		$data['desc'] = 'Add Payslip';
		$data['openable'] = 'Payslip';
		$data['employees'] = DisplayModel::getAllEmployees();
		$data['departments'] = DisplayModel::getAllDepartments();
		return view('admin.add-payslip',$data);
	}	
	public function processAddPayslip(){
		extract($_POST);
		
		$data['add_payslip'] = insertModel::addPayslip($employee_id,$from,$to,$tax_status,$basic_pay,$night_diff,$ot_pay,$holiday_pay,$dm,$cola,$bonus,$wtax,$sss,$philhealth,$pagibig);
		if($data['add_payslip']){
			//Send Email
			//$email->send('jcruz@primeview.com','john@primeview.com','SUBJ','MSG');
			Session::flash('success', 'Payslip added successfully!');
		}else{
			Session::flash('danger', 'Can not add Payslip.');
		}		
		return redirect()->back();	
	}	
	public function processBulkAddPayslip(Request $request){
		$file = new FileController();
		$r = $request->file('payslip');
		$file_name = pathinfo($r->getClientOriginalName(), PATHINFO_FILENAME);
		$ext = pathinfo($r->getClientOriginalName(), PATHINFO_EXTENSION);
		
		if($ext!='csv'){
			Session::flash('danger', 'Invalid File extension');
			return redirect()->back();
		}
		$file->uploadCSV($r);
		
		$csv = addslashes(getcwd().'/files/csv/'.$file_name.'.'.$ext.'');
		$payslip = fopen($csv, "r");
		
		while (($column = fgetcsv($payslip)) !== false) {
			if (array(null) !== $column) {
				$rowData[] = fgetcsv($payslip);
			}
        }		

        foreach ($rowData as $key => $value){
            $inserted_data = array(
				'personal_info_id' => $value[0],
				'from' => $value[1],
				'to' => $value[2],
				'tax_status' => $value[3],
				'basic_pay' => $value[4],
				'night_diff' => $value[5],
				'ot_pay' => $value[6],
				'holiday_pay' => $value[7],
				'dm' => $value[8],
				'cola' => $value[9],
				'bonus' => $value[10],
				'wtax' => $value[11],
				'sss' => $value[12],
				'philhealth' => $value[13],
				'pagibig' => $value[14]
			);  
			$data['result'] = InsertModel::BulkUploadPayslip($inserted_data);
        }		
		fclose($payslip);
		
		if($data['result']){
			Session::flash('success', 'Payslip Added Successfully!');
			$file->deleteFileViaDir(getcwd().'/files/csv/'.$file_name.'.'.$ext.'');
			
		}
		return redirect()->back();		
		
	}
	public function payslip(){
		$data = $this->pub;
		$data['payslips'] = DisplayModel::getAllPayslips();
		$data['openable'] = 'Payslip';
		$data['page'] = 'Payslip';
		$data['desc'] = 'Payslip Data';
		return view('admin.payslip',$data);
	}	
	public function deletePayslips(){
		extract($_POST);
		foreach($payslip_id as $id){
			$data['delete'] = DeleteModel::deletePayslipViaID($id);
		}
		(($data['delete']) ? Session::flash('success', 'Applicant Deleted Successfuly!') : Session::flash('danger', 'Can not delete applicant'));
		return redirect()->back();
	}	
	//End Payslip Module
	
	//Department Module
	public function addDepartment(){
		$data = $this->pub;
		$data['page'] = 'Department';
		$data['desc'] = 'Add Department';
		return view('admin.add-department',$data);			
	}
	public function processAddDepartment(){
		extract($_POST);
		$data['add_department'] = insertModel::addDepartment($department_name,$department_desc);
		if($data['add_department']){
			Session::flash('success', 'Department added successfully!');
		}else{
			Session::flash('danger', 'Can not add Department.');
		}		
		return redirect()->back();	
	}	
	public function departments(){
		$data = $this->pub;
		$data['departments'] = DisplayModel::getAllDepartments();
		$data['page'] = 'Departments';
		$data['desc'] = 'Manage Departments';
		return view('admin.departments',$data);
	}	
	public function editDepartment($id){
		$data = $this->pub;
		$data['page'] = 'Departments';
		$data['desc'] = 'Edit Department';
		$data['department'] = DisplayModel::getDepartmentViaID($id);
		if(count($data['department']) < 1){
			return Redirect::to('/admin/departments');
		}
		return view('admin.edit-department',$data);	
	}	
	public function processEditDepartment(){
		extract($_POST);	
		$data['update_department'] = UpdateModel::updateDepartment($department_id,$department_name,$department_desc);	
		if($data['update_department']){
			Session::flash('success', 'Department updated successfully!');
		}else{
			Session::flash('danger', 'Can not edit Department.');
		}
		return redirect()->back();			

	}
	public function deleteDepartments(){
		extract($_POST);
		foreach($department_id as $id){
			$data['delete'] = DeleteModel::deleteDepartmentViaID($id);
			$data['update'] = updateModel::MakeDeletedDepartmentNull($id);
		}
		(($data['delete']) ? Session::flash('success', 'Departments Deleted Successfuly!') : Session::flash('danger', 'Can not delete departments'));
		return redirect()->back();
	}	
	//End Department Module

	//Leave Module
	public function processRequestLeave(Request $request){
		extract($_POST);

		
		$file = new FileController();
		$r = $request->file('leaveFile');
		$pid = $employee;
		$path = '/files/user/'.$pid.'';
		
		//Get File Properties
		$file_name = pathinfo($r->getClientOriginalName(), PATHINFO_FILENAME);
		$ext = pathinfo($r->getClientOriginalName(), PATHINFO_EXTENSION);
		$file_size = $r->getSize();	
		
		//Upload to Database
		$data['request_leave'] = InsertModel::RequestLeave($pid,$from,$to,$leave_type,$reasons,$path.'/'.$file_name.'.'.$ext);
		
		if($data['request_leave']){
			//upload files
			$file->uploadLeaveFile($r,$pid);
			
			//Send Email
			//$email->send('jcruz@primeview.com','john@primeview.com','SUBJ','MSG');
			Session::flash('success', 'Leave Added successfully! Please wait for admin approval');
		}
		return redirect()->back();	
	}
	public function addLeave(){
		$data = $this->pub;
		$data['page'] = 'Add Leave';
		$data['desc'] = 'Add Leave';
		$data['openable'] = 'Leaves';
		$data['employees'] = DisplayModel::getAllEmployees();
		return view('admin.add-leave',$data);		
	}
	public function leaves(){
		$data = $this->pub;
		$data['page'] = 'Leaves';
		$data['desc'] = 'Leaves';
		$data['openable'] = 'Leaves';
		$data['leaves'] = DisplayModel::getAllLeaves();
		return view('admin.leaves',$data);		
	}
	public function processEditLeave(){
		extract($_POST);	
		
		$data['edit_leave'] = UpdateModel::UpdateLeaveViaID($leave_id,$from,$to,$leave_type,stripslashes($reasons),$status,$reviewed_by);

		if($data['edit_leave']){
			//Email user Here
			//$email->send('jcruz@primeview.com','john@primeview.com','SUBJ','MSG');
			Session::flash('success', 'Leave updated successfully!');
		}
		return redirect()->back();		
	}
	public function editLeave($id){
		$data = $this->pub;
		$data['page'] = 'Leaves';
		$data['desc'] = 'Leaves';
		$data['openable'] = 'Leaves';
		$data['pid'] = Session::get('pid');
		$data['leave'] = DisplayModel::getLeaveViaID($id);
		return view('admin.edit-leave',$data);		
	}
	//End Leave Module
	
	//Job Module
	public function addJobs(){
		$data = $this->pub;
		$data['page'] = 'Job Titles';
		$data['openable'] = 'Job Settings';
		$data['desc'] = 'Add Job Titles';
		$data['departments'] = DisplayModel::getAllDepartments();
		return view('admin.add-jobs',$data);			
	}
	public function processAddJob(){
		extract($_POST);
		$data['add_job'] = insertModel::addJob($job_title,$job_desc,$department);
		if($data['add_job']){
			Session::flash('success', 'Job added successfully!');
		}else{
			Session::flash('danger', 'Can not add Job.');
		}		
		return redirect()->back();	
	}	
	public function jobs(){
		$data = $this->pub;
		$data['jobs'] = DisplayModel::getAlljobs();
		$data['page'] = 'Job Titles';
		$data['openable'] = 'Job Settings';
		$data['desc'] = 'Manage Job Titles';
		return view('admin.jobs',$data);		
	}
	public function processEditJob(){
		extract($_POST);	
		$data['update_job'] = UpdateModel::updateJob($job_id,$job_title,$job_desc,$department);	
		if($data['update_job']){
			Session::flash('success', 'Job updated successfully!');
		}else{
			Session::flash('danger', 'Can not edit Job.');
		}
		return redirect()->back();			

	}
	public function editJob($id){
		$data = $this->pub;
		$data['page'] = 'Job Title';
		$data['openable'] = 'Job Settings';
		$data['desc'] = 'Edit Jobs';
		$data['departments'] = DisplayModel::getAllDepartments();
		$data['job'] = DisplayModel::getJobViaID($id);
		if(count($data['job']) < 1){
			return Redirect::to('/admin/jobs');
		}
		return view('admin.edit-job',$data);	
	}	
	public function deleteJobs(){
		extract($_POST);
		foreach($job_id as $id){
			$data['delete'] = DeleteModel::deleteJobViaID($id);
		}
		(($data['delete']) ? Session::flash('success', 'Job Title Deleted Successfuly!') : Session::flash('danger', 'Can not delete employee'));
		return redirect()->back();
	}	
	//End Job Module
	
	//Employee Module
	public function employees(){
		$data = $this->pub;
		$data['employees'] = DisplayModel::getAllEmployees();
		$data['page'] = 'Employees';
		$data['openable'] = 'Human Resource';
		$data['desc'] = 'Manage Employees';
		return view('admin.employees',$data);
	}		
	public function addEmployee(){
		$data = $this->pub;
		$data['page'] = 'Employees';
		$data['openable'] = 'Human Resource';
		$data['desc'] = 'Add Employees';
		$data['departments'] = DisplayModel::getAllDepartments();
		$data['jobs'] = DisplayModel::getAlljobs();
		return view('admin.add-employee',$data);
	}	
	public function processAddEmployee(){
		extract($_POST);
		$key = Hash::make(str_random(16));
		if($password!=$confirm_password){
			Session::flash('danger', 'Password mismatched.');
			return redirect()->back();			
		}
		$data['insert_to_personal_info'] = 	insertModel::insertToPersonalInfo($lname,$fname,$mname,$email,$address,$contact,$bday,$cstatus,$user_role,$gender,$department,$job_title,$salary);
		
		$pid = DisplayModel::getLastPersonalInfoID();
		$data['insert_to_login'] = insertModel::insertToLogin($username,Hash::make($password),$pid->personal_info_id,$system_role,$key);	
		
		$data['last_inserted_data'] = DisplayModel::getUserViaID($pid->personal_info_id);
		
		if($data['insert_to_personal_info'] && $data['insert_to_login']){
			//Send Email
			$company = DisplayModel::getSettingsViaMeta('company_name');
			$data = $this->pub;
			$helper = $data['helper'];
			
			$data['name'] = $fname.' '.$mname.' '.$lname;
			$data['email'] = $email;
			$data['username'] = $username; 
			$data['password'] = $password;
			$data['company'] = $company->value;
			$data['url'] = url('/');
			
			$helper->sendEmail($email,view('mail.add-employee',$data));
			Session::flash('success', 'User added successfully!');
		}else{
			Session::flash('danger', 'Password mismatched.');
		}
		return redirect()->back();	
	}
	public function editEmployee($id){
		$data = $this->pub;
		$data['page'] = 'Employees';
		$data['openable'] = 'Human Resource';
		$data['desc'] = 'Add Employees';
		$data['departments'] = DisplayModel::getAllDepartments();
		$data['jobs'] = DisplayModel::getAlljobs();
		$data['employee'] = DisplayModel::getUserViaID($id);
		$data['education'] = DisplayModel::getEducationalBackgroundViaID($id);
		$data['employment'] = DisplayModel::getEmploymentBackgroundViaID($id);
		$data['files'] = DisplayModel::getAllUserFiles($id);
		$data['reference'] = DisplayModel::getReferenceViaID($id);
		if(count($data['employee']) < 1){
			return Redirect::to('/admin/employees');
		}
		return view('admin.edit-employee',$data);	
	}	
	public function processEditEmployee(){
		extract($_POST);	
		$data['update_personal_info'] = UpdateModel::updatePersonalInfo($personal_info_id,$fname,$mname,$lname,$email,$address,$contact,$bday,$cstatus,$user_role,$gender,$department,$job_title,$employment_status,$salary);
		$data['update_username'] = UpdateModel::updateUsername($personal_info_id,$username);	
		$data['update_user_status'] = UpdateModel::updateUserStatus($personal_info_id,$status,$system_role);	
		if($password!=null){
			$data['update_password'] = UpdateModel::updateUserPassword($personal_info_id,Hash::make($password));
		}
		Session::flash('success', 'Profile updated successfully!');
		return redirect()->back();			
	}
	public function deleteEmployees(){
		extract($_POST);
		foreach($employee_id as $id){
			$data['delete'] = DeleteModel::deleteUserViaID($id);
		}
		(($data['delete']) ? Session::flash('success', 'Employee Deleted Successfuly!') : Session::flash('danger', 'Can not delete employee'));
		return redirect()->back();
	}	
	//End Employee Module
	
	//Applicant Module
	public function applicants(){
		$data = $this->pub;
		$data['applicants'] = DisplayModel::getAllApplicants();
		$data['page'] = 'Applicants';
		$data['openable'] = 'Human Resource';
		$data['desc'] = 'Manage Applicants';
		return view('admin.applicants',$data);
	}	
	public function editApplicant($id){
		$data = $this->pub;
		$data['page'] = 'Applicants';
		$data['openable'] = 'Human Resource';
		$data['desc'] = 'Add Applicant';
		$data['departments'] = DisplayModel::getAllDepartments();
		$data['jobs'] = DisplayModel::getAlljobs();
		$data['applicant'] = DisplayModel::getUserViaID($id);
		$data['education'] = DisplayModel::getEducationalBackgroundViaID($id);
		$data['employment'] = DisplayModel::getEmploymentBackgroundViaID($id);
		$data['files'] = DisplayModel::getAllUserFiles($id);
		$data['reference'] = DisplayModel::getReferenceViaID($id);
		if(count($data['applicant']) < 1){
			return Redirect::to('/admin/applicants');
		}
		return view('admin.edit-applicant',$data);	
	}	
	public function deleteApplicants(){
		extract($_POST);
		foreach($applicant_id as $id){
			$data['delete'] = DeleteModel::deleteUserViaID($id);
		}
		(($data['delete']) ? Session::flash('success', 'Applicant Deleted Successfuly!') : Session::flash('danger', 'Can not delete applicant'));
		return redirect()->back();
	}	
	//End Applicant Module
	
	//Attendance Module
	public function attendance(){
		$data = $this->pub;
		$data['attendance'] = DisplayModel::getAttendance();
		$data['page'] = 'Biometrics Data';
		$data['openable'] = 'Biometrics';
		$data['desc'] = 'Manage Biometrics Data';
		return view('admin.attendance',$data);
	}
	public function processAddAttendance(Request $request){
		$file = new FileController();
		$r = $request->file('attendance');
		$file_name = pathinfo($r->getClientOriginalName(), PATHINFO_FILENAME);
		$ext = pathinfo($r->getClientOriginalName(), PATHINFO_EXTENSION);
		
		if($ext!='csv'){
			Session::flash('danger', 'Invalid File extension');
			return redirect()->back();
		}
		$file->uploadCSV($r);
		
		$csv = addslashes(getcwd().'/files/csv/'.$file_name.'.'.$ext.'');
		$biometrics = fopen($csv, "r");
		
		while (($column = fgetcsv($biometrics)) !== false) {
			if (array(null) !== $column) {
				$rowData[] = fgetcsv($biometrics);
			}
        }	
		
        foreach ($rowData as $key => $value){
            $inserted_data = array(
				'personal_info_id'=>$value[0],
				'date'=>$value[1],
				'timetable'=>$value[2],
				'clock_in'=>$value[3],
				'clock_out'=>$value[4]
			);
			$data['result'] = InsertModel::UploadBiometrics($inserted_data);
        }		
		fclose($biometrics);
		
		if($data['result']){
			Session::flash('success', 'Attendance Added Successfully!');
			$file->deleteFileViaDir(getcwd().'/files/csv/'.$file_name.'.'.$ext.'');
		}
		return redirect()->back();
	}
	public function editAttendance($id){
		$data = $this->pub;
		$data['attendance'] = DisplayModel::getAttendanceViaID($id);
		$data['page'] = 'Biometrics Data';
		$data['openable'] = 'Biometrics';
		$data['desc'] = 'Edit Attendance';
		if(count($data['attendance']) < 1){
			return Redirect::to('/admin/attendance');
		}
		return view('admin.edit-attendance',$data);	
	}	
	public function processeditAttendance(){
		extract($_POST);	
		$data['update_attendance'] = UpdateModel::updateAttendanceViaID($id,$date,$timetable,$clock_in,$clock_out);
		Session::flash('success', 'Attendance updated successfully!');
		return redirect()->back();				
	}
	public function deleteAttendance(){
		extract($_POST);
		foreach($attendance_id as $id){
			$data['delete'] = DeleteModel::deleteAttendanceViaID($id);
		}
		(($data['delete']) ? Session::flash('success', 'Attendance Deleted Successfuly!') : Session::flash('danger', 'Can not delete attendance'));
		return redirect()->back();
	}	
	//End Attendance Module

	//Overtime Module
	public function addOvertime(){
		$data = $this->pub;
		$data['page'] = 'Add Overtime';
		$data['desc'] = 'Add OT Requests';
		$data['openable'] = 'Overtime';
		$data['pid'] = Session::get('pid');
		$data['employees'] = DisplayModel::getAllEmployees();
		return view('admin.add-overtime',$data);		
	}		
	public function processAddOvertime(){
		extract($_POST);
		$data['add_overtime'] = insertModel::addOvertime(Session::get('pid'),$employee,$date_affected,$hours,$client,stripslashes($reasons));
		$data['add_overtime'] ? Session::flash('success', 'Overtime added successfully!') : Session::flash('danger', 'Can not add overtime entry.');
		return redirect()->back();			
	}	
	public function overtime(){
		$data = $this->pub;
		$data['page'] = 'Overtime';
		$data['desc'] = 'Overtime Requests';
		$data['openable'] = 'Overtime';
		$data['overtime'] = DisplayModel::getAllOvertime();
		return view('admin.overtime',$data);		
	}
	public function viewOvertime($id){
		$data = $this->pub;
		$data['page'] = 'Overtime';
		$data['desc'] = 'View OT Requests';
		$data['openable'] = 'Overtime';
		$data['pid'] = Session::get('pid');
		$data['overtime'] = DisplayModel::getOvertimeViaID($id);
		if(count($data['overtime']) < 1){
			return Redirect::to('/');
		}
		return view('admin.view-overtime',$data);		
	}	
	public function processUpdateOvertime(){
		extract($_POST);
		
		
		$data['edit_ot'] = UpdateModel::UpdateOvertimeViaID($overtime_id,$date_affected,$client,$hours,stripslashes($reasons),$status,$reviewed_by);
		
		if($data['edit_ot']){
			//Email user Here
			//$email->send('jcruz@primeview.com','john@primeview.com','SUBJ','MSG');
			Session::flash('success', 'Overtime updated successfully!');
		}
		return redirect()->back();		
	}
	//End Overtime Module

	//AjAX Controller modules
	public function checkUsernameAvailability(){
		extract($_GET);
		$data['availability'] = DisplayModel::checkUsernameAvailability($username);
		if($data['availability']!=0){
			$response = 'Username is already taken.';
		}else{
			$response = true;
		}
		echo json_encode($response);
	}
	public function checkEmailAvailability(){
		extract($_GET);
		$data['availability'] = DisplayModel::checkEmailAvailability($email);
		if($data['availability']!=0){
			$response = 'Email address is already taken.';
		}else{
			$response = true;
		}
		echo json_encode($response);
	}	
	public function checkEditUsernameAvailability(){
		extract($_GET);
		$data['availability'] = DisplayModel::checkUsernameAvailability($username);
		if($data['availability'] > 1){
			$response = 'Username is already taken.';
		}else{
			$response = true;
		}
		echo json_encode($response);
	}
	public function checkEditEmailAvailability(){
		extract($_GET);
		$data['availability'] = DisplayModel::checkEmailAvailability($email);
		if($data['availability'] > 1){
			$response = 'Email address is already taken.';
		}else{
			$response = true;
		} 
		echo json_encode($response);
	}		
	//End AjAX Controller modules

	//Debug
	public function debug(){	 

	}	
}