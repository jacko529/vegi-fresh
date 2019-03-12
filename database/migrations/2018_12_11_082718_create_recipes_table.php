<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecipesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recipes', function(Blueprint $table)
		{
			$table->increments('recipe_id');
			$table->string('recipe_name', 191);
			$table->string('picture_location', 191);
			$table->integer('effort_level_id')->unsigned();
			$table->timestamps();
			$table->integer('code_id')->unsigned()->nullable();
			$table->integer('id')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recipes');
	}

}
