<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Authenticatable{
	protected $table = 'logins';
	protected $primaryKey = 'login_id';
}
