<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
		if (!Schema::hasTable('test')){
			Schema::create('test', function (Blueprint $table) {
				$table->increments('test_id');
				$table->integer('personal_info_id');
				$table->string('typing_test'); 
				$table->string('grammar_test'); 
				$table->string('listening_test'); 
				$table->string('personality_test');
				$table->string('iq_test');
				$table->string('eq_test');
				$table->string('practical_test')->nullable();
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
