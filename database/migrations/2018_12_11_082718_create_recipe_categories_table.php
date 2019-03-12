<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecipeCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recipe_categories', function(Blueprint $table)
		{
			$table->integer('recipe_id')->unsigned();
			$table->integer('categoryid')->unsigned()->index('fk_Incat');
			$table->timestamps();
			$table->primary(['recipe_id','categoryid']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recipe_categories');
	}

}
