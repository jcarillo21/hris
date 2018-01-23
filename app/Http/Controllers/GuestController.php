<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests;

use Redirect;
use Session;
use Helper;

/**
 * Database Model
 */
use App\UpdateModel;
use App\InsertModel;
use App\DisplayModel;
use App\DeleteModel;

class GuestController extends Controller{
	
	protected $pub;
	
	public function __construct(){
		$this->middleware(function ($request, $next){

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
				'logo'   => $logo->value
			);
			return $next($request);
		});	
	}
	
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
		$data['basic_info']  = insertModel::insertToPersonalInfo($lname,$fname,$mname,$email,$address,$contact,$bday,$cstatus,"Applicant","Applicant",$gender,'0',$position,$salary);
		$pid = DisplayModel::getLastPersonalInfoID();
		
		//login_info
		$data['login'] = insertModel::insertToLogin(str_random(8),Hash::make(str_random(32)),$pid->personal_info_id,'user',str_random(64));	
		
		//school bg
		for($ctr_sc = 0; $ctr_sc < count($school_name); $ctr_sc++){
			$data['ed_bg'] = insertModel::insertEducBG($pid->personal_info_id,$school_name[$ctr_sc],$school_from[$ctr_sc],$school_to[$ctr_sc]);
		}
		//employment bg
		for($ctr_emp = 0; $ctr_emp < count($emp_company_name); $ctr_emp++){
			if(!isset($emp_end[$ctr_emp])){
				$emp_end[$ctr_emp] = 'N/A';
			}
			$data['emp_bg'] = insertModel::insertEmpBG($pid->personal_info_id,$emp_company_name[$ctr_emp],$emp_position[$ctr_emp],$emp_start[$ctr_emp],$emp_end[$ctr_emp],$reason[$ctr_emp]);
		}
		
		//references
		for($ctr_ref = 0; $ctr_ref < count($ref_reference_name); $ctr_ref++){
			$data['ref'] = insertModel::insertReference($pid->personal_info_id,$ref_reference_name[$ctr_ref],$ref_position[$ctr_ref],$ref_company_name[$ctr_ref],$ref_contact[$ctr_ref]);
		}
		
		//tests
		$data['test'] = insertModel::insertTests($pid->personal_info_id,$typing_test,$grammar_test,$listening_test,$personality_test,$iq_test,$eq_test);
		
		//upload files]
		if($request->file('resume')!=null){
			$file->uploadResume($request->file('resume'));
		}
		if($request->file('practical_files')!=null){
			$file->uploadPracticalExam($request->file('practical_files'));
		}
		
		if($data['test']){	
			//Send Email
			$data = $this->pub;
			$helper = $data['helper'];
			$company = DisplayModel::getSettingsViaMeta('company_name');
			$pos = DisplayModel::getJobViaID($position);
			
			$data['name'] = $fname.' '.$mname.' '.$lname;
			$data['email'] = $email;
			$data['contact'] = $contact;
			$data['position'] = $pos->job_title;
			$data['company'] = $company->value;
			
			$recipient = DisplayModel::getSettingsViaMeta('email_recipient');
			$helper->sendEmailWithCC($recipient->value,view('mail.add-applicant',$data));				

			Session::flash('success', 'Applicant added successfully!');
		}else{
			Session::flash('danger', 'Can not add Applicant!');
		}
		return redirect()->back();
	}

}
