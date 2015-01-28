<?php

class HomeController extends KoobeController {

	public function index()
	{
		return View::make('home/index');
	}

}
