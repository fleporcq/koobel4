<?php
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

/**
 * Book
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Author[] $authors
 * @property-read \Illuminate\Database\Eloquent\Collection|\Themes[] $themes
 * @property integer $id
 * @property string $title
 * @property integer $year
 * @property boolean $enabled
 * @method static \Illuminate\Database\Query\Builder|\Book whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Book whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\Book whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|\Book whereEnabled($value)
 * @property string $slug
 * @method static \Illuminate\Database\Query\Builder|\Book whereSlug($value) 
 */
class Book extends Eloquent implements SluggableInterface
{

    use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'title',
        'save_to' => 'slug',
    );

    const COVERS_DIRECTORY = "covers";

    public $timestamps = false;

    public function authors()
    {
        return $this->belongsToMany('Author');
    }

    public function themes()
    {
        return $this->belongsToMany('Theme');
    }

}
