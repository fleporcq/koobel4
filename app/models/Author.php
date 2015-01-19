<?php

/**
 * Author
 *
 * @property integer $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\Book[] $books
 * @method static \Illuminate\Database\Query\Builder|\Author whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Author whereName($value) 
 * @method static \Author findByName($name) 
 */
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
