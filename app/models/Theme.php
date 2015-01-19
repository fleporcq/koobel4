<?php

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

/**
 * Theme
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @method static \Illuminate\Database\Query\Builder|\Theme whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Theme whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Theme whereSlug($value)
 */
class Theme extends Eloquent implements SluggableInterface
{

    use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'name',
        'save_to' => 'slug',
    );

    public $timestamps = false;

}
