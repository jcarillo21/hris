<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
		if (!Schema::hasTable('jobs')){
			Schema::create('jobs', function (Blueprint $table) {
				$table->increments('job_id');
				$table->integer('department_id');
				$table->string('job_title');
				$table->string('job_desc');
				$table->integer('status')->default(1);;
				$table->timestamps();  
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
         //Schema::dropIfExists('jobs');
    }
}
