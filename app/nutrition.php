<?php
/**
 * Created by PhpStorm.
 * User: churc
 * Date: 18/02/2019
 * Time: 10:42
 */

namespace Assignment;

use Illuminate\Database\Eloquent\Model;


class nutrition extends Model
{


    protected $table = 'nutrition';
    // Primary Key
    public $primaryKey = 'recipe_id';


    protected $fillable = [
        'Calories', 'Sodium', 'Fat','protein', 'carbs', 'fibre','recipe_id',
    ];
}