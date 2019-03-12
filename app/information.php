<?php

namespace Assignment;

use Illuminate\Database\Eloquent\Model;

class information extends Model
{
    protected $table = 'information';
    public $primaryKey = 'recipe_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recipe_id', 'recipe_name', 'picture_location','length_of_time', 'categoryName', 'code','code_allowed', 'difficulty',
    ];


}
