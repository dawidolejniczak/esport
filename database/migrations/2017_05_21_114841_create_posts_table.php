<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100)->unique();
            $table->string('image')->nullable();
            $table->enum('status', ['Hot', 'Queue'])->default('Queue');
            $table->string('youTube')->nullable();
            $table->string('embeddedCode')->nullable();
            $table->dateTime('date');
            $table->integer('user_id');
            $table->softDeletes();
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}

}
