<?php
class AuthorTableSeeder extends Seeder {

    public function run()
    {
        DB::table('author_book')->delete();
        DB::table('authors')->delete();

        Author::create(array(
            'name' => 'Ken Follet'
        ));
        Author::create(array(
            'name' => 'Stephen Baxter'
        ));
    }

}