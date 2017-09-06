<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationalBackground extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
		if (!Schema::hasTable('educational_background')){
			Schema::create('educational_background', function (Blueprint $table) {
				$table->increments('educational_background_id');
				$table->integer('personal_info_id');
				$table->string('school_name'); 
				$table->year('from'); 
				$table->year('to'); 
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
