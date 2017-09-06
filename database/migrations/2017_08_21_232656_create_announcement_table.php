<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('announcement')){
			Schema::create('announcement', function (Blueprint $table){
				$table->increments('announcement_id');
				$table->integer('personal_info_id'); 
				$table->string('title'); 
				$table->string('content',1000); 
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
