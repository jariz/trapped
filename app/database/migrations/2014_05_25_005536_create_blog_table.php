<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("blog", function(Blueprint $blueprint) {
            $blueprint->increments("id");
            $blueprint->integer("user_id");
            $blueprint->string("title");
            $blueprint->text("content");
            $blueprint->timestamps();
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
		Schema::drop("blog");
	}

}
