<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
		if (!Schema::hasTable('logins')){
			Schema::create('logins', function (Blueprint $table) {
				$table->increments('login_id');
				$table->integer('personal_info_id');
				$table->string('username')->unique();
				$table->string('password');
				$table->string('key');
				$table->integer('status')->default(1);
				$table->string('remember_token')->nullable();
				$table->string('role');//For Login (admin or user)
				$table->timestamps();
			});
			DB::table('logins')->insert(
				array(
					array(
						'personal_info_id' => '1',
						'username' => 'admin',
						'password' => '$2a$06$uiVWPfGKOkdeH2NlcFn5Me.4yuktz0Ok2VGR7K8rXl4vx0WyYO0Ou', //1234
						'key' => '$2a$06$Ct5.aTV1x.dSUMoEBxA1FuogNM1xx6E9EnSOrYO7s0WYEDreGIiFi',
						'role' => 'admin',
						'remember_token' => '2OfjZVdnMp5rhvXNAfCRDzj56c31y2DFuR2cHiWez6hPS9f5WieRvUL99jzb',
					)
				)
			);	
		}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        //Schema::dropIfExists('logins');
    }
}
