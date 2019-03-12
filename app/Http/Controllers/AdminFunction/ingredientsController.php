<?php

namespace Assignment\Http\Controllers;


use Assignment\Ingredients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\View;

class ingredientsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeIn(Request $request)
    {
        $CheckIfIngredientExists = Ingredients::where('ingredientName' , $request->input('ingredientName'))->get()->toArray();
        if($this->is_array_empty($CheckIfIngredientExists) == false)
        {
            $ingredientName = new Ingredients();
            $ingredientName->ingredientName = $request->input('ingredientName');
            $ingredientName->save();
            return response()->json(['success' => 'Data is successfully added']);

        }
            else {
                return response()->json(['error'=>'There is already a ingredient with this name.']);
            }



    }
    /*
     return true if the array is not empty
     return false if it is empty
       everything else did not work, so I created a function to 100% check if the array was empty
    */
    public function is_array_empty($arr){
        if(is_array($arr)){
            foreach($arr as $key => $value){
                if(!empty($value) || $value != NULL || $value != ""){
                    return true;
                    break;//stop the process we have seen that at least 1 of the array has value so its not empty
                }
            }
            return false;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return void
     */
    public function show(Request $requesty)
    {
        if ($requesty->get('query')) {
            $query = $requesty->get('query');
            $data = DB::table('ingredients')
                ->where('ingredientName', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '
           <li class="ingrediantSelect" id="' . $row->Ingredient_id . '"> '. $row->ingredientName . '</li>
       ';
            }
            $output .= '</ul>';
            echo $output;
        } //


    }

}
