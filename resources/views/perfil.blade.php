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
                                    {{ Auth::user()->name }}
                                    </h5>
                                    <h6>
                                        @if(Auth::user()->UseOccIntermediate!=null && Auth::user()->UseOccIntermediate->count()>0)                                        
                                            {{ Auth::user()->UseOccIntermediate[0]->IntermediateOcc->ser_occ_name }}                                        
                                        @else
                                            @if(Auth::user()->UseTalIntermediate!=null && Auth::user()->UseTalIntermediate->count()>0)                                        
                                                {{ Auth::user()->UseTalIntermediate[0]->IntermediateTal->ser_tal_name }}
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
                                {{-- <li class="nav-item">
                                    <a class="nav-link" id="historial-tab" data-toggle="tab" href="#historial" role="tab" aria-controls="historial" aria-selected="false">Historial</a>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="profile-edit-btn" name="btnAddMore" data-toggle="modal" data-target="#myModal" >
                        Editar Perfil
                        </button>

                        <!-- The Modal -->
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                    <h4 class="modal-title">Editar Perfil</h4>
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">

                                        <form>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                            <label for="inputEmail4">Nombre</label>
                                            <input type="text" class="form-control" id="inputNombre" placeholder="Escriba su Nombre*" value="" required/>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>

                                        @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                            <label for="inputPassword4">Apellidos</label>
                                            <input type="text" class="form-control" id="inputApellidos" placeholder="Escriba sus Apellidos*" value="" required/>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                            <label for="inputEmail4">Correo</label>
                                            <input type="email" class="form-control" id="inputCorreo" placeholder="Escriba su Correo*" value="" required/>
                                            </div>
                                            <div class="form-group col-md-6">
                                            <label for="inputPassword4">Contraseña</label>
                                            <input type="password" class="form-control" id="inputPassword" placeholder="Escriba su contraseña*" value="" required/>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputNaci">Fecha de Nacimiento</label>
                                                <input class="form-control"  type="text" name="nacimientotitular" placeholder="Fecha de Nacimiento" onclick="ocultarError();" onfocus="(this.type='date')" onblur="(this.type='text')" value="" required/>
                                                @error('cumple')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                            <label for="inputDNI">DNI</label>
                                            <input type="number" minlength="10" maxlength="10" name="dni" class="form-control" placeholder="Escriba su DNI *" value="" required />
                                            </div>
                                        </div>




                                        </form>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-success">Guardar

                                    </button>

                                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>

                                    </div>

                                </div>
                                </div>
                            </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>Trabajos Asignados</p>
                            <a href="">Mis contratos</a><br/>
                            <p>Trabajos Pasados</p>
                            <a>Servicio 1(cumplido)</a><br/>
                            <a>Servicio 2(cumplido)</a><br/>
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

                                            @if(Auth::user()->UseOccIntermediate!=null && Auth::user()->UseOccIntermediate->count()>0)                                        
                                                <p> {{ Auth::user()->UseOccIntermediate[0]->IntermediateOcc->ser_occ_name }}</p>                                        
                                            @else
                                                @if(Auth::user()->UseTalIntermediate!=null && Auth::user()->UseTalIntermediate->count()>0)                                        
                                                  <p>  {{ Auth::user()->UseTalIntermediate[0]->IntermediateTal->ser_tal_name }}</p>
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
                                @foreach(Auth::user()->UseOccIntermediate as $serviceUsers)
                                <div class="d-flex justify-content-between">
                                    <a href="">{{ $serviceUsers->IntermediateOcc->ser_occ_name }}</a>
                                    <button type="button" class="btn btn-secondary p-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Contratar
                                        </button>                                    
                                    <br/>                                
                                    <form class="" action="{{ route('iPContract') }}" method="POST" enctype="" novalidate>
                                        @csrf
                            
                                        <input type="hidden" name="userOffer" value="1" required>
                                        <input type="hidden" name="priceOffer" value="20.00" required>
                                        <input type="hidden" name="serviceOffer" value="1" required>
                                
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
                                </div>


                                @endforeach

                                @foreach(Auth::user()->UseTalIntermediate as $serviceTalUsers)
                                    <div class="d-flex justify-content-between">
                                        <a href="">{{ $serviceTalUsers->IntermediateTal->ser_occ_name }}</a>
                                        <button class="btn-info">Contratar</button>
                                        <br/>                                
                                    </div>
                                @endforeach

                            </div>
                            <div class="tab-pane fade" id="historial" role="tabpane2" aria-labelledby="profile-tab">

                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <table class="table" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Nombre del servicio</th>
                                                    <th>Fecha de Inicio</th>
                                                    <th>Fecha de Termino</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="#">Servicio 1</a></td>
                                                    <td>12/06/2021</td>
                                                    <td>13/06/2021</td>
                                                    <td> cumplido</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#">Servicio 2</a></td>
                                                    <td>10/06/2021</td>
                                                    <td>11/06/2021</td>
                                                    <td> cumplido </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#">Servicio 3</a></td>
                                                    <td>08/06/2021</td>
                                                    <td>09/06/2021</td>
                                                    <td>incumplido</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            {{-- </form> --}}
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