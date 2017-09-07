<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class InsertModel extends Model{
    protected function insertToPersonalInfo($lname,$fname,$mname,$email,$address,$contact,$bday,$cstatus,$role,$gender,$department,$job_title,$salary){
		$insert = array(
			'department_id' => $department,
			'job_id' => $job_title,
			'salary' => $salary,
			'fname' => $fname,
			'mname' => $mname,
			'lname' => $lname,
			'email_address' => $email,
			'address' => $address,
			'contact_number' => $contact,
			'gender' => $gender,
			'civil_status' => $cstatus,
			'user_role' => $role,
			'employment_status' => $role,
			'display_pic' => 'default.png',
			'birthday' => $bday
		);
		$query = DB::table('users')->insert($insert);	
		return (($query) ? true : false);	
	}
	protected function insertToLogin($username,$password,$pid,$role,$key){
		$insert = array(
			'personal_info_id' => $pid,
			'username' => $username,
			'password' => $password,
			'key' => $key,
			'role' => $role != 'admin' ? 'user' : 'admin'
		);
		$query = DB::table('logins')->insert($insert);	
		return (($query) ? true : false);			
	}
	protected function addJob($job_title,$job_desc,$department){
		$insert = array(
			'job_title' => $job_title,
			'job_desc' => $job_desc,
			'department_id' => $department
		);
		$query = DB::table('jobs')->insert($insert);	
		return (($query) ? true : false);	
	}
	protected function addDepartment($department_name,$department_desc){
		$insert = array(
			'department_name' => $department_name,
			'department_desc' => $department_desc
		);
		$query = DB::table('departments')->insert($insert);	
		return (($query) ? true : false);		
	}
	protected function UploadFiles($filename,$uploader,$file_size,$ext){
		$insert = array(
			'file_name' => $filename,
			'file_size' => $file_size,
			'extension' => $ext,
			'uploaded_by' => $uploader
		);		
		$query = DB::table('files')->insert($insert);	
		return (($query) ? true : false);	
	}
	protected function insertFormKey($key){
		$insert = array(
			'key' => $key
		);		
		$query = DB::table('form_key')->insert($insert);	
		return (($query) ? true : false);	
	}
	protected function insertEducBG($pid,$school_name,$school_from,$school_to){
		$insert = array(
			'personal_info_id' => $pid,
			'school_name' => $school_name,
			'from' => $school_from,
			'to' => $school_to
		);		
		$query = DB::table('educational_background')->insert($insert);	
		return (($query) ? true : false);			
	}
	protected function insertEmpBG($pid,$emp_company_name,$emp_position,$emp_start,$emp_end,$reason){
		$insert = array(
			'personal_info_id' => $pid,
			'company_name' => $emp_company_name,
			'position' => $emp_position,
			'from' => $emp_start,
			'to' => $emp_end,
			'reason_of_leaving' => $reason
		);		
		$query = DB::table('employment_background')->insert($insert);	
		return (($query) ? true : false);		
	}
	protected function insertReference($pid,$ref_reference_name,$ref_position,$ref_company_name,$ref_contact){
		$insert = array(
			'personal_info_id' => $pid,
			'name_of_reference' => $ref_reference_name,
			'position' => $ref_position,
			'company_name' => $ref_company_name,
			'contact_number' => $ref_contact
		);		
		$query = DB::table('references')->insert($insert);	
		return (($query) ? true : false);			
	}
	
	protected function insertTests($pid,$typing_test,$grammar_test,$listening_test,$personality_test,$iq_test,$eq_test){
		$insert = array(
			'personal_info_id' => $pid,
			'typing_test' => $typing_test,
			'grammar_test' => $grammar_test,
			'listening_test' => $listening_test,
			'personality_test' => $personality_test,
			'iq_test' => $iq_test,
			'eq_test' => $eq_test
		);		
		$query = DB::table('test')->insert($insert);	
		return (($query) ? true : false);		
	}
	protected function addPayslip($employee_id,$from,$to,$tax_status,$basic_pay,$night_diff,$ot_pay,$holiday_pay,$dm,$cola,$bonus,$wtax,$sss,$philhealth,$pagibig){
		$insert = array(
			'personal_info_id' => $employee_id,
			'from' => $from,
			'to' => $to,
			'tax_status' => $tax_status,
			'basic_pay' => $basic_pay,
			'night_diff' => $night_diff,
			'ot_pay' => $ot_pay,
			'holiday_pay' => $holiday_pay,
			'dm' => $dm,
			'cola' => $cola,
			'bonus' => $bonus,
			'wtax' => $wtax,
			'sss' => $sss,
			'philhealth' => $philhealth,
			'pagibig' => $pagibig
		);		
		$query = DB::table('payslip')->insert($insert);	
		return (($query) ? true : false);		
	}
	protected function RequestLeave($pid,$from,$to,$leave_type,$reasons,$file){
		$insert = array(
			'personal_info_id' => $pid,
			'from' => $from,
			'to' => $to,
			'leave_type' => $leave_type,
			'reasons' => $reasons,
			'file_attachment' => $file
		);		
		$query = DB::table('leaves')->insert($insert);	
		return (($query) ? true : false);			
	}
	protected function requestOvertime($pid,$date_affected,$hours,$client,$reasons){
		$insert = array(
			'personal_info_id' => $pid,
			'date_requested' => $date_affected,
			'hours' => $hours,
			'client' => $client,
			'reasons' => $reasons
		);		
		$query = DB::table('overtime')->insert($insert);	
		return (($query) ? true : false);			
	}	
	protected function addOvertime($pid,$employee,$date_affected,$hours,$client,$reasons){
		$insert = array(
			'personal_info_id' => $employee,
			'date_requested' => $date_affected,
			'hours' => $hours,
			'client' => $client,
			'reasons' => $reasons,
			'reviewed_by' => $pid,
			'status' => 1
		);		
		$query = DB::table('overtime')->insert($insert);	
		return (($query) ? true : false);			
	}
	protected function UploadBiometrics($biometrics){
		$query = DB::table('attendance')->insert($biometrics);	
		return (($query) ? true : false);		
	}
	protected function BulkUploadPayslip($payslip){
		$query = DB::table('payslip')->insert($payslip);	
		return (($query) ? true : false);		
	}
}
