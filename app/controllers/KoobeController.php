<?php

class KoobeController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('auth');
    }

    protected function notFoundIfNull($object)
    {
        if ($object == null) {
            App::abort(404);
        }
    }
}