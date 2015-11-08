<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->dropColumn('body');
            $table->dropColumn('name');
            $table->dropColumn('pictures');
            $table->dropColumn('price');
            $table->text('data');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('products', function(Blueprint $table)
		{
            $table->string('name', 50);
            $table->text('body');
            $table->string('pictures', 256);
            $table->float('price');
            $table->dropColumn('data');
		});
	}

}
