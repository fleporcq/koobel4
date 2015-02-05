<?php

/**
 * Language
 *
 * @property integer $id
 * @property string $lang
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Language whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\Language whereLang($value) 
 * @method static \Illuminate\Database\Query\Builder|\Language whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\Language whereUpdatedAt($value) 
 */
class Language extends Eloquent
{
    protected $fillable = array('lang');
}