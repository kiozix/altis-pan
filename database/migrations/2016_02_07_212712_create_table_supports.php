<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSupports extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('supports', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('id_author');
			$table->string('message');
			$table->string('title');
			$table->string('reply');
			$table->string('associated');
			$table->longText('content');
			$table->string('etat');
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
		Schema::drop('supports');
	}

}
