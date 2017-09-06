<?php

namespace App\Http\Controllers;

/**
 * Traits
 */
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * Helpers
 */
use Session;
use Redirect;

/**
 * Database Model
 */
use App\UpdateModel;
use App\DisplayModel;

class LockScreenController extends Controller{
	
	use AuthenticatesUsers; // for sendFailedLoginResponse()
	
	protected $pub;
	
	 
	
	public function __construct(){
		
		$this->middleware(function ($request, $next){
			
			$user  = DisplayModel::getUserViaID(Auth::id());
			$title = DisplayModel::getSettingsViaMeta('site_name');
			$favicon = DisplayModel::getSettingsViaMeta('favicon');
			
			//Public variables
			$this->pub = array(
				'pub' =>  $this->pub,
				'page' => 'Lock',
				'name' => $user->fname.' '.$user->lname,
				'username' => $user->username,
				'dp' => $user->display_pic,
				'title' => $title->value
			);	
			return $next($request);
		});
		
	}	
	
	public function lockScreen(){
		//lock account
		if(Session::has('pid')){
			$data = $this->pub;
			Session::put('locked',true);
			return view('login.lock',$data);
		}else{
			return Redirect::to('/');
		}		
	}
	
	public function signin(){
		extract($_POST);
		//Authenticate Users
		if(Auth::attempt(['username' => $username, 'password' => $password ,'status' =>1])){
			Session::forget('locked');
			return Redirect::to('/');
		}
		else{
			return $this->sendFailedLoginResponse(request());
		}
	}
}