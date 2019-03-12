<?php

namespace Assignment\Http\Controllers;

use Assignment\information;
use Assignment\Ingredient_recipe;
use Assignment\Method;
use Assignment\nutrition;
use Assignment\Recipe_category;
use Illuminate\Http\Request;
use Assignment\recipe;
use Assignment\code;
use Assignment\Effort_level;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Exception;

class RecipeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * return the new Con view (create a recipe)
     */
    public function index()
    {
        return view('createrecipe');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * returns a admin
     */
    public function showAdmin()
    {
        return view('admin');
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     *
     * show the effort level
     */
    public function createLevel()
    {
        $items = Effort_level::all(['effort_level_id', 'difficultity']);
        return response()->json($items);
    }


    /**
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function ajaxImage(Request $request)
    {
        if ($request->isMethod('get'))
            return view('ajax_image_upload');
        else {
            $validator = Validator::make($request->all(),
                [
                    'file' => 'image',
                ],
                [
                    'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
                ]);
            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );
            $extension = $request->file('file')->getClientOriginalExtension();
            $dir = 'storage/';
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $request->file('file')->move($dir, $filename);


            return response()->json($filename);
        }
    }


    /**
     *
     * The funciton which deletes the file form the uploads folder
     *
     * @param $filename
     * function to delete image file from the uploads folder
     */
    public function deleteImage($filename)
    {
        File::delete('storage/' . $filename);
    } //


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * insert statement for all of recipe details
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'recipe_name' => 'required',
            'picture_location' => 'required',
            'effort_level_id' => 'required',
            'code_id' => 'required',
            'description' => 'required',
            'length_of_time' => 'required',
            'cookingTime' => 'required',
            'serves' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        else {

            $codeLocator = $request->input('code_id');
            $moreThanFive = recipe::where('code_id', '=', $codeLocator)->count();
            if ($moreThanFive > 5) {

                $items = 'There can only be five recipes per codes, nothing was inserted';
            } else {

                $recipeFirstStep = new recipe();
                $recipeFirstStep->recipe_name = $request->input('recipe_name');
                $recipeFirstStep->picture_location = $request->input('picture_location');
                $recipeFirstStep->effort_level_id = $request->input('effort_level_id');
                $recipeFirstStep->vegetarian = $request->input('vegi');
                $recipeFirstStep->code_id = $request->input('code_id');
                $recipeFirstStep->Description = $request->input('description');
                $recipeFirstStep->Cooking_time = $request->input('cookingTime');
                $recipeFirstStep->Preparation_time = $request->input('length_of_time');
                $recipeFirstStep->Serves = $request->input('serves');
                $recipeFirstStep->id = $request->input('id');
                $recipeFirstStep->save();
                $items = recipe::all('recipe_id')->last();

            }
        }
        return response()->json($items);

    }

    /**
     * @param $arrayVAlue
     * @param $recipeID
     *
     * function to save methods
     */
    public function saveToMethod($arrayVAlue, $recipeID)
    {
        $methodInsert = new Method();
        $methodInsert->method = $arrayVAlue;
        $methodInsert->recipe_id = $recipeID;
        $methodInsert->save();
    }

    /**
     * @param $recipeID
     * @param $IDingredi
     * @param $quantitiy
     *
     * function to save ingredients recipe table
     */
    public function saveToIngredinant($recipeID, $IDingredi, $quantitiy)
    {
        $Ingredient_recipe = new Ingredient_recipe();
        $Ingredient_recipe->recipe_id = $recipeID;
        $Ingredient_recipe->Ingredient_id = $IDingredi;
        $Ingredient_recipe->quantities = $quantitiy;
        $Ingredient_recipe->save();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * function to store the second part of the recipes
     */
    public function storeFromTwo(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'recipe_id' => 'required',
            'Calories' => 'required',
            'sodium' => 'required',
            'fat' => 'required',
            'protein' => 'required',
            'carbs' => 'required',
            'fibre' => 'required',
            'method' => 'required',
            'ingridents' => 'required',
            'quantities' => 'required',
            'catagory_id' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        else {


            // method insert
            $method = $request->input('method');
            $explodeMethod = explode('+', $method);
            $recipeIDInput = $request->input('recipe_id');

            $removed = array_pop($explodeMethod);
            foreach ($explodeMethod as $explodeMethodLoop) {
                $this->saveToMethod($explodeMethodLoop, $recipeIDInput);
            }
            $this->nutritionalInsert($request, $recipeIDInput);
            $this->recipeCategoryInsert($request);

            // ingrediant insert
            $ingredient_ID = $request->input('ingridents');
            $explodeIngredID = explode('+', $ingredient_ID);

            $ingredientQuan = $request->input('quantities');
            $explodeIngredQuan = explode('+', $ingredientQuan);


            // array to combine the two values
            foreach ($explodeIngredID as $key => $LoopId) {

                $newMeshedArray[] = array(
                    "id" => $LoopId,
                    "quantity" => $explodeIngredQuan[$key]
                );
            }
            $ingridirecipeID = $request->input('recipe_id');

            // array to saving both
            $removed = array_pop($newMeshedArray);
            foreach ($newMeshedArray as $k => $gvalue) {
                $this->saveToIngredinant($ingridirecipeID, $gvalue["id"], $gvalue["quantity"]);

            }
        }
        return response()->json(['success' => 'Data is successfully added']);
    }

    // cat insert

    /**
     * @param $request
     */
    public function recipeCategoryInsert($request)
        {
            try
            {
                $recipe_cats = new Recipe_category();
                $recipe_cats->recipe_id = $request->input('recipe_id');
                $recipe_cats->categoryid = $request->input('catagory_id');
                $recipe_cats->save();
            }
            catch (Exception $e)
            {
                dd($e->getMessage());
            }

        }
    /**
     * @param $request
     * @param $recipeIDInput
     */
    public function nutritionalInsert($request, $recipeIDInput)
    {
        try {
            // nutrition insert
            $nutritionInsert = new nutrition();
            $nutritionInsert->Calories = $request->input('Calories');
            $nutritionInsert->Sodium = $request->input('sodium');
            $nutritionInsert->Fat = $request->input('fat');
            $nutritionInsert->protein = $request->input('protein');
            $nutritionInsert->carbs = $request->input('carbs');
            $nutritionInsert->fibre = $request->input('fibre');
            $nutritionInsert->recipe_id = $recipeIDInput;
            $nutritionInsert->save();
        } catch (Exception $exception) {
            dd($exception->getMessage());
        }

    }

    public function showForDelete()
    {

        try {
            $recipeIDForDelete = information::all();
            $recipeID = array();
            foreach ($recipeIDForDelete as $row) {
                $recipeID[$row['recipe_id']] = $row['recipe_name'];
            }
        }
        catch (Exception $e)
        {
            dd($e->getMessage());

        }
        return  response()->json($recipeID);
    }

    public function delete(Request $request)
    {
        $ids = $request->input('recipe_id');

        foreach ($ids as $deletable) {
            $recipes = recipe::find($deletable);
            $recipes->delete();
        }

        return 'success';
    }


}
