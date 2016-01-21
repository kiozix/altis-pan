<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefundsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('refunds', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('playerid');
			$table->string('name');
			$table->string('amount');
			$table->string('content');
			$table->string('status')->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('refunds');
	}

}
