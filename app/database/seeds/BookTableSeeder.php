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
            'authors' => array('Ken Follett'),
            'themes' => array('Roman historique'),
            'average_rate' => 4.8
        ));

        self::createBook(array(
            'title' => 'Le passage',
            'year' => 2011,
            'enabled' => true,
            'authors' => array('Justin Cronin'),
            'themes' => array('Thriller'),
            'average_rate' => 4.1
        ));

        self::createBook(array(
            'title' => 'Les douze',
            'year' => 2013,
            'enabled' => true,
            'authors' => array('Justin Cronin'),
            'themes' => array('Thriller'),
            'average_rate' => 3.2
        ));

        self::createBook(array(
            'title' => 'Seul sur mars',
            'year' => 2014,
            'enabled' => true,
            'authors' => array('Andy Weir'),
            'themes' => array('Science-fiction'),
            'average_rate' => 4.6
        ));

        self::createBook(array(
            'title' => 'Hush Hush : Tome 1',
            'enabled' => true,
            'authors' => array('Becca Fitzpatrick'),
            'themes' => array('Bit-lit'),
        ));

        self::createBook(array(
            'title' => 'Hush Hush : Tome 2',
            'enabled' => true,
            'authors' => array('Becca Fitzpatrick'),
            'themes' => array('Bit-lit'),
        ));

        self::createBook(array(
            'title' => 'Hush Hush : Tome 3',
            'enabled' => true,
            'authors' => array('Becca Fitzpatrick'),
            'themes' => array('Bit-lit'),
        ));

        self::createBook(array(
            'title' => 'Hush Hush : Tome 4',
            'enabled' => true,
            'authors' => array('Becca Fitzpatrick'),
            'themes' => array('Bit-lit'),
        ));

        self::createBook(array(
            'title' => 'Colonie : Tome 1',
            'enabled' => true,
            'authors' => array('Ben Bova'),
            'themes' => array('Science-fiction'),
        ));

        self::createBook(array(
            'title' => 'Colonie : Tome 2',
            'enabled' => true,
            'authors' => array('Ben Bova'),
            'themes' => array('Science-fiction'),
        ));

        self::createBook(array(
            'title' => 'Venus',
            'enabled' => true,
            'authors' => array('Ben Bova'),
            'themes' => array('Science-fiction'),
        ));

        self::createBook(array(
            'title' => 'Les micros humains',
            'enabled' => true,
            'authors' => array('Bernard Werber'),
            'themes' => array('Science-fiction', 'Fantastique'),
        ));

        self::copyCovers();

    }

    private function createBook($data)
    {

        $book = new Book();
        $book->title = $data["title"];

        if (isset($data["year"])) {
            $book->year = $data["year"];
        }
        if (isset($data["enabled"])) {
            $book->enabled = $data["enabled"];
        }
        if (isset($data["average_rate"])) {
            $book->average_rate = $data["average_rate"];
        }
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
            $coverFileName = app_path($covers_seeds_directory . DIRECTORY_SEPARATOR . $book->slug . ".jpg");
            if (File::exists($coverFileName)) {
                $cover = Image::make($coverFileName)->encode('jpg', 75);
                $cover->save(storage_path(Book::COVERS_DIRECTORY) . DIRECTORY_SEPARATOR . $book->slug . '.jpg');
            }
        }

        $noCoverFileName = app_path($covers_seeds_directory . DIRECTORY_SEPARATOR . Book::NO_COVER_FILE . ".jpg");
        if (File::exists($noCoverFileName)) {
            $noCover = Image::make($noCoverFileName)->encode('jpg', 75);
            $noCover->save(storage_path(Book::COVERS_DIRECTORY) . DIRECTORY_SEPARATOR . Book::NO_COVER_FILE .'.jpg');
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