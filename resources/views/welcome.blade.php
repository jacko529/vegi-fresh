@extends('layouts.welcomeLayout')


@section('content')


    <div class="divider "></div>
    <div class="section center  furtherCenter">
        <h2 class="title ">Ready to cook dinners from scratch</h2>
        <br>
        <p class="subTitle">Fresh ingredients delivered straight to your door.</p>
        <p id="this-weeks-code" >

        </p>

        <div class="row">
            <div class="input-field col s6 offset-s3">
                <i id="white-icon" class="material-icons prefix">folder_open</i>
                <input class="codeLabel" id="icon_prefix" type="text" class="validate">
                <label class="codeLabel" for="icon_prefix">Enter your weekly code</label>
                <a id="BringUpSection" href="#modal1" class="waves-effect waves-light btn-large modal-trigger"><i
                            class="material-icons left">restaurant_menu</i>Submit</a>

            </div>
        </div>
        <!-- Modal Structure -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <h4>This Weeks Meals</h4>
                <div class="carousel" id="demo-carousel">
                </div>
            </div>
            <div class="modal-footer">
                <a class="modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div>

        <div class="row center">
            <div class="col s12">

                <div class="input-field col s12">
                    <i id="white-icon" class="material-icons prefix">search</i>
                    <input type="text" name="country_name" id="country_name" class="form-control input-lg"
                           placeholder="Enter Recipe Name"/>
                    <div id="countryList">
                    </div>
                </div>
            </div>
        </div>
    </div>  <!-- #contactFormCat -->

    <div class="divider"></div>
    <div class="container">
        <div class="section center pictureD">
            <h2>Previous recipes</h2>
            <div class="input-field col s12">
                <select class="select-vegi">
                    <option class="selectVegi" id="0" value="0" disabled selected>Non Vegetarian</option>
                    <option class="selectVegi" id="0" value="0">Non Vegetarian</option>
                    <option class="selectVegi" id="1" value="1">Vegetarian</option>
                </select>
                <label>Filter For Vegetarian</label>
            </div>
                <div class="section center pictureDisplay">
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                </div>

                <div class="row">
                </div>
        </div>
    </div>
    </div>

    @push('welcomeStack')
        <script type="text/javascript" src="{{asset('js/selectWelcome.js')}}"></script>
    @endpush


@endsection
  

 
