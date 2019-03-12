<?php

namespace Assignment;

use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    // Table Name
    protected $table = 'ingredients';
    // Primary Key
    public $primaryKey = 'Ingredient_id';
    // Timestamps
    public $timestamps = true;// //

    public function ingrediantRecipe(){
        return $this->hasMany('IngredientRecipe');
    }
}
