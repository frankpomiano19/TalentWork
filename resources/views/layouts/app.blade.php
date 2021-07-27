<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('fortawesome/fontawesome-free/js/all.min.js') }}"></script>


    @yield('contenido_js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/registrocss.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }} ">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" integrity="sha384-dL4prZgo2Ux+uabu7kV5AEOXCe4hTXG7gZgJ7dhxbrlYQSVfRe8+U7Vio/4K8N/n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha384-vtXRMe3mGCbOeY7l30aIg8H9p3GdeSe4IFlP6G8JMa7o7lXvnz3GFKzPxzJdPfGK" crossorigin="anonymous"></script>    <style>

    .body{
        background-color: #000000
    }
    .chat {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .chat li {
        margin-bottom: 10px;
        padding-bottom: 5px;
        border-bottom: 1px dotted #B3A9A9;
    }

    .chat li .chat-body p {
        margin: 0;
        color: #777777;
    }

    .panel-body {
        overflow-y: scroll;
        height: 350px;
    }

    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar {
        width: 12px;
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar-thumb {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #555;
    }
    </style>
    @yield('contenido_cSS')


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid"> <button class="navbar-toggler navbar-toggler-right border-0 p-0" type="button" data-toggle="collapse" data-target="#navbar20">
                <p class="navbar-brand text-white mb-0"> <em class="fa d-inline fa-lg fa-stop-circle"></em> TalentWork</p>
            </button>
            <div class="collapse navbar-collapse" id="navbar20">
                <ul class="navbar-nav mr-auto">
                    {{-- <li class="nav-item"> <a class="nav-link" href="#">Inicio</a> </li> --}}
                    <li class="nav-item"> <a class="nav-link" href="{{ route('showOccupationService') }}">Oficio</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('showTalentService') }}">Talento</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('categorias') }}">Categorias</a>
                    </li>
                   
                </ul>
                <p><a class="d-none d-md-block lead mb-0 text-white" href="{{ route('ServiciosOfrecidos') }}"> <i class="fa d-inline fa-lg fa-stop-circle"></i> <b> TalentWork</b></a> </p>
                <ul class="navbar-nav ml-auto">


                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                            </li>
                        @endif
                        
                        @if (Route::has('registrouser'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('registrouser') }}">{{ __('Registro') }}</a>
                            </li>
                        @endif
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bandeja') }}">Buzón clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('offerMyService') }}">Registrar servicio</a>
                    </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('perfil',Auth::user()->id ) }}">Mi Perfil</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest

                </ul>
            </div>
        </div>
    </nav>

        <main class="">
            @yield('content')
        </main>

        <div class="footer-top-area">
            <div class="zigzag-bottom"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-about-us">
                            <h2>Talent<span>Work</span></h2>
                            <p>Pagina dedicada a publicar servicios de todo tipo, ya sea tecnico o algun oficio<</p>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-menu">
                            <h2 class="footer-wid-title">Navegación </h2>
                            <ul>
                                <li><a href="">Mi perfil</a></li>
                                <li><a href="">Mi historial</a></li>
                            </ul>                        
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-menu">
                            <h2 class="footer-wid-title">Tipos de servicios</h2>
                            <ul>
                                <li><a href="{{ route('showOccupationService') }}">Oficios</a></li>
                                <li><a href="{{ route('showTalentService') }}">Talentos</a></li>
                            </ul>                        
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6">
                        <div class="footer-newsletter">
                            <h2 class="footer-wid-title">Premium</h2>
                            <p>Subscribete a nuestra versión premium para acceder a mayores beneficios!</p>
                            <div class="newsletter-form">
                                <input type="submit" value="Subscribete">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="copyright">
                           <p>&copy; 2021 TalentWork. Todos los derechos reservados. Grupo 5 - MPF - FISI - UNMSM </p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>


    @yield('contenido_abajo_js')


</body>

</html>

