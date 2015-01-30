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
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Theme whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Theme whereUpdatedAt($value)
 */
class Theme extends Eloquent implements SluggableInterface
{

    use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'name',
        'save_to' => 'slug',
    );

    protected $hidden = array('pivot');

    protected $fillable = array('name');

}
