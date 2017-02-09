<!DOCTYPE html>
<html lang="{{config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title><?php if(isset($title_head)){
            echo $title_head;
        }else{
            ?>
            {{config('app.name', 'Laravel') }}
            <?php
            } ?> </title>
        
        <link rel="icon" type="image/jpg" href="{{ url('/img/ico.jpg') }}" />
        
        <!--BOOTSTRAP-->
        <link href="{{ url('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

        <!--PERSONALIZADOS-->
        <?php
        if (isset($css)) {
            foreach ($css as $file) {
                ?>
                <link href="{{ url('/') }}<?= "/" . $file . ".css" ?>" rel="stylesheet" />
                <?php
            }
        }
        ?>    
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]--> 

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                    'csrfToken' => csrf_token(),
                    'baseurl' => url('/'),
            ]) !!}
            ;
        </script>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">Inicio
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            @if (Auth::guest()) 
                                &nbsp;
                            @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Configuración<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/user') }}">Usuarios</a></li>
                                </ul>
                            </li>
                            @endif
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())                            
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                            @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                           onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </div>       
        
        <!-- para mostar cualquier menesaje -->
        @if (Session::has('message'))
        <div class="container">
            <div class="row">
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            </div>
        </div>            
        @endif
        
        @yield('content')
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="tb-copyright">CopyRigth 2017</p>
                    </div>
                </div>
            </div>
        </footer>

        <!--JS-->
        <script src="{{ url('/jquery/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>  

        <!-- Personales -->   
        <?php
        if (isset($js)) {
            foreach ($js as $file) {
                ?>
                <script src="{{ url('/') }}<?= "/" . $file . ".js" ?>" type="text/javascript"></script>
                <?php
            }
        }
        ?> 
    </body>
</html>
