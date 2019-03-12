<?php

namespace Assignment\Http\Controllers;

use Assignment\information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class WelcomeController extends Controller
{
    private $theWeekOfPicturesSee;
    /**
     *
     * return the welcome view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function homeWelcome()
    {
        return view('welcome');
    }


    /**
     *
     * rearrange the array so the recipes can be in category order
     *
     * @return array
     */
    public function pictureSelect()
    {

        $this->theWeekOfPicturesSee = information::where('vegi', '0')->get();
        $theWeekOfPictures = array();

        // create a new array containing the recipes by category
        foreach ($this->theWeekOfPicturesSee as $row)
        {
            $theWeekOfPictures[$row['categoryName']][$row['recipe_name']][$row['picture_location']] = $row['recipe_id'];
        }
        //  return view('welcome', compact('theWeekOfPictures', $theWeekOfPictures));

        return $theWeekOfPictures;
    }

    /**
     *
     * rearrange the array so the recipes can be in category order, also this is for vegi dishes
     *
     * @return array
     */
    public function pictureSelectVegi()
    {

        $this->theWeekOfPicturesSee = information::where('vegi', '1')->get();
        $theWeekOfPictures = array();

        // create a new array containing the recipes by category
        foreach ($this->theWeekOfPicturesSee as $row)
        {
            $theWeekOfPictures[$row['categoryName']][$row['recipe_name']][$row['picture_location']] = $row['recipe_id'];
        }
        //  return view('welcome', compact('theWeekOfPictures', $theWeekOfPictures));
        return $theWeekOfPictures;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    function fetch(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('information')
                ->where('recipe_name', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= '
       <li class="listingRecipes"><a href="/vegi-fresh-master/public/individualRecipe/'.$row->recipe_id.'">'.$row->recipe_name.'</a></li>
       ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }//
}


