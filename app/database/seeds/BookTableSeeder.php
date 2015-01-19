<?php

class BookTableSeeder extends Seeder
{

    public function run()
    {

        self::clean();

        self::createBook(array(
            'title' => 'Les piliers de la terre',
            'year' => 1989,
            'enabled' => true,
            'authors' => array('Ken Follet'),
            'themes' => array('Roman historique'),
        ));

        self::createBook(array(
            'title' => 'Le passage',
            'year' => 2011,
            'enabled' => true,
            'authors' => array('Justin Cronin'),
            'themes' => array('Thriller'),
        ));

        self::copyCovers();

    }

    private function createBook($data)
    {

        $book = new Book();
        $book->title = $data["title"];
        $book->year = $data["year"];
        $book->enabled = $data["enabled"];
        $book->save();

        foreach ($data["authors"] as $author) {
            $book->authors()->attach(Author::firstOrCreate(array('name' => $author))->id);
        }

        foreach ($data["themes"] as $theme) {
            $book->themes()->attach(Theme::firstOrCreate(array('name' => $theme))->id);
        }

    }

    private function copyCovers()
    {

        $covers_seeds_directory = "database" . DIRECTORY_SEPARATOR . "seeds" . DIRECTORY_SEPARATOR . "covers";
        foreach (Book::all() as $book) {
            $cover = Image::make(app_path($covers_seeds_directory . DIRECTORY_SEPARATOR . $book->slug . ".jpg"))->encode('jpg', 75);
            $cover->save(storage_path(Book::COVERS_DIRECTORY) . DIRECTORY_SEPARATOR . $book->id . "-" . $book->slug . '.jpg');
        }

    }

    private function clean()
    {

        DB::table('author_book')->delete();
        DB::table('authors')->delete();
        DB::table('book_theme')->delete();
        DB::table('themes')->delete();
        DB::table('books')->delete();
        File::cleanDirectory(storage_path(Book::COVERS_DIRECTORY));
        
    }
}