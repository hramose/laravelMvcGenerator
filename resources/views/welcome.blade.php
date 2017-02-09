<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!--BOOTSTRAP-->
        <link href="{{ url('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
        
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]--> 
    </head>
    <body>
        
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
                            &nbsp;
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            @if (Route::has('login'))
                                    @if (Auth::check())
                                    <li><a href="{{ url('/home') }}">Ir Sesión</a></li>
                                    @else
                                    <li><a href="{{ url('/login') }}">Login</a></li>
                                    <li><a href="{{ url('/register') }}">Register</a></li>
                                    @endif
                                </div>
                            @endif                             
                        </ul>
                    </div>
                </div>
            </nav>
        <div class="container">
            <div class="row">
                <div class="jumbotron">
                    <h1>Bienvenido</h1>
                    <p>Una intranet al alcance de tus manos.</p>
                    <p>
                        <a class="btn btn-lg btn-primary" href="{{ url('/login') }}" role="button">Ingresar aquí</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="page-header text-center">
                            <h2>Generador MVC</h2>
                        </div>
                        <div class="panel-body">
                            <p>
                                Generador para laravel, contiene Modelo, Vista, Controlador
                            </p>
                            <p>
                                <a class="btn btn-primary" href="{{ url('/generador') }}" role="button">Generador</a>
                            </p>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="page-header text-center">
                            <h2>CONTENIDO 2</h2>
                        </div>
                        <div class="panel-body">
                            ....
                            <p>
                                <a class="btn btn-primary" href="{{ url('/') }}" role="button">Leer más</a>
                            </p>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="page-header text-center">
                            <h2>CONTENIDO 3</h2>
                        </div>
                        <div class="panel-body">
                            ....
                            <p>
                                <a class="btn btn-primary" href="{{ url('/') }}" role="button">Leer más</a>
                            </p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
            
        <!--JS-->
        <script src="{{ url('/jquery/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script> 
    </body>
</html>
