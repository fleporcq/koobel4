<?php
class BookTableSeeder extends Seeder {

    public function run()
    {
        DB::table('books')->delete();

        Book::create(array(
            'title' => 'Les piliers de la terre',
            'year' => 2012
        ))->authors()->sync([Author::findByName("Ken Follet")->id]);

        Book::create(array(
            'title' => 'Poussière de lune',
            'year' => 1998
        ))->authors()->sync([Author::findByName("Stephen Baxter")->id]);
    }

}