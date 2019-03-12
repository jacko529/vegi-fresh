@extends('layouts.app')


@section('content')
    <ul id="slide-out" class="sidenav">
        <li>
            <div class="user-view">
                <div class="background">
                </div>
                {!! Form::open(['action','ingredientsController@storeIn' => 'POST ']) !!}
                {{csrf_field()}}

                <div class="form-group">
                    {{Form::label('ingredientName', 'Add an ingredient')}}
                    {{Form::text('ingredientName','', ['class' => 'form-group', 'placeholder' => 'Add an ingredient'])  }}

                </div>
                <p id="addIngredientSuccess" class="green-text"></p>
                <p id="addIngredientError" class="red-text"></p>

                <div class="form-group">

                    <input id="ajaxSubmit" class="waves-effect waves-light btn-small" type="button" value="submit">
                </div>

                {!! Form::close() !!}

                {!! Form::open(['action','CategoryController@store' => 'POST ']) !!}
                {{csrf_field()}}
                <div class="form-group">
                    {{Form::label('categoryName', 'Add a category')}}
                    {{Form::text('categoryName','', ['class' => 'form-control', 'placeholder' => 'Add a category'])    }}

                </div>
                <p id="addCategory" class="green-text"></p>
                <p id="addCategoryError" class="red-text"></p>

                <div class="form-group">
                    <input id="categorySubmit" class="waves-effect waves-light btn-small" type="button" value="submit">
                </div>
                {!! Form::close() !!}

            </div>
        </li>
    </ul>





    <div class="container">
        <div class="row rownewType">
            <br><br>

            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <div id="fillingoutRecipe" class="center-align col s12 m8 l9"> <!-- Note that "m8 l9" was added -->
                <h1 class="center-align">Create new meals</h1>


                <div class="col s12 m12">
                    <div class="card-panel    ">
                        <div class="card-content black-text">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            {!! Form::open(['action','RecipeController@store' => 'POST ', 'id'=>'campaignForm', "files" => true, 'enctype'=>'multipart/form-data']) !!}
                            {{csrf_field()}}
                            <div class="form-group">
                                <h5 class="card-title">Add the recipe name</h5>

                                {{Form::text('receipeDetails','', ['class' => 'input-field', 'placeholder' => 'Recipe Name', 'id'=>'receipeName'])    }}
                                <strong class="center-align red-text" id="recipe-error"></strong>
                            </div>

                            <div class="divider"></div>
                            <div class="section">
                                <h5>Choose a picture</h5>
                                <div class="form-group">
                                    <div style="width:350px;height: 350px; border: 1px solid whitesmoke ;text-align: center;position: relative"
                                         id="image">
                                        <img width="100%" height="100%" id="preview_image"
                                             src="{{asset('images/no-image.png')}}"/>
                                        <i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw"
                                           style="position: absolute;left: 40%;top: 40%;display: none"></i>
                                    </div>
                                    <p>
                                        <a id="changProfile" style="text-decoration: none;">
                                            <i class="glyphicon glyphicon-edit"></i> Change
                                        </a>&nbsp;&nbsp;
                                        <a id="removeFile" style="color: red;text-decoration: none;">
                                            <i class="glyphicon glyphicon-trash"></i>
                                            Remove
                                        </a>
                                    </p>
                                    <div class="find">
                                        <input type="file" id="file" style="display: none"/>
                                        <input type="hidden" id="file_name"/>
                                    </div>
                                    <strong class="center-align red-text" id="picture-error"></strong>

                                </div><!-- end of section-->
                                <div class="section">
                                    <h5>Select the code</h5>
                                    <div class="input-field ">
                                        <p class="tryselectCode"></p>
                                        <select class="select" id="dropDownCode">
                                            <option value="" disabled selected>Choose your option</option>

                                        </select>
                                        <strong class="center-align red-text" id="code-error"></strong>

                                        <p id="dateCode"></p>
                                    </div>
                                    <h5>Select the difficulty</h5>
                                    <div class="input-field">
                                        <p class="tryselect"></p>
                                        <select class="select" id="dropDown" name="item_id">

                                        </select>
                                        <strong class="center-align red-text" id="difficulty-error"></strong>
                                    </div>
                                    <h5>Write a description</h5>
                                    <textarea id="description" class="materialize-textarea"></textarea>
                                    <h5>Vegetarian</h5>
                                    <label>
                                        <input id="0" class="vegiChecked" type="checkbox"  />
                                        <span>Is the meal vegetarian</span>
                                    </label>
                                </div>
                                <strong class="center-align red-text" id="description-error"></strong>

                                <h5>Enter the preparation time</h5>
                                <input type="text" class="form-control" id="lengthOfTime"
                                       placeholder="Preparation time ">
                                <strong class="center-align red-text" id="prep-error"></strong>
                                <h5>Enter the cooking time</h5>
                                <input type="text" class="form-control" id="cookingTime" placeholder="Cooking time">
                                <strong class="center-align red-text" id="cooking-error"></strong>
                                <h5>Serves</h5>
                                <form action="#">
                                    <p class="range-field">
                                        <input type="range" id="serves" min="0" max="15"/>
                                    </p>
                                    <strong class="center-align red-text" id="serving-error"></strong>

                                </form>



                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>


                    <div class="divider"></div>


                    <div class="col s12 m12">
                        <div class="card    green lighten-2">
                            <div class="card-content white-text">
                                <input id="submitRecipe" class="waves-effect waves-light btn-large" type="button"
                                       value="Submit recipe">
                            </div>
                        </div>
                        <br><br>


                        <div class="col s12 m12">
                            <div id="nutritional" class="card-panel">
                                <h4 class="card-title">Second part of recipe</h4>
                                <p class="trydiv"></p>
                                <p class="recipe_id_number"></p>
                                <div class="input-field col s2">
                                    <input id="Calories" type="text" class="validate">
                                    <label for="Calories">Calories</label>
                                    <span class="helper-text" data-error="wrong" data-success="right">Calories</span>
                                </div>
                                <div class="input-field col s2">
                                    <input id="Sodium" type="text" class="validate">
                                    <label for="Sodium">Sodium</label>
                                    <span class="helper-text" data-error="wrong" data-success="right">Sodium</span>
                                </div>
                                <div class="input-field col s2">
                                    <input id="Fat" type="text" class="validate">
                                    <label for="Fat">Fat</label>
                                    <span class="helper-text" data-error="wrong" data-success="right">Fat</span>
                                </div>
                                <div class="input-field col s2">
                                    <input id="Protein" type="text" class="validate">
                                    <label for="Protein">Protein</label>
                                    <span class="helper-text" data-error="wrong" data-success="right">Protein</span>
                                </div>
                                <div class="input-field col s2">
                                    <input id="Carbs" type="text" class="validate">
                                    <label for="Carbs">Carbs</label>
                                    <span class="helper-text" data-error="wrong" data-success="right">Carbs</span>
                                </div>
                                <div class="input-field col s2">
                                    <input id="Fibre" type="text" class="validate">
                                    <label for="Fibre">Fibre</label>
                                    <span class="helper-text" data-error="wrong" data-success="right">Fibre</span>
                                </div>
                                <div id="incorrect-storeTwo" style="display: none;"></div>
                            </div>
                        </div>


                        <br/><br/>
                        <div class="col s12 m12">
                            <div class="card-panel  ">
                                <div class="card-contefnt black-text">
                                    {!! Form::open(['action','ingredientsController@show' => 'POST ','id'=>'secondPartForm']) !!}


                                    <div class="containerAdd">
                                        <div class="form-group">
                                            <h5 class="card-title">Add a method</h5>

                                            <textarea id="textareaNow" placeholder="Put those methods"
                                                      class="materialize-textarea txtarea"></textarea>
                                            <strong class="center-align red-text" id="incorrect-method"></strong>

                                        </div>
                                        <div class="form-group">
                                            <input type="button" class="waves-effect waves-light btn-small"
                                                   id="newMethodValue"
                                                   value="add new field">
                                            <div id="methodTimeDiv">
                                                <ul id="methodTime">

                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                    <h5 class="card-title">Add a category</h5>

                                    <select id="category">

                                    </select>
                                    <strong class="center-align red-text" id="incorrect-category"></strong>


                                    <h5 class="card-title">Add an ingredient</h5>

                                    <input type="text" name="ingredient_name"  class="ingredient_name_insert" id="ingredient_name_insert"
                                           class="form-control input-lg"
                                           placeholder="Enter Ingredient Name"/>
                                </div>
                                <div id="ingredient_list">
                                </div>
                                <input type="text" id="amount" placeholder="amount">

                                <input type="button" class="waves-effect waves-light btn-small" id="buttonInSubmit"
                                       value="submit ingridiant">

                                <table class="ingridieant-list">

                                </table>
                                <strong class="center-align red-text" id="ingred"></strong>

                                <strong class="center-align red-text" id="ingred-list"></strong>

                            </div>
                        </div>


                        <!-- Modal Structure -->
                        <div id="modal1" class="modal">
                            <div class="modal-content">
                                <h4>What now?</h4>
                                <a href="{{route('home')}}" class="modal-close waves-effect waves-green btn-flat">Create
                                    a new recipe</a>
                                <a class="modal-close waves-effect waves-green btn-flat">Stay on page</a>
                                <a href="{{route('admin')}}" class="modal-close waves-effect waves-green btn-flat">Back
                                    to menu</a>

                            </div>
                        </div>

                        <div class="col s12 m12">
                            <div class="card-panel    green lighten-2">
                                <div class="card-content white-text">
                                    <p class="successInsert"></p>
                                    <a id="submitRecipePartTwo" href="#modal1"
                                       class="waves-effect waves-light btn-large modal-trigger">Submit to Catalog</a>
                                </div>
                            </div>
                        </div>


                        {!! Form::close() !!}
                    </div>

                </div>


            </div>


            @push('jsStacks')
                <script type="text/javascript" src="{{asset('js/insertAjax.js')}}"></script>
                <script type="text/javascript" src="{{asset('js/loadAjax.js')}}"></script>
    @endpush



@endsection
