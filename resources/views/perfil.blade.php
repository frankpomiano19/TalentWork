@extends('layouts.app')

@section('contenido_js')

@endsection

@section('contenido_cSS')
<link href="{{ asset('css/perfilcss.css') }}" rel="stylesheet">
@endsection

@section('content')



<!------ Include the above in your HEAD tag ---------->
<body>
<div class="container emp-profile" >
            <form method="post">
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
                                        Leslie Arias Salinas
                                    </h5>
                                    <h6>
                                        Narradora de Chistes
                                    </h6>
                                    <p class="proile-rating">RANKINGS : <span>8/10</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Datos Personales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Servicios</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="historial-tab" data-toggle="tab" href="#historial" role="tab" aria-controls="historial" aria-selected="false">Historial</a>
                                </li>
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
                                                <p>Leslie</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Apellidos</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Arias Salinas</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Correo</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>LeslieAS@gmail.com</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>DNI</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>123 456 7890</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Ocuapación</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Contadora de Chistes</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nacimiento</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>01/01/2000</p>
                                            </div>
                                        </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                <a href="">Servicio 1</a><br/>
                                <a href="">Servicio 2</a><br/>
                                <a href="">Servicio 3</a><br/>
                                <a href="">Servicio 4</a><br/>

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
            </form>
        </div>
</body>
@endsection
