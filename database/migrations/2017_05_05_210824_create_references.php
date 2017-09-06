<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
		if (!Schema::hasTable('references')){
			Schema::create('references', function (Blueprint $table) {
				$table->increments('reference_id');
				$table->integer('personal_info_id');
				$table->string('name_of_reference'); 
				$table->string('position'); 
				$table->string('company_name'); 
				$table->string('contact_number'); 
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
