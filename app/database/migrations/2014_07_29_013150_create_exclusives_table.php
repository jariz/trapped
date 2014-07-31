<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExclusivesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("exclusives", function(Blueprint $blueprint) {
            $blueprint->increments("id");
            $blueprint->string("title");
            $blueprint->string("link");
            $blueprint->string("slug");
            $blueprint->text("desc");
            $blueprint->string("art");
            $blueprint->softDeletes();
            $blueprint->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("exclusives");
	}

}
