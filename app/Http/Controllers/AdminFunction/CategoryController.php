<?php

namespace Assignment\Http\Controllers;

use Illuminate\Http\Request;
use Assignment\Category;
use DB;
use Assignment\Ingredients;
use Assignment\Http\Requests;
use Illuminate\View;


class CategoryController extends Controller
{


    private $category;
    private $nameOfCategory;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categorySelect()
    {
        $this->category = Category::orderBy('categoryName', 'ASC')->get();
        return response()->json($this->category);

    }

    /**
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checkIfCurrentlyExisits = Category::where('categoryName' , $request->input('categoryName'))->get();
        if($this->is_array_empty($checkIfCurrentlyExisits) == false)
        {
            $this->nameOfCategory = new Category();
            $this->nameOfCategory->categoryName = $request->input('categoryName');
            $this->nameOfCategory->save();
            return response()->json(['success'=>'Data is successfully added']);

        }
        else
        {
            return response()->json(['error'=>'There is already a category with this name.']);

        }

    }

    /*
     return true if the array is not empty
     return false if it is empty
       everything else did not work, so I created a function to 100% check if the array was empty
    */
    public function is_array_empty($array)
    {
        if(is_array($array)){
            foreach($array as $key => $value){
                if(!empty($value) || $value != NULL || $value != ""){
                    return true;
                    break;//stop the process we have seen that at least 1 of the array has value so its not empty
                }
            }
            return false;
        }
    }

}
