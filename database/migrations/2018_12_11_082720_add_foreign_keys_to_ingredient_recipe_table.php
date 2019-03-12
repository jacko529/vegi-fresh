<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIngredientRecipeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ingredient_recipe', function(Blueprint $table)
		{
			$table->foreign('Ingredient_id', 'fk_Incat1')->references('Ingredient_id')->on('ingredients')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('recipe_id', 'fk_repCat1')->references('recipe_id')->on('recipes')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ingredient_recipe', function(Blueprint $table)
		{
			$table->dropForeign('fk_Incat1');
			$table->dropForeign('fk_repCat1');
		});
	}

}
