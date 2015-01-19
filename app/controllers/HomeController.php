<?php

class HomeController extends BaseController {

	public function index()
	{
		$books = Book::whereEnabled(1)->get();
		return View::make('home/index', array('books' => $books));
	}

}
