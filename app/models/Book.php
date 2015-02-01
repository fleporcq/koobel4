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
 * @property float $average_rate
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Book whereAverageRate($value)
 * @method static \Illuminate\Database\Query\Builder|\Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Book whereUpdatedAt($value)
 * @property string $md5
 * @method static \Illuminate\Database\Query\Builder|\Book whereMd5($value)
 * @property string $description
 * @method static \Illuminate\Database\Query\Builder|\Book whereDescription($value) 
 */
class Book extends Eloquent implements SluggableInterface
{

    use SluggableTrait;


    protected $sluggable = array(
        'build_from' => 'title',
        'save_to' => 'slug',
    );

    const NO_COVER_FILE = "no-cover";
    const COVERS_DIRECTORY = "covers";

    public function authors()
    {
        return $this->belongsToMany('Author');
    }

    public function themes()
    {
        return $this->belongsToMany('Theme');
    }

    public function language()
    {
        return $this->belongsTo('Language');
    }
}
