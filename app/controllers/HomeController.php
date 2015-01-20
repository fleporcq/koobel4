<?php

class HomeController extends BaseController {

	public function index()
	{
		$books = Book::whereEnabled(true)->get();
		return View::make('home/index', array('books' => $books));
	}

}
