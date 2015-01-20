<?php

class BookController extends BaseController
{

    public function cover($slug)
    {
        if ($slug == null) {
            App::abort(404);
        }

        try {
            $cover = Image::make(storage_path(Book::COVERS_DIRECTORY . DIRECTORY_SEPARATOR . $slug . ".jpg"));
        } catch (Intervention\Image\Exception\NotReadableException $exception) {
            App::abort(404);
        }

        return $cover->response();
    }

    public function get(){
        $books = Book::with('authors', 'themes')->whereEnabled(true)->paginate(10);
        return Response::json($books);
    }
}
