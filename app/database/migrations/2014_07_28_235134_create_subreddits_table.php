<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubredditsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("subreddits", function(Blueprint $blueprint) {
            $blueprint->increments('id');
            $blueprint->timestamps();
            $blueprint->string("name");
            $blueprint->string("label");
            $blueprint->softDeletes();
        });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("subreddits");
	}

}
