<?php
/**
 * Created by PhpStorm.
 * User: churc
 * Date: 31/01/2019
 * Time: 07:27
 */

namespace Assignment\Http\Controllers;


use Assignment\code;
use Assignment\codeWeekView;
use Assignment\information;
use Assignment\recipe;
use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Assignment\Http\Controllers\Controller;
use Exception;

class codeController extends Controller
{
    private $food;
    private $codeSelct;
    private $codeStartOfWeek;
    private $codeFourWeeks;
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recipeSelectByCode(Request $request)
    {
        $this->food = information::all();

        try {
          //  $code=  DB::table('information')->where('code', $request)->first();
          $code = $this->food->where('code','=' ,  $request->input('code'));
            return response()->json($code);
        } catch (QueryException $e) {
            $error_code = $e->errorInfo[1];

            return response()->json($error_code);;
        }
    }



    /**
     *
     *
     * Select the code for the current weeks
     *
     * @return \Illuminate\Http\JsonResponse
     * @return return the code but only up to 21 days
    */
    public function codeSelectForTheCurrentWeek()
    {
        try {

            $this->codeStartOfWeek = codeWeekView::where('code_allowed', '=', Carbon::now()->startOfWeek())
                ->get();
            $codeOnly =  $this->codeStartOfWeek->pluck('code');
                $codes = information::where('code','=' ,  $codeOnly   )
                   ->select('recipe_id', 'recipe_name')->get()->toArray();

        }
        catch(Exception $e)
        {
            dd($e->getMessage());

        }
        return response()->json(['code' => $this->codeStartOfWeek, 'recipes' => $codes   ]);

    }


    /**
     * @return \Illuminate\Http\JsonResponse
     * display this weeks code
     */
    public function thisWeeksCode()
    {
        try {

            $this->codeStartOfWeek = codeWeekView::take(1)
                ->select('code')
                ->get();

        }
        catch(Exception $e)
        {
            dd($e->getMessage());

        }
        return response()->json($this->codeStartOfWeek);

    }





    /**
     *
     *
     * select the coe for the next four weeks
     *
     * @return \Illuminate\Http\JsonResponse
     * @return return the code but only up to 21 days
     */
    public function codeSelectForFourWeeks()
    {
        try{
            $this->codeFourWeeks = codeWeekView::where('code_allowed', '>', Carbon::now()->startOfWeek())
                ->get();
            $codeOnly =   $this->codeFourWeeks->pluck('code');

            foreach ($codeOnly as $forCodesLoop)
            {
                $codes = information::where('code','=' ,  $forCodesLoop )
                    ->select('recipe_id', 'recipe_name')->get()->toArray();
            }

        }

         catch(Exception $e)
        {
            dd($e->getMessage());

        }
        return response()->json(['code' => $this->codeFourWeeks, 'recipes' => $codes ]);

    }




//count the recipes
    /**
     * select count of recipes
     * plus
     */
    /**
     *
     *
     * The function which shows the code for the next 4 weeks
     *
     * @return \Illuminate\Http\JsonResponse
     * @return return the code but only up to 21 days
     */
    public function codeSelect()
    {
        $this->codeSelct = DB::table('code')
            ->where('code_allowed', '>=', Carbon::now())
            ->where('code_allowed', '<=', Carbon::now()->addDay(28))
            ->get();

        return response()->json($this->codeSelct);

    }

}