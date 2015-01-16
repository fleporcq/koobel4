<?php

class Book extends Eloquent {

	public $timestamps = false;

	public function authors()
	{
		return $this->belongsToMany('Author');
	}

}
