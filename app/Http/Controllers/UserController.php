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
use File;
use Helper;

/**
 * Database Model
 */
use App\UpdateModel;
use App\InsertModel;
use App\DisplayModel;
use App\DeleteModel;

class UserController extends Controller{
	
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
				if(Session::get('role') != 'user'){	
					if(Session::get('role') == 'admin'){	
						//redirect to user	
						return Redirect::to('/admin');
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
					'dp'  	 => $user->display_pic,
					'logo'   => $logo->value
				);
				
			//Redirect to log in screen when session does not exist.
			}else{
				return Redirect::to('/');
			}
			return $next($request);
		});
	}
	
	//Dashboard Module
	public function index(){
		$data = $this->pub;
		$data['page'] = 'Dashboard';
		$data['desc'] = 'Quick overview of the dashboard';
		$data['late'] = 0;
		$data['undertime'] = 0;
		$data['leaves'] = DisplayModel::getAllLeavesViaUserID(Session::get('pid'));
		$data['sl'] = 0;
		$data['vl'] = 0;
		$data['attendance'] = DisplayModel::getTotalLatesPerYearViaID(Session::get('pid'));
		foreach($data['attendance'] as $l){
			$data['lates'] = $data['helper']->getAttendanceStatus('late',$l->timetable,strtotime($l->clock_in),strtotime($l->clock_out));
			$data['undertimes'] = $data['helper']->getAttendanceStatus('undertime',$l->timetable,strtotime($l->clock_in),strtotime($l->clock_out));
			
			if($data['lates'] == 'Late'){
				$data['late']++;
			}
			if($data['undertimes'] == 'Undertime'){
				$data['undertime']++;
			}
		}
		foreach($data['leaves'] as $leave){
			if($leave->leave_type == 'VL'){
				$data['vl']++;
			}else{
				$data['sl']++;
			}
		}
		return view('user.index',$data);
	}
	//End Dashboard Module
	
	//Profile Module
	public function profile(){
		$data = $this->pub;
		$data['profile'] = DisplayModel::getUserViaID(Session::get('pid'));
		$data['departments'] = DisplayModel::getDepartmentViaID($data['profile']->department_id);
		$data['count'] = count(DisplayModel::getAllUserFiles(Session::get('pid')));
		$data['jobs'] = DisplayModel::getJobViaID($data['profile']->job_id);
		$data['education'] = DisplayModel::getEducationalBackgroundViaID(Session::get('pid'));
		$data['employment'] = DisplayModel::getEmploymentBackgroundViaID(Session::get('pid'));
		$data['reference'] = DisplayModel::getReferenceViaID(Session::get('pid'));
		$data['page'] = 'Profile';
		$data['desc'] = 'Edit your profile';
		return view('user.profile',$data);
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
		$data['files'] = DisplayModel::getAllUserFiles(Session::get('pid'));
		$data['count'] = count(DisplayModel::getAllUserFiles(Session::get('pid')));
		$data['page'] = 'Files';
		$data['desc'] = 'User Files';
		return view('user.files',$data);
	}
	//End Files Module
	
	//Payslip Module
	public function payslip(){
		$data = $this->pub;
		$data['page'] = 'Payslip';
		$data['desc'] = 'Payslip Data';
		$data['payslips'] = DisplayModel::getPayslipViaUserID(Session::get('pid'));
		return view('user.payslip',$data);
	}	
	//End Payslip Module
	
	//Leave Module
	public function requestLeave(){
		$data = $this->pub;
		$data['page'] = 'Request Leave';
		$data['desc'] = 'Request Leave';
		$data['openable'] = 'Leaves';
		return view('user.request-leave',$data);
	}	
	public function processRequestLeave(Request $request){
		extract($_POST);

		
		$file = new FileController();
		$r = $request->file('leaveFile');
		$pid = Session::get('pid');
		$path = '/files/user/'.$pid.'';
		
		//Get File Properties
		if($r!=null){
			$file_name = pathinfo($r->getClientOriginalName(), PATHINFO_FILENAME);
			$ext = pathinfo($r->getClientOriginalName(), PATHINFO_EXTENSION);
			$file_size = $r->getSize();	
		}else{
			$file_name = 'N/A';
			$ext = 'N/A';
			$file_size = 'N/A';
			$path = null;
		}
		
		//Upload to Database
		$data['request_leave'] = InsertModel::RequestLeave($pid,$from,$to,$leave_type,$reasons,$path.'/'.$file_name.'.'.$ext);
		
		if($data['request_leave']){
			//upload files
			if($r!=null){
				$file->uploadLeaveFile($r,$pid);
			}
			
			//Send Email
			$company = DisplayModel::getSettingsViaMeta('company_name');
			$user = DisplayModel::getUserViaID(Session::get('pid'));
			$data = $this->pub;
			$helper = $data['helper'];
			
			$data['name'] = $user->fname.' '.$user->mname.' '.$user->lname;
			$data['from'] = $from; 
			$data['to'] = $to; 
			$data['leave_type'] = $leave_type; 
			$data['reasons'] = $reasons;
			$data['files_url'] = url('/files/user/'.$pid.'/'.$file_name.'.'.$ext);
			if($r==null){
				$data['files_url'] = null;
			}
			$data['company'] = $company->value;
			
			//Loop Admin Email
			$admin_emails = DisplayModel::getAllAdminEmails();
			foreach($admin_emails as $email){
				$helper->sendEmail($email->email_address,view('mail.request-leave',$data));
			}
			Session::flash('success', 'Leave Added successfully! Please wait for admin approval');
		}
		return redirect()->back();	
	}
	public function leaves(){
		$data = $this->pub;
		$data['page'] = 'Leaves';
		$data['desc'] = 'Leaves';
		$data['openable'] = 'Leaves';
		$data['leaves'] = DisplayModel::getAllLeavesViaUserID(Session::get('pid'));
		return view('user.leaves',$data);		
	}
	public function viewLeave($id){
		$data = $this->pub;
		$data['page'] = 'Leaves';
		$data['desc'] = 'Leaves';
		$data['openable'] = 'Leaves';
		$data['leave'] = DisplayModel::getLeaveViaID($id);
		return view('user.view-leave',$data);		
	}
	//End Leave Module
	
	//Overtime Module
	public function processRequestOvertime(){
		extract($_POST);
		$data['request_overtime'] = InsertModel::requestOvertime(Session::get('pid'),$date_affected,$hours,$client,stripslashes($reasons));
		if($data['request_overtime']){
			//Send Email
			$company = DisplayModel::getSettingsViaMeta('company_name');
			$user = DisplayModel::getUserViaID(Session::get('pid'));
			$data = $this->pub;
			$helper = $data['helper'];
			
			$data['name'] = $user->fname.' '.$user->mname.' '.$user->lname;
			$data['date'] = $date_affected; 
			$data['hours'] = $hours; 
			$data['reasons'] = $reasons;
			$data['clients'] = $client;
			$data['company'] = $company->value;
			
			//Loop Admin Email
			$admin_emails = DisplayModel::getAllAdminEmails();
			foreach($admin_emails as $email){
				$helper->sendEmail($email->email_address,view('mail.request-overtime',$data));
			}
			
			Session::flash('success', 'Overtime Added successfully! Please wait for admin approval');
		}
		return redirect()->back();	
	}		
	public function overtime(){
		$data = $this->pub;
		$data['page'] = 'Overtime';
		$data['desc'] = 'Overtime Requests';
		$data['openable'] = 'Overtime';
		$data['overtime'] = DisplayModel::getAllOvertimeViaPID(Session::get('pid'));
		return view('user.overtime',$data);		
	}
	public function viewOvertime($id){
		$data = $this->pub;
		$data['page'] = 'Overtime';
		$data['desc'] = 'View OT Requests';
		$data['openable'] = 'Overtime';
		$data['overtime'] = DisplayModel::getOvertimeViaID($id);
		if(count($data['overtime']) < 1){
			return Redirect::to('/');
		}
		return view('user.view-overtime',$data);		
	}	
	public function overtimeApproval(){
		$data = $this->pub;
		$data['page'] = 'Overtime';
		$data['desc'] = 'Request Overtime';
		$data['openable'] = 'Overtime';
		return view('user.request-overtime',$data);		
	}
	//End Overtime Module
	
	//AjAX Controller
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
	//End AjAX Controller
	
	
	//Debug
	public function debug(){
		$admin_emails = DisplayModel::getAllAdminEmails();
		
		foreach($admin_emails as $email){
			dd($email->email_address);
			$helper->sendEmail($email->email_address,view('mail.request-leave',$data));
		}		
	}
}