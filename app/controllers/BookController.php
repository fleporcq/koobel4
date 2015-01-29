<?php

class BookController extends KoobeController
{

    public function cover($name)
    {
        if ($name == null) {
            App::abort(404);
        }

        $coverFileName = storage_path(Book::COVERS_DIRECTORY . DIRECTORY_SEPARATOR . $name . ".jpg");
        $noCoverFileName = storage_path(Book::COVERS_DIRECTORY . DIRECTORY_SEPARATOR . "" . Book::NO_COVER_FILE . ".jpg");

        if (File::exists($coverFileName)) {
            $cover = Image::make($coverFileName);
        } else {
            if (File::exists($noCoverFileName)) {
                $cover = Image::make($noCoverFileName);
            } else {
                App::abort(404);
            }
        }

        return $cover->response();
    }

    public function get()
    {
        $books = Book::with('authors', 'themes')->whereEnabled(true)->paginate(10);
        return Response::json($books);
    }

    public function push(){
        $file = storage_path("epubs".DIRECTORY_SEPARATOR."1.epub");
        if(File::exists($file)){
            Queue::push('BookParser', array('file' => $file));
        }
    }
}
