<?php

class BookController extends KoobeController
{

    public function cover($slug)
    {
        self::notFoundIfNull($slug);

        $coverFileName = storage_path(Book::COVERS_DIRECTORY . DIRECTORY_SEPARATOR . $slug . ".jpg");
        $noCoverFileName = storage_path(Book::COVERS_DIRECTORY . DIRECTORY_SEPARATOR . Book::NO_COVER_FILE . ".jpg");

        if (File::exists($coverFileName)) {
            $cover = Image::make($coverFileName);
        } else if (File::exists($noCoverFileName)) {
            $cover = Image::make($noCoverFileName);
        } else {
            App::abort(404);
        }

        return $cover->response();
    }

    public function get()
    {
        $books = Book::with('authors', 'themes')->whereEnabled(true)->paginate(20);
        return Response::json($books);
    }

    public function upload()
    {
        return View::make('book/upload');
    }

    public function flow()
    {
        $request = new Flow\Request();
        $destination = storage_path('/epubs/' . uniqid() . '.epub');
        $config = new Flow\Config(array(
            'tempDir' => storage_path('/epubs/chunks')
        ));
        $file = new Flow\File($config, $request);
        $response = Response::make('', 200);

        if (Request::isMethod('get')) {
            if (!$file->checkChunk()) {
                return Response::make('', 204);
            }
        } else {
            if ($file->validateChunk()) {
                $file->saveChunk();
            } else {
                // error, invalid chunk upload request, retry
                return Response::make('', 400);
            }
        }
        if ($file->validateFile() && $file->save($destination)) {

            Queue::push('BookParser', array('file' => $destination));

            $response = Response::make('pass some success message to flow.js', 200);
        }
        return $response;
    }
}
