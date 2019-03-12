@extends('layouts.app')


@section('content')
    <!-- Page Layout here -->
    <div class="valign-wrapper">

        <div class="row center-align">

            <div class="center-align col 8 "> <!-- Note that "m4 l3" was added -->
                <h2 id="recipe_id">{{ $recipes->recipe_id }}</h2>

                <input type="text" id="recipe_name" value="{{ $recipes->recipe_name }}">
                <div class="form-group">
                    <div style="width:350px;height: 350px; border: 1px solid whitesmoke ;text-align: center;position: relative"
                         id="image">
                        <img width="100%" height="100%" id="preview_image"
                             src="{{asset('storage/' . $recipes->picture_location)}}"/>
                        <i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw"
                           style="position: absolute;left: 40%;top: 40%;display: none"></i>
                    </div>
                    <p>
                        <a href="javascript:changeProfile()" style="text-decoration: none;">
                            <i class="glyphicon glyphicon-edit"></i> Change
                        </a>&nbsp;&nbsp;
                        <a href="javascript:removeFile()" style="color: red;text-decoration: none;">
                            <i class="glyphicon glyphicon-trash"></i>
                            Remove
                        </a>
                    </p>
                    <div class="find">

                        <input type="file" id="file" style="display: none"/>
                        <input type="hidden" id="file_name"/>


                    </div>
                    <label>Cooking time</label>
                    <input id="updateCookTime" type="text" value="{{ $recipes->length_of_time }}">
                    <label>Prep time</label>
                    <input id="updatePrep" type="text" value="{{ $recipes->preparation_time }}">
                    <label>Serves</label>
                    <input id="updateServes" type="text" value="{{ $recipes->serves }}">
                    <label>Description</label>
                    <input id="updateDescription" type="text" value="{{ $recipes->description }}">


                    <table>
                        <tr>
                            <th>Categories</th>
                            <th>Codes</th>
                            <th>Effort Level</th>

                        </tr>
                        <tbody>
                        <tr>
                            <td>
                                <select>
                                    <option value="" disabled selected>{{ $recipes->categoryName }}</option>
                                    @foreach ($categoryNames as $key => $categoryNameLooped)
                                        <option id="{{ $categoryNameLooped->categoryid }}"
                                                value="{{ $categoryNameLooped->categoryName }}">{{ $categoryNameLooped->categoryName }}</option>

                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select id="updateCode">
                                    <option value="" disabled selected> code : {{ $recipes->code }}
                                        : {{ $recipes->code_allowed }}</option>
                                    @foreach ($code as $key => $codeChange)
                                        <option id="{{ $codeChange->code_id }}"
                                                value="{{ $codeChange->code }}">code : {{ $codeChange->code }}
                                            : {{ $codeChange->code_allowed }}</option>

                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select id="updateEffort">
                                    <option value="" disabled selected> {{ $recipes->difficultity }} </option>
                                    @foreach ($difficulity as $key => $difficulityLevel)
                                        <option id="{{ $difficulityLevel->effort_level_id }}"
                                                value="{{ $difficulityLevel->difficultity }}">{{ $difficulityLevel->difficultity }}</option>

                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        </tbody>
                    </table>


                    <!-- select for category
            -->
                    <!-- select for code
        -->
                    <div class="methodSection">
                        <label>methods </label>

                        @foreach ($methods as $key => $itemsmd)

                            <input type="text" class="updateMethod" id="{{$itemsmd->method_id}}"
                                   value="{{ $itemsmd->method }}">
                            <p>
                                <label>
                                    <input id="{{ $itemsmd->method_id }}" class="checkedMethod"
                                           type="checkbox"/>
                                    <span>Check to Delete</span>
                                </label>
                            </p>
                        @endforeach
                        <a id="deleteMethod" class="waves-effect waves-light btn">Delete Checked</a>

                    </div>
                    <hr>
                    <hr>
                    <textarea id="extraMethods" class="materialize-textarea"></textarea>
                    <input type="button" class="waves-effect waves-light btn-small" id="methodExtraValue"
                           value="Add addtional method">
                    <div>
                        <ul id="extraMethodList">

                        </ul>
                    </div>
                    <hr>
                    <hr>
                    <div class="col s12 m12">
                        <div id="nutritional" class="card-panel">
                            <div class="col s12 m2">
                                <div class="card-panel green lighten-3 ">
                                    <div class="card-content white-text">
                                        <span class="card-title">Calories</span>
                                    </div>
                                    <div class="card-action">
                                        <input type="text" id="Calories" class=""
                                               value=" {{$nutritionDisplay->Calories}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m2">
                                <div class="card-panel green lighten-3 ">
                                    <div class="card-content white-text">
                                        <span class="card-title">Sodium</span>
                                    </div>
                                    <div class="card-action">
                                        <input type="text" id="Sodium" class="" value=" {{$nutritionDisplay->Sodium}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m2">
                                <div class="card-panel green lighten-3 ">
                                    <div class="card-content white-text">
                                        <span class="card-title">Fat</span>
                                    </div>
                                    <div class="card-action">
                                        <input type="text" id="Fat" class="" value=" {{$nutritionDisplay->Fat}}">
                                    </div>
                                </div>

                            </div>
                            <div class="col s12 m2">
                                <div class="card-panel green lighten-3 ">
                                    <div class="card-content white-text">
                                        <span class="card-title">protein</span>
                                    </div>
                                    <div class="card-action">
                                        <input type="text" id="protein" class=""
                                               value=" {{$nutritionDisplay->protein}}">
                                    </div>
                                </div>

                            </div>
                            <div class="col s12 m2">
                                <div class="card-panel green lighten-3 ">
                                    <div class="card-content white-text">
                                        <span class="card-title">carbs</span>
                                    </div>
                                    <div class="card-action">
                                        <input type="text" id="carbs" class="" value=" {{$nutritionDisplay->carbs}}">
                                    </div>
                                </div>


                            </div>
                            <div class="col s12 m2">
                                <div class="card-panel green lighten-3 ">
                                    <div class="card-content white-text">
                                        <span class="card-title">fibre</span>
                                    </div>
                                    <div class="card-action">
                                        <input type="text" id="fibre" class="" value=" {{$nutritionDisplay->fibre}}">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <label>ingredients </label>
                <table class="ingrediantTable">
                    <tr>
                        <th>Ingredient Name</th>
                        <th>Quantities</th>
                    </tr>
                    <tbody>

                    @foreach ($ingredients as $key => $iteminge)
                        <tr class="seeIn">
                            <td>
                                <input type="text" class=""
                                       id="{{ $iteminge->ingredient_recipe_id }}"
                                       value="{{ $iteminge->ingredientName}}">
                            </td>
                            <td>
                                <input type="text" class="updateQuantity" value="{{ $iteminge->quantities}}">

                            </td>
                            <td>
                                <p>
                                    <label>
                                        <input id="{{ $iteminge->ingredient_recipe_id }}" class="checkedIngrediant"
                                               type="checkbox"/>
                                        <span>Check to Delete</span>
                                    </label>
                                </p>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a id="deleteIngrediant" class="waves-effect waves-light btn">Delete Checked</a>

                <input type="text" name="country_name" id="ingredient_name" class="form-control input-lg ingredient"
                       placeholder="Enter Ingredient Name"/>
                <div id="countryList">
                </div>
                <input type="text" id="amount" placeholder="amount">

                <input type="button" class="waves-effect waves-light btn-small" id="buttonIngredientSubmit"
                       value="submit ingridiant">

                <table class="ingridieant-listy">

                </table>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <a id="updateSubmit" href="#modal1"
                       class="waves-effect waves-light btn-large modal-trigger">Submit</a>
                </div>


            </div>


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
    @push('jsStacks')
        <script type="text/javascript" src="{{asset('js/updateAjax.js')}}"></script>
    @endpush


@endsection