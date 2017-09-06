<?php
namespace App\Helpers;

use DB;

/**
 * Database Model
 */
use App\UpdateModel;
use App\InsertModel;
use App\DisplayModel;
use App\DeleteModel;

class HelperController{
	
    public function getAttendanceStatus($status,$timetable,$clock_in,$clock_out){
		if ($status == 'late'){
			//11pm-8am Timetable
			if($timetable == '11-8'){
				$grace_period = strtotime("23:20:00");
			}
			//9pm-6am Timetable
			else if($timetable == '9-6'){
				$grace_period = strtotime("21:20:00");
			}
			//8am-5pm Timetable
			else if($timetable == '8-5'){
				$grace_period = strtotime("8:20:00");
				$out = strtotime("17:00:00");
			}
			//3am-12nn Timetable
			else if($timetable == '3-12'){
				$grace_period = strtotime("03:20:00");
			}	
			//12mn-9am Timetable
			else if($timetable == '0-9'){
				$grace_period = strtotime("0:20:00");
			}
			//1am-10am Timetable
			else if($timetable == '1-10'){
				$grace_period = strtotime("01:20:00");
			}
			//Remarks
			if($grace_period <= $clock_in){
				$return = 'Late';
			}else{
				$return = 'Ontime';
			}
			return $return;		
		}
		if ($status == 'undertime'){
			//11pm-8am Timetable
			if($timetable == '11-8'){
				$out = strtotime("08:00:00");
			}
			//9pm-6am Timetable
			else if($timetable == '9-6'){
				$out = strtotime("06:00:00");
			}
			//8am-5pm Timetable
			else if($timetable == '8-5'){
				$out = strtotime("17:00:00");
			}
			//3am-12nn Timetable
			else if($timetable == '3-12'){
				$out = strtotime("12:00:00");
			}	
			//12mn-9am Timetable
			else if($timetable == '0-9'){
				$out = strtotime("9:00:00");
			}
			//1am-10am Timetable
			else if($timetable == '1-10'){
				$out = strtotime("10:00:00");
			}
			$return = '';
			if($out > $clock_out){
				$return = 'Undertime';
			}			
			return $return;		
		}
	}
	public function sendEmail($to,$message){
		
		$sender = DisplayModel::getSettingsViaMeta('email_sender');
		$company_name = DisplayModel::getSettingsViaMeta('company_name');
		
		$headers = 'From: '.$company_name->value.' <'.$sender->value.'>' . "\r\n" .
					'MIME-Version: 1.0' . "\r\n" .
					'Content-Type: text/html;charset=UTF-8' . "\r\n" .
					'Reply-To: '.$to.'' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();	
					
		$resp = mail($to,"Email Notification",$message, $headers);	
		
		if($resp){
			return true;
		}else{
			return false;
		}
	} 
		
	public function test(){
		return 'Helper Connected!';
	}	
	
}
