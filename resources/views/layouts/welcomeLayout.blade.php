<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/materialize.min.css')}}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/styles.css')}}"  media="screen,projection"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>
    @stack('welcomeStack')

</head>
<body>
<div id="app">

    <nav class="nav-colour" role="navigation">
        <div class="nav-wrapper container "><a id="logo-container" href="{{ url('/') }}" class="brand-logo"><img id="logo" width="140px" height="95%" src="{{ asset('images/Logo.png') }}"></a>


            <ul id="nav-mobile" class="sidenav">
                <li><a href="#">Navbar Link</a></li>
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->

                </ul>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons"></i></a>
        </div>
    </nav>

    @yield('content')

</div>
<footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">VegiFresh</h5>
                <p class="grey-text text-lighten-4">fresh ingredients delivered straight to your door.</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Potential links</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="{{route('admin')}}">Admin</a></li>


                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2019 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
        </div>
    </div>
</footer>

<!-- Scripts -->

</body>


</html>
