<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class UpdateModel extends Model{
	
	protected function updateSettingsViaID($status,$settings_id,$settings_value) {
		(($status!=1) ? $status = 0 : $status = 1);
		$values = array(
			'value' => $settings_value,
			'status' => $status
		);
		
		$query = DB::table('settings')
			->where('settings_id',$settings_id)
			->update($values);
			
		return (($query) ? true : false);
	}
	protected function updatePersonalInfo($personal_info_id,$fname,$mname,$lname,$email,$address,$contact,$bday,$cstatus,$user_role,$gender,$department,$job_title,$employment_status,$salary){
		$values = array(
			'department_id' => $department,
			'job_id' => $job_title,
			'fname' => $fname,
			'mname' => $mname,
			'lname' => $lname,
			'email_address' => $email,
			'address' => $address,
			'contact_number' => $contact,
			'gender' => $gender,
			'birthday' => $bday,
			'civil_status' => $cstatus,
			'salary' => $salary,
			'employment_status' => $employment_status,
			'user_role' => $user_role
		);		
		$query = DB::table('users')
			->where('personal_info_id',$personal_info_id)
			->update($values);
		return (($query) ? true : false);
	}
	protected function updateUserStatus($login_id,$status,$system_role){
		$values = array(
			'status' => $status,
			'role' => $system_role
		);		
		$query = DB::table('logins')
			->where('login_id',$login_id)
			->update($values);		
		return (($query) ? true : false);
	}
	protected function updateUserPassword($login_id,$password){
		$values = array(
			'password' => $password
		);		
		$query = DB::table('logins')
			->where('login_id',$login_id)
			->update($values);		
		return (($query) ? true : false);
	}
	protected function updateUsername($login_id,$username){
		$values = array(
			'username' => $username
		);		
		$query = DB::table('logins')
			->where('login_id',$login_id)
			->update($values);		
		return (($query) ? true : false);
	}	
	protected function updateJob($job_id,$job_title,$job_desc,$department_id){
		$values = array(
			'job_title' => $job_title,
			'job_desc' => $job_desc,
			'department_id' => $department_id
		);		
		$query = DB::table('jobs')
			->where('job_id',$job_id)
			->update($values);		
		return (($query) ? true : false);		
	}
	protected function MakeDeletedDepartmentNull($department_id){
		$values = array(
			'department_id' => '0'
		);		
		$query = DB::table('jobs')
			->where('department_id',$department_id)
			->update($values);		
		return (($query) ? true : false);		
	}
	protected function updateDepartment($department_id,$department_name,$department_desc){
		$values = array(
			'department_name' => $department_name,
			'department_desc' => $department_desc
		);		
		$query = DB::table('departments')
			->where('department_id',$department_id)
			->update($values);		
		return (($query) ? true : false);		
	}
	protected function UpdateLeaveViaID($leave_id,$from,$to,$leave_type,$reasons,$status,$reviewed_by){
		$values = array(
			'reviewed_by' => $reviewed_by,
			'from' => $from,
			'to' => $to,
			'leave_type' => $leave_type,
			'reasons' => $reasons,
			'status' => $status
		);		
		$query = DB::table('leaves')
			->where('leave_id',$leave_id)
			->update($values);		
		return (($query) ? true : false);		
	}
	protected function UpdateOvertimeViaID($overtime_id,$date_requested,$client,$hours,$reasons,$status,$reviewed_by){
		$values = array(
			'hours' => $hours,
			'reasons' => $reasons,
			'date_requested' => $date_requested,
			'client' => $client,
			'status' => $status,
			'reviewed_by' => $reviewed_by
		);		
		$query = DB::table('overtime')
			->where('overtime_id',$overtime_id)
			->update($values);		
		return (($query) ? true : false);		
	}
	protected function updateAttendanceViaID($id,$date,$timetable,$clock_in,$clock_out){
		$values = array(
			'date' => $date,
			'timetable' => $timetable,
			'clock_in' => $clock_in,
			'clock_out' => $clock_out
		);		
		$query = DB::table('attendance')
			->where('attendance_id',$id)
			->update($values);		
		return (($query) ? true : false);		
	}
	protected function UpdateFeedbackViaID($personal_info_id,$feedback){
		$values = array(
			'feedback' => $feedback
		);
		$query = DB::table('users')
			->where('personal_info_id',$personal_info_id)
			->update($values);	
		return (($query) ? true : false);			
	}
	protected function updateStatutoriesViaID($personal_info_id,$sss,$pagibig,$philhealth,$tin){
		$values = array(
			'sss' => $sss,
			'pagibig' => $pagibig,
			'philhealth' => $philhealth,
			'tin' => $tin
		);
		$query = DB::table('users')
			->where('personal_info_id',$personal_info_id)
			->update($values);	
		return (($query) ? true : false);		
	}
	protected function updateFirstDayViaID($personal_info_id,$first_day){
		$values = array(
			'first_day_of_work' => $first_day
		);
		$query = DB::table('users')
			->where('personal_info_id',$personal_info_id)
			->update($values);	
		return (($query) ? true : false);		
	}
	protected function updateEmployeeIDViaID($personal_info_id,$employee_id){
		$values = array(
			'employee_id' => $employee_id
		);
		$query = DB::table('users')
			->where('personal_info_id',$personal_info_id)
			->update($values);	
		return (($query) ? true : false);		
	}	
	protected function updatePracticalTestViaID($personal_info_id,$practical_test){
		$values = array(
			'practical_test' => $practical_test
		);
		$query = DB::table('test')
			->where('personal_info_id',$personal_info_id)
			->update($values);	
		return (($query) ? true : false);		
	}
}
