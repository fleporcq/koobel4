<?php

class KoobeController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('auth');

        View::share('appName', Config::get('app.name'));
        View::share('currentAction', Route::current()->getActionName());
    }

    protected function notFoundIfNull($object)
    {
        if ($object == null) {
            App::abort(404);
        }
    }
}