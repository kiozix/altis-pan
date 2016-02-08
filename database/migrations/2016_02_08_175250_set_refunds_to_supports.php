<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetRefundsToSupports extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('supports', function(Blueprint $table)
		{
			$table->string('id_refunds');
			$table->string('admin_refunds');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('supports', function(Blueprint $table)
		{
			//
		});
	}

}
