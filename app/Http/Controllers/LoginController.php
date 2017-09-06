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
use App\Login;


class LoginController extends Controller{
	
	protected $pub;
	
	use AuthenticatesUsers; // for sendFailedLoginResponse()
	
	 
	public function __construct(){
		
		$this->middleware(function ($request, $next){
		
		//Public variables
		$title = DisplayModel::getSettingsViaMeta('site_name');
		$logo = DisplayModel::getSettingsViaMeta('site_logo');
		$favicon = DisplayModel::getSettingsViaMeta('favicon');
				
		$this->pub = array(
			'title' => $title->value,
			'logo'   => $logo->value
		);		
		
			//Redirect to Lockscreen if account is locked
			if(Session::has('locked')){
				if(Session::get('locked')){	
					//redirect to lockscreen
					return Redirect::to('/lock');
				}				
			}
			
			//Redirect to intended dashboard
			if(Session::has('role')){
				//die('Has Session.');
				if(Session::get('role') == 'admin'){	
					//redirect to admin
					return Redirect::to('/admin');
				}else if(Session::get('role') == 'user'){	
					//redirect to user	
					return Redirect::to('/user');
				}
			}
			return $next($request);
		});
	}
	
	public function index(){
		$data = $this->pub;
		$data['page'] = 'Login';
		$data['desc'] = '';
		return view('login.login',$data);
	}
	
	public function login(){
		extract($_POST);
		
		if(isset($remember_me)){
			$remember_me = true;
		}else{
			$remember_me = false;
		}
		
		//Authenticate Users
		 if(Auth::attempt(['username' => $username, 'password' => $password ,'status' =>1], $remember_me)){
			 
			//Model
			$user = DisplayModel::getUserViaID(Auth::id());
			$login = Login::find(Auth::id());
			
			//Session Variable
			$session = array(
				'pid'  => $user->personal_info_id,
				'role' => $login->role
			);
			
			//Put variable into session
			Session::put($session);
			
			//Redirect to intended dashboard
			if($session['role'] == 'admin'){
				return Redirect::to('/admin');
			}else if($session['role'] == 'users'){
				return Redirect::to('/user');
			}else{
				return $this->sendFailedLoginResponse(request());
			}
       }
		else{
			return $this->sendFailedLoginResponse(request());
		}
	}

	
}