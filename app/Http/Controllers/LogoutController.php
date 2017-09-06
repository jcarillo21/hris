<?php

namespace App\Http\Controllers;

use Session;
use Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller{
	
	public function logout(){
		Auth::logout();
		Session::flush();
		return Redirect::to('/');
	}
	
}