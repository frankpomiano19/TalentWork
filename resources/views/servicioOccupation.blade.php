@extends('layouts.app')


@section('contenido_js')
    <!-- Core theme JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

@endsection

@section('contenido_cSS')

    <style>
        .container px-4 px-lg-5 my-5.col-3.h2.headertekst{
            left: 0;
            right: 0;
            width: 100%;
            text-align: center;
        }
    </style>

@endsection


@section('content')


    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{  $serviceProfile->imagen  }}" alt="..." /></div>
                <div class="col-md-6">
                    {{-- <h1 class="display-5 fw-bolder">{{ $serviceProfile->IntermediateUseTal->name }}&nbsp;{{ $serviceProfile->IntermediateUseTal->lastname }}</h1> --}}
                    <h1 class="display-5 fw-bolder">{{ $serviceProfile->IntermediateOcc->ser_occ_name }}</h1>





                    <div class="card text-center">
                        <div class="card-header">
                          <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">

                                <a class="nav-link active" aria-current="true" href="">Servicio Normal</a>

                            </li>
                            {{-- <li class="nav-item">

                                <a class="nav-link" aria-current="true" href="">Premium</a>

                            </li> --}}
                          </ul>
                        </div>
                        <div class="col-12 col-sm-12 col-md-10 col-lg-10">
                            <ul class="text-danger">
                                @foreach ($errors->contractProccessForm->all() as $errorRegister)
                                    <li>{{ $errorRegister }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">S/{{ $serviceProfile->precio }}</h5>
                            <div class="d-flex small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                          <p class="card-text">{{ $serviceProfile->descripcion }}</p>
                          <div class="d-flex">
                            {{-- <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" /> --}}
                            @php
                                $receivedServiceNow = false;
                            @endphp
                            @if(auth()->user()!=null)
                                @if(auth()->user()->id == $serviceProfile->IntermediateUseOcc->id)
                                    <button class="btn btn-outline-dark flex-shrink-0" disabled type="button">
                                        <i class="bi-cart-fill me-1"></i>
                                        Tu eres el del servicio
                                    </button>

                                @else
                                    @foreach($serviceProfile->IntermediateOccContract as $contract)
                                        @if($contract->use_receive == auth()->user()->id)
                                            @php
                                                $receivedServiceNow =true;
                                            @endphp
                                        @else
                                        @endif

                                    @endforeach
                                    @if($receivedServiceNow == true)
                                        <button class="btn btn-outline-dark flex-shrink-0" disabled type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="bi-cart-fill me-1"></i>
                                            Ya lo contrataste
                                        </button>
                                        <br>
                                        <div class="text-danger">* Para comunicarte con el que ofrece el servicio, presione <a href="">AQUI</a> </div>
                                    @else
                                        <button class="btn btn-outline-dark flex-shrink-0 btn-details-now-data" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <i class="bi-cart-fill me-1"></i>
                                            Contratar
                                        </button>


                                    @endif
                                @endif
                            @else
                                <button class="btn btn-outline-dark flex-shrink-0" onclick="window.location.href='{{ route('registrouser') }}'" type="button">
                                    <i class="bi-cart-fill me-1"></i>
                                    Contratar
                                </button>

                            @endif






                        </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </section>


        {{-- PopUp --}}

        <form class="" action="{{ route('iPContract') }}" method="POST" enctype="" novalidate>
            @csrf
            <input type="hidden" class="set-user-offer-input" name="userOffer" value="{{ $serviceProfile->use_id }}" required>
            <input type="hidden" class="set-price-offer-input" name="priceOffer" value="{{ $serviceProfile->precio }}" required>
            <input type="hidden" class="set-service-offer-input" name="serviceOffer" value="{{ $serviceProfile->id }}" required>
            <input type="hidden" class="set-type-offer-input" name="typeOfJob" value="1" required>



            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="ventanaModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="text-center">
                            <h5 class="modal-title m-2" id="ventanaModal">Contratar servicio</h5>
                        </div>

                        <!-- Cuerpo modal -->
                        <div class="modal-body">
                            <div class="m-1" id="formulario">
                                <label class="">Contratado por: Usuario nuevo</label><br>
                                <label>Hora: </label><br>
                                <input type="time" class="form-control" value="{{ old('hourForm') }}" name="hourForm">
                                <label class="m-1">Fecha: </label>
                                <input type="date" class="form-control" value="{{ old('dateForm') }}" name="dateForm" min="2020-11-02" id="fechaContrato" required>

                                <label class="m-1" for="">Lugar</label>
                                <input type="text" class="form-control" name="addressForm" value="{{ old('addressForm') }}" placeholder="Lugar">


                                <label class="m-1">Descripcion</label><br>
                                <input class="form-control" name="descriptionForm" value="{{ old('descriptionForm') }}" placeholder="Descripcion">
                            </div>
                        </div>

                        <!-- Botones pie -->
                        <div class="form-group row justify-content-center">
                            <div class="col-sm-3">
                            <input type="submit" value="Siguiente" class="btn btn-primary"/>
                            </div>
                            <div class="col-sm-3">
                            <input type="submit" value="Cancelar" class="btn btn-danger" data-bs-dismiss="modal" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>

        {{-- comentario --}}
    <div class="container px-4 px-lg-5 my-5">
        <div class="col-3">
            <h2 class="headertekst">Comentarios</h2>
        </div>

        <div class="container-fluid my-5">
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Preguntas Frecuentes</h5>
                            <button type="button" class="btn btn-sm btn-primary" name="btnpregunta" data-toggle="modal" data-target="#Modalpregunta">Añadir Pregunta Frecuente</button>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body p-3">
                            <h6 class="card-subtitle mb-2 text-muted">¿Cuanto tiempo demora el servicio?</h6>
                            <p class="card-text">Demora entre dos o tres días</p>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body p-3">
                            <h6 class="card-subtitle mb-2 text-muted">¿Existe la posibilidad de obtener alguna rebaja?</h6>
                            <p class="card-text">Todo se puede conversar, asi que no se descarta</p>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body p-3">
                            <h6 class="card-subtitle mb-2 text-muted">¿Que pasa si no arreglan mi problema?</h6>
                            <p class="card-text">No se le cobraría al cliente</p>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body p-3">
                            <h6 class="card-subtitle mb-2 text-muted">¿Atienden todos los días?</h6>
                            <p class="card-text">Atendemos de Lunes a Domingo excepto los feriados</p>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body p-3">
                            <h6 class="card-subtitle mb-2 text-muted">¿Hacen turnos nocturnos?</h6>
                            <p class="card-text">No, por un tema de seguridad trabajamos de 8:00 am hasta las 6:00 pm</p>
                        </div>
                    </div>
                </div>
                <div class="col-6">

                    <!--- Post Form Begins -->
                    <section class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">
                                        Realizar Comentario</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                    <div class="form-group">
                                        <label class="sr-only" for="message">post</label>
                                        <textarea class="form-control" id="message" rows="3" placeholder="Escriba lo que piensa..."></textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn" style="background-color: rgba(10, 169, 190, 0.61)">Comentar</button>
                            </div>
                        </div>
                    </section>
                    <!--- Post Form Ends -->

                    <!-- Post Begins -->
                    <section class="card mt-4">
                        <div class="border p-2">
                            <!-- post header -->
                            <div class="row m-0">
                                <div class="">
                                    <a class="text-decoration-none" href="#">
                                        <img class="" src="https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/avat-01-512.png" width="50" height="50" alt="...">
                                    </a>
                                </div>
                                <div class="flex-grow-1 pl-2">
                                    <a class="text-decoration-none" href="#">
                                        <h2 class="text-capitalize h5 mb-0">Lapadula</h2>
                                    </a>
                                    <p class="small text-secondary m-0 mt-1">Hace 1 día</p>
                                </div>

                                <div class="dropdown">
                                    <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-chevron-down"></i>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item text-primary" href="#">Editar</a>
                                        <a class="dropdown-item text-primary" href="#">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                            <!-- post body -->
                            <div class="">
                                <p class="my-2">
                                    Que buen servicio
                                </p>
                            </div>
                            <hr class="my-1">
                            <!-- post footer begins -->
                            <footer class="">
                                <!-- post actions -->
                                <div class="">
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item flex-fill text-center p-0 px-lg-2 border border-0">
                                            <a class="small text-decoration-none" href="#">
                                                <i class="far fa-thumbs-up"></i> 1 Me gusta
                                            </a>
                                        </li>
                                        <li class="list-group-item flex-fill text-center p-0 px-lg-2 border border-right-0 border-top-0 border-bottom-0">
                                            <a class="small text-decoration-none" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                <i class="fas fa-comment-alt"></i> 1 Comentario
                                            </a>
                                        </li>
                                        <li class="list-group-item flex-fill text-center p-0 px-lg-2 border border-right-0 border-top-0 border-bottom-0 ">
                                            <a class="small text-decoration-none" href="#">
                                                <i class="fas fa-share"></i> 1 Compartir
                                            </a>
                                        </li>
                                    </ul>
                                </div>


                                <!-- collapsed comments begins -->
                                <div class="collapse" id="collapseExample1">
                                    <div class="card border border-right-0 border-left-0 border-bottom-0 mt-1">
                                        <!-- new comment form -->
                                        <section class="mt-3">
                                            <form action="">
                                                <div class="input-group input-group">
                                                    <input type="text" class="form-control" placeholder="Escribir algo..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <a class="text-decoration-none text-white btn btn-primary" href="#" role="button" style="background-color: rgb(0, 0, 0)">Responder</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </section>
                                        <!-- comment card bgins -->
                                        <section>
                                            <div class="card p-2 mt-3" style="background-color: rgb(154, 231, 195)">
                                                <!-- comment header -->
                                                <div class="d-flex">
                                                    <div class="">
                                                        <a class="text-decoration-none" href="#">
                                                            <img class="profile-pic" src="https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/avat-01-512.png" width="40" height="40" alt="...">
                                                        </a>
                                                    </div>
                                                    <div class="flex-grow-1 pl-2">
                                                        <a class="text-decoration-none text-capitalize h6 m-0" href="#">Carrillo</a><label class="text-muted small"> &nbsp; Respondiendo a Gareca</label>
                                                        <p class="small m-0 text-muted">Hace 27 minutos</p>
                                                    </div>
                                                    <div >
                                                        <div class="dropdown">
                                                            <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-chevron-down"></i>
                                                            </a>

                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item text-primary" href="#">Editar</a>
                                                                <a class="dropdown-item text-primary" href="#">Eliminar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- comment header -->
                                                <!-- comment body -->
                                                <div class="card-body p-0">
                                                    <p class="card-text h7 mb-1">Concuerdo con usted</p>
                                                    <a class="card-link small" href="#">
                                                        <i class="far fa-thumbs-up"></i> 1 Me gusta
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card p-2 mt-3" style="background-color: rgb(154, 231, 195)">
                                                <!-- comment header -->
                                                <div class="d-flex">
                                                    <div class="">
                                                        <a class="text-decoration-none" href="#">
                                                            <img class="profile-pic" src="https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/avat-01-512.png" width="40" height="40" alt="...">
                                                        </a>
                                                    </div>
                                                    <div class="flex-grow-1 pl-2">
                                                        <a class="text-decoration-none text-capitalize h6 m-0" href="#">Carrillo</a><label class="text-muted small"> &nbsp; Respondiendo a Lapadula</label>
                                                        <p class="small m-0 text-muted">Hace 27 minutos</p>
                                                    </div>
                                                    <div >
                                                        <div class="dropdown">
                                                            <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-chevron-down"></i>
                                                            </a>

                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item text-primary" href="#">Editar</a>
                                                                <a class="dropdown-item text-primary" href="#">Eliminar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- comment header -->
                                                <!-- comment body -->
                                                <div class="card-body p-0">
                                                    <p class="card-text h7 mb-1">Concuerdo con usted</p>
                                                    <a class="card-link small" href="#">
                                                        <i class="far fa-thumbs-up"></i> 1 Me gusta
                                                    </a>
                                                </div>
                                            </div>
                                        </section>
                                        <!-- comment card ends -->

                                    </div>
                                </div>
                                <!-- collapsed comments ends -->
                            </footer>
                            <!-- post footer ends -->
                        </div>
                        <!---pt2 del comentariooooooooooooooooooooo >
                            <!-- Post Begins -->
                    <section class="card mt-4">
                        <div class="border p-2">
                            <!-- post header -->
                            <div class="row m-0">
                                <div class="">
                                    <a class="text-decoration-none" href="#">
                                        <img class="" src="https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/avat-01-512.png" width="50" height="50" alt="...">
                                    </a>
                                </div>
                                <div class="flex-grow-1 pl-2">
                                    <a class="text-decoration-none" href="#">
                                        <h2 class="text-capitalize h5 mb-0">Lapadula2</h2>
                                    </a>
                                    <p class="small text-secondary m-0 mt-1">Hace 1 día</p>
                                </div>

                                <div class="dropdown">
                                    <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-chevron-down"></i>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item text-primary" href="#">Editar</a>
                                        <a class="dropdown-item text-primary" href="#">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                            <!-- post body -->
                            <div class="">
                                <p class="my-2">
                                    Que buen servicio
                                </p>
                            </div>
                            <hr class="my-1">
                            <!-- post footer begins -->
                            <footer class="">
                                <!-- post actions -->
                                <div class="">
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item flex-fill text-center p-0 px-lg-2 border border-0">
                                            <a class="small text-decoration-none" href="#">
                                                <i class="far fa-thumbs-up"></i> 1 Me gusta
                                            </a>
                                        </li>
                                        <li class="list-group-item flex-fill text-center p-0 px-lg-2 border border-right-0 border-top-0 border-bottom-0">
                                            <a class="small text-decoration-none" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                <i class="fas fa-comment-alt"></i> 1 Comentario
                                            </a>
                                        </li>

                                        <li class="list-group-item flex-fill text-center p-0 px-lg-2 border border-right-0 border-top-0 border-bottom-0 ">
                                            <a class="small text-decoration-none" href="#">
                                                <i class="fas fa-share"></i> 1 Compartir
                                            </a>
                                        </li>
                                    </ul>
                                </div>


                                <!-- collapsed comments begins -->
                                <div class="collapse" id="collapseExample2">
                                    <div class="card border border-right-0 border-left-0 border-bottom-0 mt-1">
                                        <!-- new comment form -->
                                        <section class="mt-3">
                                            <form action="">
                                                <div class="input-group input-group">
                                                    <input type="text" class="form-control" placeholder="Escribir algo..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <a class="text-decoration-none text-white btn btn-primary" href="#" role="button" style="background-color: rgb(0, 0, 0)">Responder</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </section>
                                        <!-- comment card bgins -->
                                        <section>
                                            <div class="card p-2 mt-3" style="background-color: rgb(154, 231, 195)">
                                                <!-- comment header -->
                                                <div class="d-flex">
                                                    <div class="">
                                                        <a class="text-decoration-none" href="#">
                                                            <img class="profile-pic" src="https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/avat-01-512.png" width="40" height="40" alt="...">
                                                        </a>
                                                    </div>
                                                    <div class="flex-grow-1 pl-2">
                                                        <a class="text-decoration-none text-capitalize h6 m-0" href="#">Carrillo2</a><label class="text-muted small"> &nbsp; Respondiendo a Lapadula2</label>
                                                        <p class="small m-0 text-muted">Hace 27 minutos</p>
                                                    </div>
                                                    <div >
                                                        <div class="dropdown">
                                                            <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-chevron-down"></i>
                                                            </a>

                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item text-primary" href="#">Editar</a>
                                                                <a class="dropdown-item text-primary" href="#">Eliminar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- comment header -->
                                                <!-- comment body -->
                                                <div class="card-body p-0">
                                                    <p class="card-text h7 mb-1">Concuerdo con usted2</p>
                                                    <a class="card-link small" href="#">
                                                        <i class="far fa-thumbs-up"></i> 2 Me gusta
                                                    </a>
                                                </div>
                                            </div>
                                        </section>
                                        <!-- comment card ends -->

                                    </div>
                                </div>
                                <!-- collapsed comments ends -->
                            </footer>
                            <!-- post footer ends -->
                        </div>







                    </section>
                    <!-- Post Ends -->
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body p-3">
                            <h5 class="card-title m-0">Oficios Disponibles</h5>
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action text-primary">
                                Electricista
                                </a>
                                <a href="#" class="list-group-item list-group-item-action text-primary">Gasfitero</a>
                                <a href="#" class="list-group-item list-group-item-action text-primary">Carpintero</a>
                                <a href="#" class="list-group-item list-group-item-action text-primary">Niñera</a>
                                <a href="#" class="btn btn-sm btn-primary">Ver más</a>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body p-3">
                            <h5 class="card-title m-0">Talentos</h5>
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action text-primary">
                                Contar Chistes
                                </a>
                                <a href="#" class="list-group-item list-group-item-action text-primary">Relatar Cuentos</a>
                                <a href="#" class="list-group-item list-group-item-action text-primary">Hacer Magia</a>
                                <a href="#" class="list-group-item list-group-item-action text-primary">Tocar Instrumentos</a>
                                <a href="#" class="btn btn-sm btn-primary">Ver más</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- The Modal -->
        <div class="modal fade" id="Modalpregunta">
            <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title">Añadir pregunta frecuente</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">


                    <div class="form-row">

                        <div class="form-group col-md-12">
                        <label for="inputEmail4">Escribir Pregunta Frecuente</label>
                        <input type="text" name="pregunta" class="form-control" id="inputPregunta" placeholder="Escriba la Pregunta Frecuente*" />
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-12">
                        <label for="inputEmail4">Responder Pregunta Frecuente</label>
                        <input type="text" name="respuesta" class="form-control" id="inputRespuesta" placeholder="Responda la Pregunta Frecuente*" />
                        </div>
                    </div>






                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success">Publicar Pregunta

                </button>

                <button id="cerrarBtn" type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>

                </div>

                </form>
            </div>
            </div>
        </div>
    </div>


@endsection

@section('contenido_abajo_js')

@if (session('contractFailed'))
<script>
    Swal.fire({
        title: "Error en el contrato",
        html:  `
        {{session('contractFailed')}}
        <br>
        <ul>
            @foreach ($errors->contractProccessForm->all() as $errorRegister)
                <li>{{ $errorRegister }}</li>
            @endforeach
        </ul>`,
        icon: "error"
    });
</script>
@endif

@if (session('contractMessage'))
<script>
    Swal.fire({
        title: "Contrato correctamente",
        html:  `
        {{session('contractMessage')}}`,
        icon: "success"
    });
</script>
@endif
@endsection
