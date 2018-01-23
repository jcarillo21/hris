<?php

namespace App;

use DB;
use Carbon;
use Illuminate\Database\Eloquent\Model;

class DisplayModel extends Model{
	
	public $timestamps = true;
	
	protected function getUserViaID($personal_info_id){
		$query = DB::table('users as a')->where('a.personal_info_id',$personal_info_id)
			->join('logins as b', 'b.personal_info_id', '=', 'a.personal_info_id')	
		->first(); 	
		return $query;
	}	
	protected function getEducationalBackgroundViaID($personal_info_id){
		$query = DB::table('educational_background as a')
			->join('users as b', 'b.personal_info_id', '=', 'a.personal_info_id')	
			->where('b.personal_info_id',$personal_info_id)
		->get(); 	
		return $query;
	}		
	protected function getEmploymentBackgroundViaID($personal_info_id){
		$query = DB::table('employment_background as a')
			->join('users as b', 'b.personal_info_id', '=', 'a.personal_info_id')	
			->where('b.personal_info_id',$personal_info_id)
		->get(); 	
		return $query;
	}	
	protected function getReferenceViaID($personal_info_id){
		$query = DB::table('references as a')->where('a.personal_info_id',$personal_info_id)
			->join('users as b', 'b.personal_info_id', '=', 'a.personal_info_id')	
			->where('b.personal_info_id',$personal_info_id)
		->get(); 	
		return $query;
	}	
	protected function getTestsViaID($personal_info_id){
		$query = DB::table('test as a')->where('a.personal_info_id',$personal_info_id)
			->join('users as b', 'b.personal_info_id', '=', 'a.personal_info_id')	
			->where('b.personal_info_id',$personal_info_id)
		->get(); 	
		return $query;
	}	
	protected function getJobViaID($job_id){
		$query = DB::table('jobs')->where('job_id',$job_id)
		->first(); 	
		return $query;
	}	
	protected function getDepartmentViaID($department_id){
		$query = DB::table('departments')->where('department_id',$department_id)
		->first(); 	
		return $query;
	}	
	protected function getAllEmployees(){
		$query = DB::table('users as a')->where('user_role','Employee')
			->join('logins as b', 'b.personal_info_id', '=', 'a.personal_info_id')
			->leftjoin('jobs as c', 'c.job_id', '=', 'a.job_id')
			->leftjoin('departments as d', 'd.department_id', '=', 'a.department_id')
		->get(); 	
		return $query;
	} 
	protected function getAllApplicants(){
		$query = DB::table('users as a')->select('a.*','b.*','c.*','d.*','a.created_at as created_at')->where('user_role','Applicant')
			->join('logins as b', 'b.personal_info_id', '=', 'a.personal_info_id')
			->leftjoin('jobs as c', 'c.job_id', '=', 'a.job_id')
			->leftjoin('departments as d', 'd.department_id', '=', 'a.department_id')
			->orderBy('a.personal_info_id', 'desc')
		->get(); 	 
		return $query;
	} 	
	protected function getAllAdminEmails(){
		$query = DB::table('users')->select('email_address')->where('user_role','Admin')->get(); 	 
		return $query;
	} 	
	protected function getSettingsViaMeta($meta){
		$query = DB::table('settings')->where('settings_name',$meta)->first();
		return $query;
	}
	
	protected function getAllSettings(){
		$query = DB::table('settings')->get();
		return $query;
	}	
	
