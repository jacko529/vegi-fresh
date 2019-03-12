<?php

namespace Assignment;

use Illuminate\Database\Eloquent\Model;

class Ingredient_recipe extends Model
{
    protected $table = 'ingredient_recipe';

    public $timestamps = true;//

    public $primaryKey = 'ingredient_recipe_id';


    public function ingredient(){
        return $this->belongsTo('Assignment\Ingredients');
    }
}
