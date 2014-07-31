<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRedditThreadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create("threads", function(Blueprint $blueprint) {
            $blueprint->integer("id", true);
//            $blueprint->primary("id");
            $blueprint->string("title");
            $blueprint->string("url");
            $blueprint->integer("created");
            $blueprint->timestamps();
            $blueprint->string("embed_thumbnail");
            $blueprint->string("embed_title");
            $blueprint->string("embed_desc");
            $blueprint->integer("votes");
            $blueprint->string("subreddit");
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop("threads");
	}

}
