<?php

namespace Assignment;

use Illuminate\Database\Eloquent\Model;

class recipe extends Model
{
    protected $table = 'recipes';

    public $primaryKey = 'recipe_id';

    public $timestamps = true; //
}
