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
			$table->string('slug');
			$table->smallInteger('year')->nullable()->unsigned();
			$table->boolean('enabled')->default(false);
			$table->decimal('average_rate', 2, 1)->unsigned();
			$table->timestamps();
		});

		Schema::create('authors', function($table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('slug')->unique();
			$table->timestamps();
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
			$table->timestamps();
		});

		Schema::create('book_theme', function($table)
		{
			$table->integer('book_id')->unsigned();
			$table->foreign('book_id')->references('id')->on('books');
			$table->integer('theme_id')->unsigned();
			$table->foreign('theme_id')->references('id')->on('themes');
		});

		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('remember_token')->nullable();
			$table->timestamps();
		});

		Schema::create('rates', function($table)
		{
			$table->integer('book_id')->unsigned();
			$table->foreign('book_id')->references('id')->on('books');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users');
			$table->tinyInteger('rate');
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
		Schema::drop('author_book');

		Schema::drop('authors');

		Schema::drop('book_theme');

		Schema::drop('themes');

		Schema::drop('rates');

		Schema::drop('books');

		Schema::drop('users');

	}

}
