<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
		if (!Schema::hasTable('departments')){
			Schema::create('departments', function (Blueprint $table) {
				$table->increments('department_id');
				$table->string('department_name');
				$table->string('department_desc');
				$table->integer('status')->default(1);
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
       // Schema::dropIfExists('departments');
    }
}