	protected function getAllLeaves(){
		$query = DB::table('leaves as a')
		->select('a.*','b.*','c.*','b.fname as firstname','b.lname as lastname')
		->join('users as b','b.personal_info_id','=','a.personal_info_id')
		->leftjoin('users as c','c.personal_info_id','=','a.reviewed_by')
		->orderBy('a.generated_at', 'desc')
		->get();
		return $query;
	}	
	protected function getAllLeaveThisWeek(){
		$fromDate = Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
		$tillDate = Carbon\Carbon::now()->endOfWeek()->format('Y-m-d');
		
		$query = DB::table('leaves as a')
		->select('a.*','b.*','c.*','b.fname as firstname','b.lname as lastname')
		->join('users as b','b.personal_info_id','=','a.personal_info_id')
		->leftjoin('users as c','c.personal_info_id','=','a.reviewed_by')
		 ->whereBetween('from', [$fromDate, $tillDate] )
		->get();
		return $query;
	}
	protected function getAllDepartments(){
		$query = DB::table('departments')->get();
		return $query;
	}	
	protected function getAlljobs(){
		$query = DB::table('jobs as a')
		->leftjoin('departments as b', 'b.department_id', '=', 'a.department_id')
		->get();
		return $query;
	}	
	protected function getAllUserFiles($user_id){
		$query = DB::table('files')->where('uploaded_by',$user_id)->orderBy('created_at','desc')
		->get();
		return $query;
	}
	protected function getAllFiles(){
		$query = DB::table('files as a')
		->join('users as b','a.uploaded_by','=','b.personal_info_id')
		->orderBy('a.created_at','desc')
		->get();
		return $query;
	}
	protected function getAttendance(){
		$query = DB::table('attendance as a')
		->join('users as b','a.personal_info_id','=','b.personal_info_id')
		->orderBy('a.uploaded_at','desc')
		->get();
		return $query;
	}	
	protected function getLastPersonalInfoID(){
		$query = DB::table('users')->select('personal_info_id')->orderBy('personal_info_id', 'desc')->first();
		return $query;		 
	}
	protected function checkUsernameAvailability($username){
		$query = DB::table('logins')->where('username','=',$username)->count();
		return $query;
	}
	protected function checkEmailAvailability($email){
		$query = DB::table('users')->where('email_address','=',$email)->count();
		return $query;
	}
	protected function getFileViaID($file_id){
		$query = DB::table('files')->where('file_id',$file_id)->first();
		return $query;		 
	}
	protected function getFormKey(){
		$query = DB::table('form_key')->first();
		return $query;		 
	}	
	protected function getFormKeyViaKey($key){
		$query = DB::table('form_key')
		->where('key',$key)
		->where('status',1)
		->count();
		return $query > 0 ? true : false;	 
	}
	protected function getPayslipViaUserID($ID){
		$query = DB::table('payslip as a')
		->join('users as b', 'b.personal_info_id', '=', 'a.personal_info_id')
		->join('departments as c', 'c.department_id', '=', 'b.department_id')
		->where('a.personal_info_id',$ID)
		->get();
		return $query;	
	}
	protected function getAllPayslips(){
		$query = DB::table('payslip as a')
		->join('users as b', 'b.personal_info_id', '=', 'a.personal_info_id')
		->join('departments as c', 'c.department_id', '=', 'b.department_id')
		->get();
		return $query;	
	}
	protected function getPayslipViaID($ID){
		$query = DB::table('payslip as a')
		->join('users as b','a.personal_info_id','=','b.personal_info_id')
		->join('departments as c', 'c.department_id', '=', 'b.department_id')
		->where('payslip_id',$ID)
		->first();
		return $query;	
	}
	protected function getAllLeavesViaUserID($ID){
		$query = DB::table('leaves')
		->where('personal_info_id',$ID)
		->get();
		return $query;	
	}
	protected function getLeaveViaID($ID){
		$query = DB::table('leaves as a')
		->select('a.*','b.*','c.fname as rfname','c.lname as rlname','b.fname as firstname','b.lname as lastname')
		->join('users as b','b.personal_info_id','=','a.personal_info_id')		
		->leftjoin('users as c','c.personal_info_id','=','a.reviewed_by')
		->where('a.leave_id',$ID)
		->first();
		return $query;	
	}
	protected function getAllOvertimeViaPID($PID){
		$query = DB::table('overtime')
		->where('personal_info_id',$PID)
		->get();
		return $query;	
	}
	protected function getOvertimeViaID($id){
		$query = DB::table('overtime as a')
		->select('a.*','b.*','c.fname as rfname','c.lname as rlname','b.fname as firstname','b.lname as lastname')
		->join('users as b','b.personal_info_id','=','a.personal_info_id')		
		->leftjoin('users as c','c.personal_info_id','=','a.reviewed_by')
		->where('overtime_id',$id)
		->first();
		return $query;	
	}
	protected function getAllOvertime(){
		$query = DB::table('overtime as a')
		->select('a.*','b.*','c.*','b.fname as firstname','b.lname as lastname')
		->join('users as b','b.personal_info_id','=','a.personal_info_id')		
		->leftjoin('users as c','c.personal_info_id','=','a.reviewed_by')
		->get();
		return $query;	
	}
	protected function getAttendanceViaID($id){
		$query = DB::table('attendance as a')->where('a.attendance_id',$id)
			->join('users as b', 'b.personal_info_id', '=', 'a.personal_info_id')	
		->first(); 	
		return $query;
	}
	protected function getTotalLatesPerYearViaID(){
		$query = DB::table('attendance')
			->where('date','LIKE','%'.date('Y').'%')
			->get(); 	
		return $query;		
	}

}
