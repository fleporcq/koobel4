<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Initial extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('books', function($table)
		{
			$table->increments('id');
			$table->string('title');
			$table->smallInteger('year')->nullable()->unsigned();
			$table->boolean('enabled')->default(false);
		});

		Schema::create('authors', function($table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('slug')->unique();
		});

		Schema::create('author_book', function($table)
		{
			$table->integer('author_id')->unsigned();
			$table->foreign('author_id')->references('id')->on('authors');
			$table->integer('book_id')->unsigned();
			$table->foreign('book_id')->references('id')->on('books');
		});

		Schema::create('themes', function($table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('slug')->unique();
		});

		Schema::create('book_theme', function($table)
		{
			$table->integer('book_id')->unsigned();
			$table->foreign('book_id')->references('id')->on('books');
			$table->integer('theme_id')->unsigned();
			$table->foreign('theme_id')->references('id')->on('themes');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('author_book');

		Schema::drop('authors');

		Schema::drop('book_theme');

		Schema::drop('themes');

		Schema::drop('books');

	}

}
