<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffensesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('offenses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('arma_id');
			$table->text('content');
			$table->text('sanction');
			$table->text('author');
			$table->text('author_id');
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
		Schema::drop('offenses');
	}

}
