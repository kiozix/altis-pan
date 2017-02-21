<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('forums', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id')->index();
			$table->string('name');
			$table->string('slug');
			$table->string('description');
			$table->string('icon');
			$table->integer('order')->default(0);
			$table->boolean('moderator_see')->nullable();
			$table->boolean('moderator_post')->nullable();
			$table->boolean('support_see')->nullable();
			$table->boolean('support_post')->nullable();
			$table->boolean('cop_see')->nullable();
			$table->boolean('cop_post')->nullable();
			$table->boolean('medic_see')->nullable();
			$table->boolean('medic_post')->nullable();
			$table->integer('gang_see')->nullable();
			$table->integer('gang_post')->nullable();
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
		Schema::drop('forums');
	}

}
