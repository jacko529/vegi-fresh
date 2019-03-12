<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMethodTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('method', function(Blueprint $table)
		{
			$table->foreign('method_id', 'fk_method')->references('recipe_id')->on('recipes')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('method', function(Blueprint $table)
		{
			$table->dropForeign('fk_method');
		});
	}

}
