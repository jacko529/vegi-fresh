<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRecipesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('recipes', function(Blueprint $table)
		{
			$table->foreign('recipe_id', 'fk_recipeCode')->references('code_id')->on('code')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('recipe_id', 'fk_recipe_effort')->references('effort_level_id')->on('effort_level')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('recipe_id', 'fk_recipe_user')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('recipes', function(Blueprint $table)
		{
			$table->dropForeign('fk_recipeCode');
			$table->dropForeign('fk_recipe_effort');
			$table->dropForeign('fk_recipe_user');
		});
	}

}
