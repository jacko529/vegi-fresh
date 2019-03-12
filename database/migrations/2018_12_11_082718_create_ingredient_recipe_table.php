<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIngredientRecipeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ingredient_recipe', function(Blueprint $table)
		{
			$table->integer('recipe_id')->unsigned();
			$table->integer('Ingredient_id')->unsigned()->index('fk_Incat1');
			$table->string('quantities', 40)->nullable();
			$table->integer('cat_id');
			$table->timestamps();
			$table->primary(['recipe_id','Ingredient_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ingredient_recipe');
	}

}
