<?php
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

/**
 * Author
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\Book[] $books
 * @method static \Illuminate\Database\Query\Builder|\Author whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Author whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Author whereSlug($value)
 */
class Author extends Eloquent implements SluggableInterface
{

    use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'name',
        'save_to' => 'slug',
    );

    public $timestamps = false;

    public function books()
    {
        return $this->belongsToMany('Book');
    }

}
