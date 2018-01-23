<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploymentBg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
		if (!Schema::hasTable('employment_background')){
			Schema::create('employment_background', function (Blueprint $table) {
				$table->increments('employment_id');
				$table->integer('personal_info_id');
				$table->string('company_name'); 
				$table->string('position'); 
				$table->string('from'); 
				$table->string('to'); 
				$table->string('reason_of_leaving'); 
			});
		}
    }

    /** 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
