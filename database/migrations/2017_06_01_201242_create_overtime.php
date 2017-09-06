<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOvertime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
		if (!Schema::hasTable('overtime')){
			Schema::create('overtime', function (Blueprint $table){
				$table->increments('overtime_id');
				$table->integer('personal_info_id'); 
				$table->integer('hours'); 
				$table->string('reasons'); 
				$table->date('date_requested'); 
				$table->string('client'); 
				$table->integer('status')->default(0); 
				$table->integer('reviewed_by')->nullable(); 
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
