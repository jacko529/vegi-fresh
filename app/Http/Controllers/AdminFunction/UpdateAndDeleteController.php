<?php
/**
 * class which deals with all types of update and delete recipe functions
 *
 *
 *
 * Created by PhpStorm.
 * User: churc
 * Date: 13/02/2019
 * Time: 11:38
 */

namespace Assignment\Http\Controllers;

use Assignment\Category;
use Assignment\Effort_level;
use Assignment\Http\Requests;
use Assignment\information;
use Assignment\Ingredient_recipe;
use Assignment\Method;
use Assignment\nutrition;
use Assignment\popularIngredient;
use Assignment\recipe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
Use Exception;


class UpdateAndDeleteController extends Controller

{
    protected $route_path = "updateAndDelete";
    protected $destroyedId;
    private $popularIngredient;

    /**
     * UpdateAndDeleteController constructor.
     * ensure the auth middleware is needed
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     *
     *
     * Delete recipe from database
     *
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($deletedRecipeID)
    {
        recipe::find($deletedRecipeID)->delete();
        return redirect()->route($this->route_path . '.index')
            ->with('success', 'Item deleted successfully');
    }


    /**
     *
     *
     * Display most popular ingredient
     *
     * @return popularIngredient[]|\Illuminate\Database\Eloquent\Collection
     */
    public function displayPopularIngredient()
    {
        try {
            $this->popularIngredient = popularIngredient::all();
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
        return $this->popularIngredient;

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Response $request)
    {
        $recipes = information::all();
        return view('updateAndDelete', compact('recipes'))
            ->with('i');
    }


    /**
     * Display all edit details
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $recipes = information::find($id);
        $methods = Method::where('recipe_id', $id)->get();
        $categoryNames = Category::all();
        // getting all ingredients
        $ingredients = DB::table('ingredient_recipe')
            ->join('ingredients', function ($join) use ($id) {
                $join->on('ingredient_recipe.Ingredient_id', '=', 'ingredients.Ingredient_id')
                    ->where('ingredient_recipe.recipe_id', '=', $id);
            })
            ->get();
        $difficulity = Effort_level::all();
        // getting the code selections
        $code = DB::table('code')
            ->where('code_allowed', '>=', Carbon::now()->startOfWeek())
            ->where('code_allowed', '<=', Carbon::now()->addDay(20))
            ->get();

        $nutritionDisplay = nutrition::find($id);

        //  $arr = array('information' => $recipes, 'methods' => $methods, 'types' => $types);

        return view('editType')->with('recipes', $recipes)
            ->with('methods', $methods)
            ->with('difficulity', $difficulity)
            ->with('code', $code)
            ->with('categoryNames', $categoryNames)
            ->with('ingredients', $ingredients)
            ->with('nutritionDisplay', $nutritionDisplay);
    }

    /**
     *
     * Thats in a ajax request
     * the purpose of this function is to update any relevant fields needed
     * this is why there are so many if statements incase on or all are required
     * @param Request $request
     * @return json response from database
     */
    public function updateRecipes(Request $request)
    {


        // grab the recipe id which needs editing
        $recipeId = $request->input('recipe_id');

        // update all details in the recipe table
        $recipeUpdate = recipe::find($recipeId);
        if ($request->input('recipe_name') != '') {
            $recipeUpdate->recipe_name = $request->input('recipe_name');
        }

        if ($request->input('picture_location') != '') {
            $recipeUpdate->picture_location = $request->input('picture_location');
        }

        if ($request->input('effort_level_id') != '') {
            $recipeUpdate->effort_level_id = $request->input('effort_level_id');
        }

        /**
         * check if the code id has been entered more than 5 times
         */
        if ($request->input('code_id') != '') {
            $moreThanFive = recipe::where('code_id', '=', $request->input('code_id'))->count();
            if ($moreThanFive > 5) {

                return response()->json('There can only be five recipes per codes, nothing was inserted');
            } else {
                $recipeUpdate->code_id = $request->input('code_id');
            }
        }

        if ($request->input('description') != '') {
            $recipeUpdate->Description = $request->input('description');
        }

        if ($request->input('cookingTime') != '') {
            $recipeUpdate->Cooking_time = $request->input('cookingTime');
        }

        if ($request->input('prepTime') != '') {
            $recipeUpdate->Preparation_time = $request->input('prepTime');
        }


        if ($request->input('serves') != '') {
            $recipeUpdate->serves = $request->input('serves');
        }

        // save all recipe details if required
        $recipeUpdate->save();
        $this->updateNutrition($request, $recipeId);
        // update current methods
        $decodedJsonArray = json_decode($request->input('method'), true);
        $this->methodUpdate($decodedJsonArray, $recipeId);
        // update ingredient
        $decodedJsonIngrediantArray = json_decode($request->input('ingredi'), true);
        $this->updateIngredient($decodedJsonIngrediantArray, $recipeId);

        return response()->json(['success' => 'Data is successfully added']);


    }

    /**
     * update method
     * @param $methodJsonDecoded
     * @param $recipeId
     */
            public function methodUpdate($methodJsonDecoded, $recipeId)
            {
                try
                {
                    $methods = Method::where('recipe_id', $recipeId)->get();
                    $methodId = '';
                    $methodName = '';
                    foreach ($methodJsonDecoded as $key => $methodText) {
                        if ($methodText['methodid'] != '0') {

                            $methods = Method::find($methodText['methodid']);
                            $methods->method = $methodText['methodName'];
                            $methods->save();
                        } else {
                            $methodInsert = new Method();
                            $methodInsert->method = $methodText['methodName'];
                            $methodInsert->recipe_id = $recipeId;
                            $methodInsert->save();

                        }
                    }
                }catch (Exception $e)
                {
                    dd($e->getMessage());

                }


                }

    /**
     *
     * update ingredient
     * @param $decodedJsonIngrediantArray
     * @param $recipeId
     */
                public function updateIngredient($decodedJsonIngrediantArray, $recipeId)
                {
                    try
                    {
                        if (empty($decodedJsonIngrediantArray)) {

                        } else {

                            $ingredients = Ingredient_recipe::where('recipe_id', $recipeId)->get();
                            $ingredientId = '';
                            foreach ($decodedJsonIngrediantArray as $key => $ingredientText) {

                                $Ingredient_recipe = new Ingredient_recipe();
                                $Ingredient_recipe->recipe_id = $recipeId;
                                $Ingredient_recipe->Ingredient_id = $ingredientText['ingrediantId'];
                                $Ingredient_recipe->quantities = $ingredientText['quantity'];
                                $Ingredient_recipe->save();

                            }
                        }
                    }
                    catch (Exception $e)
                    {
                        dd($e->getMessage());

                    }
                }


    /**
     *
     * Function to update the nutrition
     * @param $request
     * @param $recipeId
     */
                public function updateNutrition($request, $recipeId)
                {
                    try
                    {
                        $nutrition = nutrition::find($recipeId);

                        if ($request->input('Calories') != '') {
                            $nutrition->Calories = $request->input('Calories');
                        }

                        if ($request->input('sodium') != '') {
                            $nutrition->Sodium = $request->input('sodium');
                        }

                        if ($request->input('fat') != '') {
                            $nutrition->Fat = $request->input('fat');
                        }

                        if ($request->input('protein') != '') {
                            $nutrition->protein = $request->input('protein');
                        }

                        if ($request->input('carbs') != '') {
                            $nutrition->carbs = $request->input('carbs');
                        }

                        if ($request->input('fibre') != '') {
                            $nutrition->fibre = $request->input('fibre');
                        }
                        $nutrition->save();
                    }
                    catch (Exception $e)
                    {
                        dd($e->getMessage());

                    }
                }


            /**
             *
             * Function to delete a ingredient from the recipe
             *
             * @param Request $request
             * @return \Illuminate\Http\JsonResponse
             */
            public
            function deleteIngredient(Request $request)
            {

                foreach ($request->input('ingredientName') as $key => $number) {
                    $deleted = Ingredient_recipe::find($number)->delete();
                }
                return response()->json($deleted);


            }

            /**
             *
             * Function to delete a method from the recipe
             *
             * @param Request $request
             * @return \Illuminate\Http\JsonResponse
             */
            public
            function deleteMethod(Request $request)
            {

                foreach ($request->input('methodID') as $key => $number) {
                    $deleted = Method::find($number)->delete();
                }
                return response()->json($deleted);


            }


        }