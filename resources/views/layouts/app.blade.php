<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/materialize.min.css')}}" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{asset('css/styles.css')}}" media="screen,projection"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    @stack('jsStacks')

    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>

    <script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>



</head>
<body>
<div id="app">
    <nav class="nav-colour" role="navigation">
        <div class="nav-wrapper container "><a id="logo-container" href="{{ url('/') }}" class="brand-logo"><img id="logo"
                        width="140px" height="95%" src="{{ asset('images/Logo.png') }}"></a>


            <ul id="nav-mobile" class="sidenav">
                <li><a href="#">Navbar Link</a></li>
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li class="item left"><a class="link" href="{{ route('login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons"></i></a>
        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->

</body>
<script>

    $(document).ready(function(){
        $('.tooltipped').tooltip();
    });


</script>


<script>




    // Or with jQuery

    $(document).ready(function () {
        $('select').formSelect();

    });




    jQuery(document).ready(function () {
        jQuery('#formFirst').click(function (e) {


        })
    });



    $(function removeElement() {
        $(".remove-product-compare").click(function (e) {
            $(this).parent().remove();
        });
    });
</script>







</html>
