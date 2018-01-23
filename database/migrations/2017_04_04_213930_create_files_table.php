<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
		if (!Schema::hasTable('files')){
			Schema::create('files', function (Blueprint $table) {
				$table->increments('file_id');
				$table->string('file_name');
				$table->string('file_size'); 
				$table->string('extension'); 
				$table->integer('status')->default(1);
				$table->string('uploaded_by');
				$table->timestamp('created_at')->useCurrent();
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
