<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
		if (!Schema::hasTable('form_key')){
			Schema::create('form_key', function (Blueprint $table) {
				$table->increments('form_key_id');
				$table->string('key');
				$table->string('status')->default(1); 
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
