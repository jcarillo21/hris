<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
		if (!Schema::hasTable('users')){
			Schema::create('users', function (Blueprint $table) {
				$table->increments('personal_info_id');
				$table->integer('department_id');
				$table->integer('job_id');
				$table->string('fname');
				$table->string('mname');
				$table->string('lname');
				$table->integer('salary')->nullable();
				$table->string('display_pic')->nullable();
				$table->string('email_address');
				$table->string('address');
				$table->string('contact_number');
				$table->string('gender');
				$table->date('birthday'); 
				$table->string('resume')->nullable();
				$table->string('civil_status');
				$table->string('employment_status');
				$table->string('user_role'); //For User Table  (Admin or Employee)
				$table->timestamp('created_at')->useCurrent();
			});
			DB::table('users')->insert(
				array(
					array(
						'department_id' => '0',
						'job_id' => '0',
						'fname' => 'John',
						'mname' => 'Z.',
						'lname' => 'Doe',
						'display_pic' => 'default.png',
						'email_address' => 'johnperricruz@gmail.com',
						'address' => 'Philippines',
						'contact_number' => '09089359789',
						'gender' => 'Male',
						'birthday' => '1994-12-30',
						'contact_number' => '09089359789',
						'resume' => '',
						'civil_status' => 'Single',
						'user_role' => 'Admin',
						'salary' => '000',
						'employment_status' => 'Regular'
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
    public function down()
    {
      //  Schema::dropIfExists('users');
    }
}
