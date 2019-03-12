<?php

namespace Assignment\Http\Controllers;

use Assignment\information;
use Assignment\Ingredients;
use Assignment\Method;
use Assignment\nutrition;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Assignment\recipe;
use Illuminate\Support\Facades\DB;

class IndividualRecipeController extends Controller
{

    /**
     * @param $recipe_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function GeneralInformationForRecipe($recipe_id = null)
    {
        if($recipe_id == null){
            return redirect()->route('welcome');
        }
        else {
            $individualRecipe = information::findOrFail($recipe_id);
            $nutritionDisplay = nutrition::find($recipe_id);
            $methods = Method::select('method')
                ->join('recipes', 'method.recipe_id', '=', 'recipes.recipe_id')
                ->where('recipes.recipe_id', '=', $recipe_id)
                ->get();
            $ingredients = Ingredients::select('ingredientName', 'quantities')
                ->join('ingredient_recipe', 'ingredients.ingredient_id', '=', 'ingredient_recipe.ingredient_id')
                ->join('recipes', 'ingredient_recipe.recipe_id', '=', 'recipes.recipe_id')
                ->where('recipes.recipe_id', '=', $recipe_id)
                ->get();

            return view('individualrecipe')
                ->with('individualRecipe', $individualRecipe)
                ->with('nutritionDisplay', $nutritionDisplay)
                ->with('methods', $methods)
                ->with('ingredients', $ingredients)

                ->with('i');
        }
    }



    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function IngrediantsForRecipe(Request $request)
    {
        try {
            $ingredients = Ingredients::select('ingredientName', 'quantities')
                ->join('ingredient_recipe', 'ingredients.ingredient_id', '=', 'ingredient_recipe.ingredient_id')
                ->join('recipes', 'ingredient_recipe.recipe_id', '=', 'recipes.recipe_id')
                ->where('recipes.recipe_id', '=', $request->input('recipeID'))
                ->get();
            return response()->json($ingredients);
        } catch (QueryException $e) {
            $error_code = $e->errorInfo[1];

            return response()->json($error_code);;
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function MethodForRecipe(Request $request)
    {
        try {
            $methods = Method::select('method')
                ->join('recipes', 'method.recipe_id', '=', 'recipes.recipe_id')
                ->where('recipes.recipe_id', '=', $request->input('recipeID'))
                ->get();
            //  return view('individualRecipe', compact('ingredients'));
            return response()->json($methods);
        } catch (QueryException $e) {
            $error_code = $e->errorInfo[1];

            return response()->json($error_code);;
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function CategoryAndEffort(Request $request)
    {
        try {
            $methods = Method::select('method')
                ->join('recipes', 'method.recipe_id', '=', 'recipes.recipe_id')
                ->where('recipes.recipe_id', '=', $request->input('recipeID'))
                ->get();
            //  return view('individualRecipe', compact('ingredients'));
            return response()->json($methods);
        } catch (QueryException $e) {
            $error_code = $e->errorInfo[1];

            return response()->json($error_code);;
        }
    }




}
