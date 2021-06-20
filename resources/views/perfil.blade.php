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
                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Editar Perfil"/>
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
