<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayslip extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
		if (!Schema::hasTable('payslip')){
			Schema::create('payslip', function (Blueprint $table) {
				$table->increments('payslip_id');
				$table->integer('personal_info_id'); 
				$table->date('from'); 
				$table->date('to'); 
				$table->string('tax_status'); 
				$table->float('basic_pay'); 
				$table->float('night_diff'); 
				$table->float('ot_pay'); 
				$table->float('holiday_pay'); 
				$table->float('dm'); 
				$table->float('cola'); 
				$table->float('bonus'); 
				$table->float('wtax'); 
				$table->float('sss'); 
				$table->float('philhealth'); 
				$table->float('pagibig'); 
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
