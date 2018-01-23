<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
		if (!Schema::hasTable('attendance')){
			Schema::create('attendance', function (Blueprint $table){
				$table->increments('attendance_id');
				$table->integer('personal_info_id'); 
				$table->date('date'); 
				$table->string('timetable'); 
				$table->time('clock_in'); 
				$table->time('clock_out'); 
				$table->timestamp('uploaded_at')->useCurrent();
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
