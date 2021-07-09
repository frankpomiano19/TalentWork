@extends('layouts.app')


@section('contenido_js')
    <!-- Core theme JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    
@endsection

@section('contenido_cSS')

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
                                        <div class="text-danger">* Para comunicarte con el que ofrece el servicio, presione chat: </div>   
                               
                                       
                                     
                                       
                                                        
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












  <button class="open-button" onclick="openForm()">
     <font style="vertical-align: inherit;">
        <font style="vertical-align: inherit;">Chat</font>
     </font>
  </button>
        
    <div class="chat-popup" id="myForm" style="display: none;">
        <form action="/action_page.php" class="form-container">

           
            <div class="portlet portlet-default">
                <div class="portlet-heading">

                    <div class="portlet-title">
                        <h4><i class="fa fa-circle text-green"></i> Jane Smith</h4>
                    </div>

                    <div class="portlet-widgets">
                        <span class="divider"></span>
                        <a data-toggle="collapse" data-parent="#accordion" href="#chat"><i class="fa fa-chevron-down"></i></a>
                    </div>

                    <div class="clearfix"></div>
                </div>
                

                  
                    <div class="portlet-body chat-widget" style="overflow-y: auto; width: auto; height: 300px;">

                        <div class="row">
                            <div class="col-lg-12">
                                <p class="text-center text-muted small">January 1, 2014 at 12:23 PM</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object img-circle img-chat" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">Jane Smith
                                            <span class="small pull-right">12:23 PM</span>
                                        </h4>
                                        <p>Hi, I wanted to make sure you got the latest product report. Did Roddy get it to you?</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                

                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object img-circle img-chat" src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">John Smith
                                            <span class="small pull-right">12:28 PM</span>
                                        </h4>
                                        <p>Yeah I did. Everything looks good.</p>
                                        <p>Did you have an update on purchase order #302?</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object img-circle img-chat" src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">Jane Smith
                                            <span class="small pull-right">12:39 PM</span>
                                        </h4>
                                        <p>No not yet, the transaction hasn't cleared yet. I will let you know as soon as everything goes through. Any idea where you want to get lunch today?</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                    
                    </div>     
               
            </div>
        
        
              <div class="portlet-footer">
                            <div class="form-group">                        
                            <input class="form-control form-control-lg" type="text" placeholder="Enter message...">
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-default pull-right">Send</button>
                                <div class="clearfix"></div>
                            </div>
                       

                </div>     

        
        

        <button type="button" class="btn cancel" onclick="closeForm()"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Close</font></font></button>
        </form>
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


<script>
function openForm() {
    document.getElementById("myForm").style.display = "block";
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}
</script>

@endsection






