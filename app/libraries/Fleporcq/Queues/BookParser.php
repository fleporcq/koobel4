<?php
namespace Fleporcq\Queues;

use Author;
use Book;
use Chumper\Zipper\Zipper;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Theme;

class BookParser
{
    const EXTENSION = "epub";

    const CONTAINER_FILE_PATH = 'META-INF/container.xml';

    public function fire($job, $data)
    {
        $file = $data["file"];
        if (File::exists($file) && File::extension($file) === self::EXTENSION) {
            $metadata = $this->extractMetadata($file);
            if ($metadata) {
                $this->createBook($metadata);
            } else {
                //Todo File::delete($file);
            }
            $job->delete();
        } else {
            return Log::error($file . ' not found. ');
        }
    }

    protected function extractMetadata($file)
    {
        $metadata = null;
        $zipper = new Zipper();
        $zipper->make($file);
        try {
            $containerFile = $zipper->getFileContent(self::CONTAINER_FILE_PATH);
        } catch (Exception $e) {
            return Log::error($file . " - " . CONTAINER_FILE_PATH . ' not found. ' . $e);
        }
        $container = simplexml_load_string($containerFile);
        $rootFilePath = $container->rootfiles->rootfile['full-path'];

        try {
            $rootFile = $zipper->getFileContent($rootFilePath);
        } catch (Exception $e) {
            return Log::error($file . " - " . CONTAINER_FILE_PATH . ' not found. ' . $e);
        }
        $md5 = md5($rootFile);
        if (Book::whereMd5($md5)->count() == 0) {
            $package = simplexml_load_string($rootFile);
            $dc = $package->metadata->children('dc', true);
            $metadata = (object)array(
                'dc' => $dc,
                'md5' => $md5
            );
        }else{
            //Todo message 'Book already in DB'
        }
        return $metadata;
    }

    protected function createBook($metadata)
    {
        $dc = $metadata->dc;

        $book = new Book();
        $book->md5 = $metadata->md5;
        $book->title = $this->sanitize($dc->title, true);
        $book->description = $this->sanitize($dc->description);
        $year = substr($dc->date, 0, 4);

        $book->year = is_numeric($year) && strlen($year) == 4 ? $year : null;

        $book->save();

        $authors = array();
        foreach ($dc->creator as $author) {
            $authors[] = $author;
        }

        $themes = array();
        $themes[] = $dc->type;
        foreach ($dc->subject as $subject) {
            $themes[] = $subject;
        }

        foreach ($authors as $author) {
            $author = $this->sanitize($author, true);
            if (!empty($author)) {
                $book->authors()->attach(Author::firstOrCreate(array('name' => $author))->id);
            }
        }

        foreach ($themes as $theme) {
            $theme = $this->sanitize($theme, true);
            if (!empty($theme)) {
                $book->themes()->attach(Theme::firstOrCreate(array('name' => $theme))->id);
            }
        }
    }

    protected function sanitize($string, $capitalize = false)
    {
        $string = trim(strip_tags($string), '/[^a-zA-Z0-9 ]/');
        if ($capitalize) {
            $string = ucfirst(strtolower($string));
        }
        return $string;
    }
}