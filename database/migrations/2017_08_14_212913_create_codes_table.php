<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('codes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('reference', 65);
			$table->integer('merchant_id');
			$table->boolean('legacy')->nullable()->default(1);
			$table->string('name', 55)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('codes');
	}

}
