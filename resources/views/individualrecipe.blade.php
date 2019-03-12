@extends('layouts.welcomeLayout')


@section('content')

    <div class="section no-pad-bot" id="index-banner">
        <div class="container">
            <div class="row">
                <div class="col s12 m12">
                    <h1 class="header center orange-text grabIngrediant"
                        id="{{$individualRecipe->recipe_id}}">{{$individualRecipe->recipe_name}}</h1>
                </div>
                <div class="col s12 m7">
                    <br><br>
                    <div class="row center">

                    </div>
                    <div class="row">
                        <div class="col s12 m12">
                            <div class="card">
                                <div class="card-image">
                                    <img class="header col s12 light" height="400px" width="200px"
                                         src="{{asset('storage/' . $individualRecipe->picture_location)}}  ">
                                    <span class="card-title">Card Title</span>
                                </div>
                                <div class="card-content">
                                    <p class="center-align ">{{$individualRecipe->description}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m5">
                    <br><br>
                    <br>
                    <div class="icon-block">
                        <h5 class="center orange-text"><i class="material-icons"></i>The dish serves</h5>
                        <hr>
                        <h5 class="center">{{$individualRecipe->serves}}</h5>
                        <hr>

                    </div>
                    <div class="icon-block">
                        <h5 class="center orange-text"><i class="material-icons"></i>Difficulty of dish</h5>
                        <h5 class="center">{{$individualRecipe->difficultity}}</h5>
                        <hr>
                        <p id="diff"></p>

                    </div>
                    <div class="icon-block">
                        <h5 class="center orange-text"><i class="material-icons"></i>Category dish</h5>
                        <h5 class="center">{{$individualRecipe->categoryName}}</h5>
                        <hr>
                    </div>
                    <div class="icon-block">
                        <h5 class="center orange-text"><i class="material-icons"></i>Preparation time</h5>
                        <h5 class="center">{{$individualRecipe->preparation_time}}</h5>
                        <hr>
                    </div>
                </div>

                <div class="col s12 m12">
                    <div class="col s12 m2">
                        <div class="card-panel green lighten-3 ">
                            <div class="card-content white-text">
                                <span class="card-title">Calories</span>
                            </div>
                            <div class="card-action">
                                <p>{{$nutritionDisplay->Calories}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m2">
                        <div class="card-panel green lighten-3 ">
                            <div class="card-content white-text">
                                <span class="card-title">Sodium</span>
                            </div>
                            <div class="card-action">
                                <p>{{$nutritionDisplay->Sodium}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m2">
                        <div class="card-panel green lighten-3 ">
                            <div class="card-content white-text">
                                <span class="card-title">Fat</span>
                            </div>
                            <div class="card-action">
                                <p>{{$nutritionDisplay->Fat}}</p>
                            </div>
                        </div>

                    </div>
                    <div class="col s12 m2">
                        <div class="card-panel green lighten-3 ">
                            <div class="card-content white-text">
                                <span class="card-title">protein</span>
                            </div>
                            <div class="card-action">
                                <p>{{$nutritionDisplay->protein}}</p>
                            </div>
                        </div>

                    </div>
                    <div class="col s12 m2">
                        <div class="card-panel green lighten-3 ">
                            <div class="card-content white-text">
                                <span class="card-title">carbs</span>
                            </div>
                            <div class="card-action">
                                <p>{{$nutritionDisplay->carbs}}</p>
                            </div>
                        </div>


                    </div>
                    <div class="col s12 m2">
                        <div class="card-panel green lighten-3 ">
                            <div class="card-content white-text">
                                <span class="card-title">fibre</span>
                            </div>
                            <div class="card-action">
                                <p>{{$nutritionDisplay->fibre}}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="container">
        <ul id="tabs-swipe-demo" class="tabs">
            <li class="tab col s3"><a class="active" href="#test-swipe-1">Methods </a></li>
            <li class="tab col s3"><a href="#test-swipe-2">Ingredients </a></li>
        </ul>
        <div id="test-swipe-1" class="col s12 ">
            <div class="card-panel">
                <h4 class="center orange-text"><i class="material-icons"></i>Cooking time</h4>
                <h5 class="center"> {{$individualRecipe->length_of_time}}</h5>
                <hr>
                <br><br>
                <h5 class="center">Methods</h5>
                <hr>
                <ul class="flow-text" id="methods">
                    <div id="methodPreload" class="preloader-wrapper big active">
                        <div class="spinner-layer spinner-blue">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="gap-patch">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
        <div id="test-swipe-2" class="col s12 ">
            <div class="card-panel">
                <h2 class="center orange-text"><i class="material-icons"></i>Ingredients</h2>
                <hr>
                <ul id="ingred" class="flow-text">
                    <div id="preload" class="preloader-wrapper big active">
                        <div class="spinner-layer spinner-blue">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="gap-patch">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
        <br><br>
    </div>

    @push('welcomeStack')
        <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Recipe",
      "author": {
        "@type": "Person",
        "name": "Jack Churchill"
      },
      "cookTime": "{{$individualRecipe->preparation_time}}",
      "description": "{{$individualRecipe->description}}",
      "image": "{{asset('storage/' . $individualRecipe->picture_location)}} ",
      "recipeCuisine": "{{$individualRecipe->categoryName}}",
      "recipeIngredient": [
        @foreach ($ingredients as $key )
                @if($loop->last)
                    "{{$key->quantities}} {{$key->ingredientName}}"
            @else
                    "{{$key->quantities}} {{$key->ingredientName}}",
            @endif
            @endforeach
            ],
            "recipeInstructions": [
@foreach ($methods as $key )
                @if($loop->last)
                    {
                "@type": "HowToStep",
                "text": "{{$key->method}}"
             }
            @else
                    {
                "@type": "HowToStep",
                "text": "{{$key->method}}"
             },
            @endif
            @endforeach
            ],
            "name": "{{$individualRecipe->recipe_name}}",
      "nutrition": {
        "@type": "NutritionInformation",
        "calories": "{{$nutritionDisplay->Calories}}",
        "FibreContent": "{{$nutritionDisplay->fibre}} grams",
        "CarbohydrateContent": "{{$nutritionDisplay->carbs}} grams",
        "fatContent": "{{$nutritionDisplay->Fat}} grams",
        "sodiumContent": "{{$nutritionDisplay->Sodium}} grams",
        "proteinContent": "{{$nutritionDisplay->protein}} grams"

      },
      "prepTime": "{{$individualRecipe->preparation_time}}",
      "recipeYield": "{{$individualRecipe->serves}}"
    }

    </script>
        <script type="text/javascript" src="{{asset('js/individualRecipe.js')}}"></script>
    @endpush
@endsection

     
         
  

 
