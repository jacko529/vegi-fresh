<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// auth middleware
Auth::routes();

/**
 * welcome  routes
 */
Route::get('/', 'WelcomeController@homeWelcome' , function () {
    return view('welcome');
}) -> name('welcome');

//Route::get('welcome/now', 'codeController@timingNow');
// recipe route to show autocomplete recipes
Route::post('/autocomplete/fetch', 'WelcomeController@fetch')->name('autocompleteNow.fetch');

Route::get('/welcomeCategories', 'WelcomeController@pictureSelect');
Route::get('/welcomeCategoriesVegi', 'WelcomeController@pictureSelectVegi');

/**
 * Individual recipe controller
 *
 */
// show ingredients
Route::post('individualRecipe/ingredients', 'IndividualRecipeController@IngrediantsForRecipe');
// show methods
Route::post('individualRecipe/methods', 'IndividualRecipeController@MethodForRecipe');
// when you click a recipe this is the route which displays a certain recipe
Route::get('individualRecipe/{recipe_id?}', 'IndividualRecipeController@GeneralInformationForRecipe');
/**
 *
 * code controller
 */
// show code route
Route::post('createrecipe/codeSelect', 'codeController@codeSelect');
Route::post('/showCode', 'codeController@thisWeeksCode');
Route::post('admin/codeSelect', 'codeController@codeSelect');
Route::post('admin/codeStartWeek', 'codeController@codeSelectForTheCurrentWeek');
Route::post('admin/codeFourWeeks', 'codeController@codeSelectForFourWeeks');
Route::post('admin/codeRecipe', 'codeController@recipeSelectByCode');
// show code input from the
Route::post('welcome/codeSelect', 'codeController@recipeSelectByCode');

/**
 *
 * Recipe Controller
 */
Route::get('/admin', 'RecipeController@showAdmin')->name('admin');
Route::get('/delete', 'RecipeController@showForDelete' , function () {
    return view('delete');
});


/**
 *
 * category controller
 */
Route::post('createrecipe/insertCategory', 'CategoryController@store');
Route::resource('/createrecipe', 'CategoryController');
Route::match(['get', 'post'], 'categorySelect', 'CategoryController@categorySelect');

/**
 * insert recipe routes
 */
//createrecipe page
// recipe store part one route
Route::post('createrecipe/recipeStore', 'RecipeController@store');
// recipe store part two route
Route::post('createrecipe/recipeStoreTwo', 'RecipeController@storeFromTwo');
// difficulty level route
Route::post('createrecipe/createLevel', 'RecipeController@createLevel');
/**
 * ingredientsController
 */

// store an ingredient
Route::post('createrecipe/storeIn', 'ingredientsController@storeIn');
Route::post('/createrecipe/show', 'ingredientsController@show')->name('ingredients.show');
/**
 * recipe controller
 */
Route::match(['get', 'post'], 'createLevel', 'RecipeController@createLevel');
Route::match(['get', 'post'], 'ajax-image-upload', 'RecipeController@ajaxImage');
// route the delete a picture when uploading a new recipe
Route::delete('ajax-remove-image/{filename}', 'RecipeController@deleteImage');
Route::get('/createrecipe', 'RecipeController@index')->name('home');
Route::match(['get', 'post'], 'codeSelect', 'codeController@codeSelect');

/**
 * update and delete controller
 */
Route::delete('updateAndDelete/{recipe_id}', 'UpdateAndDeleteController@destroy')->name('updateFinal.delete');
Route::get('updateAndDelete/{recipe_id}', 'UpdateAndDeleteController@edit')->name('updateFinal.edit');
Route::get('updateAndDelete/', 'UpdateAndDeleteController@index');
Route::post('/updateTime/try', 'UpdateAndDeleteController@updateRecipes')->name('nowsee');
Route::post('/updateTime/deleteNow', 'UpdateAndDeleteController@deleteIngredient')->name('deleteSee.now');
Route::post('/updateTime/deleteNowMethod', 'UpdateAndDeleteController@deleteMethod')->name('deleteSee.nowmethod');
Route::resource('updateAndDelete','UpdateAndDeleteController');

// route to get the most popular ingredient
Route::post('/updateAndDelete/Popular', 'UpdateAndDeleteController@displayPopularIngredient');

