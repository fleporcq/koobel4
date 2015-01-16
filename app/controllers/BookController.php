<?php

class BookController extends BaseController {

	public function index()
	{
		return View::make('book/index');
	}

}
