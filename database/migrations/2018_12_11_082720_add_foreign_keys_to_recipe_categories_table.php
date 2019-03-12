<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRecipeCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('recipe_categories', function(Blueprint $table)
		{
			$table->foreign('categoryid', 'fk_Incat')->references('categoryid')->on('categories')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('recipe_id', 'fk_repCat')->references('recipe_id')->on('recipes')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('recipe_categories', function(Blueprint $table)
		{
			$table->dropForeign('fk_Incat');
			$table->dropForeign('fk_repCat');
		});
	}

}
