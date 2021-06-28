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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
    .body{
        background-color: #000000
    }
    </style>
    @yield('contenido_cSS')


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid"> <button class="navbar-toggler navbar-toggler-right border-0 p-0" type="button" data-toggle="collapse" data-target="#navbar20">
                <p class="navbar-brand text-white mb-0"> <i class="fa d-inline fa-lg fa-stop-circle"></i> TalentWork</p>
            </button>
            <div class="collapse navbar-collapse" id="navbar20">
                <ul class="navbar-nav mr-auto">
                    {{-- <li class="nav-item"> <a class="nav-link" href="#">Inicio</a> </li> --}}
                    <li class="nav-item"> <a class="nav-link" href="{{ route('showOccupationService') }}">Oficio</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('showTalentService') }}">Talento</a> </li>
                </ul>
                <p class="d-none d-md-block lead mb-0 text-white"> <i class="fa d-inline fa-lg fa-stop-circle"></i> <b> TalentWork</b> </p>
                <ul class="navbar-nav ml-auto">
                    {{-- <li class="nav-item mx-1"> <a class="nav-link" href="#"> <i class="fa fa-github fa-fw fa-lg"></i> </a> </li> --}}


                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        
                        @if (Route::has('registrouser'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('registrouser') }}">{{ __('Registro') }}</a>
                            </li>
                        @endif
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('registerServiceAllNow') }}">Ofrecer Mi Servicio</a>
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

        <main class="py-4">
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
                            {{-- <div class="footer-social">
                                <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                                <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                            </div> --}}
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
                    
                    {{-- <div class="col-md-4">
                        <div class="footer-card-icon">
                            <i class="fa fa-cc-discover"></i>
                            <i class="fa fa-cc-mastercard"></i>
                            <i class="fa fa-cc-paypal"></i>
                            <i class="fa fa-cc-visa"></i>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>


    @yield('contenido_abajo_js')


</body>

</html>

