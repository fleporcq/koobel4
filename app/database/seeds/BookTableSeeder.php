<?php
class BookTableSeeder extends Seeder {

    public function run()
    {
        DB::table('books')->delete();

        $book = Book::create(array(
            'title' => 'Les piliers de la terre',
            'year' => 2012
        ));
        $book->authors()->sync([Author::findBySlug("ken-follet")->id]);
        $book->themes()->sync([Theme::findBySlug("roman-historique")->id]);

        $book = Book::create(array(
            'title' => 'Poussière de lune',
            'year' => 1998
        ));
        $book->authors()->sync([Author::findBySlug("stephen-baxter")->id]);
        $book->themes()->sync([Theme::findBySlug("thriller")->id]);
    }

}