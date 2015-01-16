<?php

class Author extends Eloquent {

	public $timestamps = false;

	public function books()
	{
		return $this->belongsToMany('Book');
	}

	public function scopeFindByName($query, $name)
	{
		return $query->whereName($name)->firstOrFail();
	}
}
