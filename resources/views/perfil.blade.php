@extends('layouts.app')

@section('contenido_js')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

@endsection

@section('contenido_cSS')
<link href="{{ asset('css/perfilcss.css') }}" rel="stylesheet">

@endsection

@section('content')



<!------ Include the above in your HEAD tag ---------->
<div class="container emp-profile" >
            {{-- <form method="post"> --}}
                <div class="col-12 col-sm-12 col-md-10 col-lg-10">
                    <ul class="text-danger">
                        @foreach ($errors->contractProccessForm->all() as $errorRegister)
                            <li>{{ $errorRegister }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="https://r100consulting.com/wp-content/uploads/2019/05/TRABAJADORES-2-.png" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Cambiar foto
                                <input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                    {{ $user->name }}
                                    </h5>
                                    <h6>
                                        @if($user->UseOccIntermediate!=null && $user->UseOccIntermediate->count()>0)
                                            {{ $user->UseOccIntermediate[0]->IntermediateOcc->ser_occ_name }}
                                        @else
                                            @if($user->UseTalIntermediate!=null && $user->UseTalIntermediate->count()>0)
                                                {{ $user->UseTalIntermediate[0]->IntermediateTal->ser_tal_name }}
                                            @else
                                                No registra ningun servicio
                                            @endif
                                        @endif

                                    <br>
                                    {{-- @foreach($servOcu as $serv)

                                    {{ $serv->ser_occ_name }}

                                    @endforeach --}}
                                    </h6>
                                    <p class="proile-rating">CALIFICACION : <span>8/10</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Datos Personales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Servicios</a>
                                </li>
                                @if (auth()->user()->id == $user->id)
                                    <li class="nav-item">
                                        <a class="nav-link" id="solicitudes-tab" data-toggle="tab" href="#solicitudes" role="tab" aria-controls="solicitudes" aria-selected="false">Solicitudes de contratos</a>
                                    </li>
                                @endif
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        @if(auth()->user()->id == $user->id)
                            <button type="button" class="profile-edit-btn" name="btnAddMore" data-toggle="modal" data-target="#myModal" >
                            Editar Perfil
                            </button>
                        @endif

                        @php
                            $flag=$errors->any();
                        @endphp

                        <!-- The Modal -->
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                    <h4 class="modal-title">Editar Perfil</h4>
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                    </div>

                                    <form action="{{route('update.user',\Auth::user())}}" method="POST" >
                                    {{ csrf_field() }}  @method("PATCH")
                                    <!-- Modal body -->
                                    <div class="modal-corpo">


                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                            <label for="inputEmail4">Nombre</label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputNombre" placeholder="Escriba su Nombre*" value="{{ old('name',$user->name)}}" />
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                            <label for="inputPassword4">Apellidos</label>
                                            <input type="text" name="lastname" class="form-control @error('lastname') is-invalid @enderror" id="inputApellidos" placeholder="Escriba sus Apellidos*" value="{{ old('lastname',$user->lastname)}}" />
                                            @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                            <label for="inputEmail4">Correo</label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputCorreo" placeholder="Escriba su Correo*" value="{{ old('email',$user->email)}}"/>
                                            @if($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                            </div>

                                            <div class="form-group col-md-6">
                                            <label for="inputPassword4">Contraseña</label>
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword" placeholder="Escriba su contraseña*" value="{{ old('password') }}"/>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label for="inputNaci">Fecha de Nacimiento</label>
                                                <input class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" type="text" placeholder="Fecha de Nacimiento" onclick="ocultarError();" onfocus="(this.type='date')" onblur="(this.type='text')" value="{{ old('birthdate',$user->birthdate)}}" />
                                                @error('birthdate')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="form-group col-md-6">
                                            <label for="inputDNI">DNI</label>
                                            <input type="number" minlength="10" maxlength="10" name="dni" class="form-control @error('dni') is-invalid @enderror" placeholder="Escriba su DNI *" value="{{ old('dni',$user->DNI)}}"  />
                                            @error('dni')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            </div>

                                        </div>





                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-success">Guardar

                                    </button>

                                    <button id="cerrarBtn" type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>

                                    </div>

                                    </form>
                                </div>
                                </div>
                            </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>Mis contratos realizados</p>
                            @foreach ($user->UseContractReceive as $Contract)
                                @if ($Contract->con_status != 3)
                                    @if ($Contract->use_tal_id !== null)
                                        <a href="{{ route('estadoContratoTal',$Contract->id) }}">{{$Contract->IntermediateUseTal->IntermediateTal->ser_tal_name}}</a><br/>
                                    @endif
                                    @if ($Contract->use_occ_id !== null)
                                        <a href="{{ route('estadoContratoOcu',$Contract->id) }}">{{$Contract->IntermediateUseOcc->IntermediateOcc->ser_occ_name}}</a><br/>
                                    @endif
                                @endif
                            @endforeach
                            <p>Contratos Pasados</p>
                            @foreach ($user->UseContractReceive as $Contract)
                                @if ($Contract->con_status == 3)
                                    @if ($Contract->use_tal_id !== null)
                                        <a href="{{ route('estadoContratoTal',$Contract->id) }}">{{$Contract->IntermediateTal->ser_tal_name}}</a><br/>
                                    @endif
                                    @if ($Contract->use_occ_id !== null)
                                        <a href="{{ route('estadoContratoOcu',$Contract->id) }}">{{$Contract->IntermediateOcc->ser_occ_name}}</a><br/>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nombres</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{ $user->name }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Apellidos</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{ $user->lastname }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Correo</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{ $user->email }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>DNI</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{ $user->DNI }}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Servicio</label>
                                            </div>
                                            <div class="col-md-6">

                                            @if($user->UseOccIntermediate!=null && $user->UseOccIntermediate->count()>0)
                                                <p> {{ $user->UseOccIntermediate[0]->IntermediateOcc->ser_occ_name }}</p>
                                            @else
                                                @if($user->UseTalIntermediate!=null && $user->UseTalIntermediate->count()>0)
                                                  <p>  {{ $user->UseTalIntermediate[0]->IntermediateTal->ser_tal_name }}</p>
                                                @else
                                                    No registra ningun servicio
                                                @endif
                                            @endif

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nacimiento</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{ $user->birthdate }}</p>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                @foreach($user->UseOccIntermediate as $serviceUsers)
                                <div class="d-flex justify-content-between form-details-get">
                                    <input type="hidden" class="get-user-offer-input" name="userOffer" value="{{ $serviceUsers->use_id }}" required>
                                    <input type="hidden" class="get-price-offer-input" name="priceOffer" value="{{ $serviceUsers->precio }}" required>
                                    <input type="hidden" class="get-service-offer-input" name="serviceOffer" value="{{ $serviceUsers->id }}" required>
                                    <input type="hidden" class="get-type-offer-input" name="typeOfJob" value="1">
                                    <a href="{{ route('showProfileServiceOccupation',$serviceUsers->id) }}">{{ $serviceUsers->IntermediateOcc->ser_occ_name }}</a>









                                    @php
                                        $receivedServiceNow2 = false;
                                    @endphp
                                    @if(auth()->user()!=null)
                                        @if(auth()->user()->id == $serviceUsers->IntermediateUseOcc->id)
                                            <button class="btn btn-outline-dark flex-shrink-0" disabled type="button">
                                                <em class="bi-cart-fill me-1"></em>
                                                Tu eres el del servicio
                                            </button>

                                        @else
                                            @foreach($serviceUsers->IntermediateOccContract as $contract)
                                                @if($contract->use_receive == auth()->user()->id)
                                                    @php
                                                        $receivedServiceNow2 =true;
                                                    @endphp
                                                @else
                                                @endif

                                            @endforeach
                                            @if($receivedServiceNow2 == true)
                                            <div class="text-danger">* Para comunicarte <br> con el que<br> ofrece el servicio<br>, presione <a href="">AQUI</a> </div>

                                            <button type="button" class="btn btn-secondary p-3 btn-details-now-data" disabled>
                                                Contratar
                                            </button>
                                            <br>
                                            @else
                                                <button type="button" class="btn btn-secondary p-3 btn-details-now-data" onclick="window.location.href='{{ route('showProfileServiceOccupation',$serviceUsers->id) }}'">
                                                    Contratar
                                                </button>


                                            @endif
                                        @endif
                                    @else
                                        <button class="btn btn-outline-dark flex-shrink-0" onclick="window.location.href='{{ route('registrouser') }}'" type="button">
                                            <em class="bi-cart-fill me-1"></em>
                                            Contratar
                                        </button>

                                    @endif

                                    <br/>

                                </div>
                                @endforeach


                                @foreach($user->UseTalIntermediate as $serviceTalUsers)
                                    <div class="d-flex justify-content-between form-details-get">
                                        <input type="hidden" class="get-user-offer-input" name="userOffer" value="{{ $serviceTalUsers->use_id }}" required>
                                        <input type="hidden" class="get-price-offer-input" name="priceOffer" value="{{ $serviceTalUsers->precio }}" required>
                                        <input type="hidden" class="get-service-offer-input" name="serviceOffer" value="{{ $serviceTalUsers->id }}" required>
                                        <input type="hidden" class="get-type-offer-input" name="typeOfJob" value="2">

                                        <a href="{{ route('showProfileServiceTalent',$serviceTalUsers->id) }}">{{ $serviceTalUsers->IntermediateTal->ser_tal_name }}</a>









                                    @php
                                        $receivedServiceNow = false;
                                    @endphp
                                    @if(auth()->user()!=null)
                                        @if(auth()->user()->id == $serviceTalUsers->IntermediateUseTal->id)
                                            <button class="btn btn-outline-dark flex-shrink-0" disabled type="button">
                                                <em class="bi-cart-fill me-1"></em>
                                                Tu eres el del servicio
                                            </button>

                                        @else
                                            @foreach($serviceTalUsers->IntermetiateTalContract as $contract)
                                                @if($contract->use_receive == auth()->user()->id)
                                                    @php
                                                        $receivedServiceNow =true;
                                                    @endphp
                                                @else
                                                @endif

                                            @endforeach
                                            @if($receivedServiceNow == true)
                                            <div class="text-danger">* Para comunicarte <br> con el que<br> ofrece el servicio<br>, presione <a href="">AQUI</a> </div>

                                            <button type="button" class="btn btn-secondary p-3 btn-details-now-data" disabled>
                                                Contratar
                                            </button>
                                            <br>
                                            @else

                                            <button type="button" class="btn btn-secondary p-3" onclick="window.location.href='{{ route('showProfileServiceTalent',$serviceTalUsers->id) }}'">
                                                Contratar
                                            </button>



                                            @endif
                                        @endif
                                    @else
                                        <button class="btn btn-outline-dark flex-shrink-0" onclick="window.location.href='{{ route('registrouser') }}'" type="button">
                                            <em class="bi-cart-fill me-1"></em>
                                            Contratar
                                        </button>

                                    @endif










                                        <br/>
                                    </div>
                                @endforeach


                            </div>
                            @if (auth()->user()->id == $user->id)
                                <div class="tab-pane fade" id="solicitudes" role="tabpanel" aria-labelledby="solicitudes-tab">
                                    @foreach ($user->UseContractOffer as $Contract)
                                        @if ($Contract->con_status == 1)                                                                                
                                            @if ($Contract->use_tal_id !== null)
                                                <form action=" {{route('eject.contract')}} " method="POST">
                                                    @csrf
                                                    {{$Contract->IntermediateUseTal->IntermediateTal->ser_tal_name}}
                                                    <input type="hidden" name="contractId" value="{{ $Contract->id }}" required>
                                                    <button type="submit" class="btn btn-secondary p-3">Ejecutar Servicio</button>
                                                </form>
                                            @elseif($Contract->use_occ_id !== null)
                                                <form action=" {{route('eject.contract')}} " method="POST">
                                                    @csrf
                                                    {{$Contract->IntermediateUseOcc->IntermediateOcc->ser_occ_name}}
                                                    <input type="hidden" name="contractId" value="{{ $Contract->id }}" required>
                                                    <button type="submit" class="btn btn-secondary p-3">Ejecutar Servicio</button>
                                                </form>
                                            @endif
                                        @endif                                        
                                    @endforeach
                                    @if ($user->UseContractOffer->where('con_status',1)->count()== 0)
                                        No hay contratos pendientes disponibles
                                    @endif
                                </div>    
                            @endif
                            

                        </div>
                    </div>
                </div>
            {{-- </form> --}}
        </div>


@endsection


@section('contenido_abajo_js')


@if (session('updateMessage'))
<script>
    Swal.fire({
        title: "Datos actualizados",
        html:  `
        {{session('updateMessage')}}`,
        icon: "success"
    });
</script>
@endif

<!-- @if ($flag==1)
<script>
    document.addEventListener('DOMContentLoaded', () => {
        $("#myModal").modal("show");
    })
</script>
        @php
            $flag=0;
        @endphp
@endif -->


@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', () => {
        $("#myModal").modal("show");
    })
</script>

<script>
    const cerrarBtn = document.getElementById('cerrarBtn');
    console.log('BOTÓN CERRAR', cerrarBtn);
    cerrarBtn.addEventListener('click', () => {
        console.log('diste click')
        $('#myModal').modal('hide')
    })
</script>

<!-- <h3 class="h-light"> ERRORES {{$flag}} </h3> -->
@endif

@endsection

