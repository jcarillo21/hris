<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaves extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
		if (!Schema::hasTable('leaves')){
			Schema::create('leaves', function (Blueprint $table){
				$table->increments('leave_id');
				$table->integer('personal_info_id'); 
				$table->date('from'); 
				$table->date('to'); 
				$table->string('leave_type'); 
				$table->string('reasons'); 
				$table->integer('status')->default(0); 
				$table->integer('reviewed_by')->nullable(); //logged in personal_info_id
				$table->string('file_attachment')->nullable();// url of mercert, etc..
				$table->timestamp('generated_at')->useCurrent();
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
