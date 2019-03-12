@extends('layouts.app')


@section('content')


    <div class=" row">
        <div class="col-lg-12 margin-tb">
            <div class="center-align">
                <h2>Admin page</h2>

            </div>
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-image">
                        <img width="200" height="250" src="{{ asset('images/eggs.jpeg') }}">
                        <span class="card-title black-text whiteback">Add A New Recipe. </span>

                    </div>
                    <div class="card-content">
                        <a href="  {{ URL('createrecipe') }}">Add a new recipe</a>
                    </div>
                    <div class="card-action">
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-image">
                        <img width="200" height="250" src="{{ asset('images/salt.jpeg') }}">
                        <span id="month" class="card-title black-text whiteback"> Most popular ingredient </span>
                    </div>
                    <div id="popular" class="card-content ">
                    </div>
                    <div id="ordered" class="card-action">
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card">

                    <div class="card-image">
                        <img width="200" height="250" src="{{ asset('images/cutting.jpg') }}">
                        <span class="card-title black-text whiteback">Edit Or Delete A Recipe </span>

                    </div>
                    <div class="card-content">
                        <a href=" {{ URL('updateAndDelete') }}">Edit or delete a recipe</a>
                    </div>
                    <div class="card-action">
                    </div>
                </div>
            </div>
            <div class="col s12 m12">
                <div class="card">

                    <div class="card-image">
                        <img width="200" height="250" src="{{ asset('images/green.jpg') }}">
                        <span id="month" class="card-title black-text center-align whiteback"> Recipes by code </span>
                        <span id="month" class="card-title black-text center-align "> Recipes by code </span>


                        <p id="now" class="center-align"></p>

                        <p id="codeWeek" class="center-align"></p>
                    </div>
                    <div class="codeback">

                    </div>
                    <div id="codes" class="row card-action">

                    </div>
                </div>
            </div>


        </div>
    </div>
    @push('jsStacks')
        <script type="text/javascript" src="{{asset('js/admin.js')}}"></script>
    @endpush
@endsection