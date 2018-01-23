<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
		if (!Schema::hasTable('settings')){
			Schema::create('settings', function (Blueprint $table) {
				$table->increments('settings_id');
				$table->string('settings_name')->unique();
				$table->string('value');
				$table->string('status')->default(1);;
			});
			DB::table('settings')->insert(
				array(
					array(
						'settings_name' => 'favicon',
						'value' => 'favicon.png'
					),
					array(
						'settings_name' => 'site_name',
						'value' => 'CiceroHR'
					),
					array(
						'settings_name' => 'site_logo',
						'value' => 'ceciro.png'
					),
					array(
						'settings_name' => 'email_sender',
						'value' => 'cicerohr@johnperricruz.com'
					),
					array(
						'settings_name' => 'date_format',
						'value' => 'M d Y'
					),
					array(
						'settings_name' => 'company_name',
						'value' => 'Company'
					)
				)
			);		
		 }
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('settings');
    }
}
