<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests;

use Redirect;
use Session;

/**
 * Database Model
 */
use App\UpdateModel;
use App\InsertModel;
use App\DisplayModel;
use App\DeleteModel;

class GuestController extends Controller{

	public function applicationForm($key){
		
		$existing = displayModel::getFormKeyViaKey($key);
		
		if(!$existing){
			die("Forbidden : Invalid URL key");
		}
		$data['positions'] = displayModel::getAlljobs();
		$data['title'] = 'Application Form';
		$data['page'] = 'Application Form';
		$data['class'] = 'application-form';
		return view('guest.index',$data);
	}
	
	public function generateFormKey(){
		$data['insert'] = insertModel::insertFormKey(str_random(32));
		$data['key'] = displayModel::getFormKey();
		return Redirect::to('/application-form/key/'.$data['key']->key.'');
	}
	
	public function deleteFormKey(){
		$data['delete'] = DeleteModel::deleteAllFormKey();
		return redirect()->back();
	}
	public function saveForm(Request $request){
		extract($_POST);
		$file = new FileController();
		
		//personal_info
		$data['basic_info']  = insertModel::insertToPersonalInfo($lname,$fname,$mname,$email,$address,$contact,$bday,$cstatus,"Applicant",$gender,'0',$position,$salary);
		$pid = DisplayModel::getLastPersonalInfoID();
		
		//login_info
		$data['login'] = insertModel::insertToLogin(str_random(8),Hash::make(str_random(32)),$pid->personal_info_id,'user',str_random(64));	
		
		//school bg
		for($ctr = 0; $ctr < count($school_name); $ctr++){
			$data['ed_bg'] = insertModel::insertEducBG($pid->personal_info_id,$school_name[$ctr],$school_from[$ctr],$school_to[$ctr]);
		}
		
		//employment bg
		for($ctr = 0; $ctr < count($emp_company_name); $ctr++){
			$data['emp_bg'] = insertModel::insertEmpBG($pid->personal_info_id,$emp_company_name[$ctr],$emp_position[$ctr],$emp_start[$ctr],$emp_end[$ctr],$reason[$ctr]);
		}
		
		//references
		for($ctr = 0; $ctr < count($ref_reference_name); $ctr++){
			$data['ref'] = insertModel::insertReference($pid->personal_info_id,$ref_reference_name[$ctr],$ref_position[$ctr],$ref_company_name[$ctr],$ref_contact[$ctr]);
		}
		
		//tests
		$data['test'] = insertModel::insertTests($pid->personal_info_id,$typing_test,$grammar_test,$listening_test,$personality_test,$iq_test,$eq_test);
		
		//upload files
		$file->uploadResume($request->file('resume'));
		$file->uploadPracticalExam($request->file('practical_files'));
		
		if($data['test']){
			Session::flash('success', 'Applicant added successfully!');
		}else{
			Session::flash('danger', 'Can not add Applicant!');
		}
		return redirect()->back();
	}

}
