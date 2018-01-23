<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class DeleteModel extends Model{
	protected function deleteUserViaID($id){
		$query['users']  = DB::table('users')->where('personal_info_id', '=', $id)->delete();
		$query['logins'] = DB::table('logins')->where('personal_info_id', '=', $id)->delete();
		return (($query['users'] && $query['users']) ? true : false);
	}
	protected function deleteJobViaID($id){
		$query  = DB::table('jobs')->where('job_id', '=', $id)->delete();
		return (($query) ? true : false);
	}
	protected function deleteDepartmentViaID($id){
		$query  = DB::table('departments')->where('department_id', '=', $id)->delete();
		return (($query) ? true : false);
	}
	protected function deleteFileViaID($id){
		$query  = DB::table('files')->where('file_id', '=', $id)->delete();
		return (($query) ? true : false);
	}
	protected function deleteAllFormKey(){
		$query  = DB::table('form_key')->truncate();
		return (($query) ? true : false);
	}	
	protected function deletePayslipViaID($id){
		$query  = DB::table('payslip')->where('payslip_id', '=', $id)->delete();
		return (($query) ? true : false);
	}
	protected function deleteAttendanceViaID($id){
		$query  = DB::table('attendance')->where('attendance_id', '=', $id)->delete();
		return (($query) ? true : false);
	}
	
}
