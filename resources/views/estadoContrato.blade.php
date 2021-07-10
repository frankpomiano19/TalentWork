@extends('layouts.app')


@section('contenido_js')
    
@endsection

@section('contenido_cSS')

@endsection


@section('content')


<br>
<h1 style="text-align: center">Contrato N° <span>1</span></h1>
<div class="row">
    <div class="col-sm-6">
    <div class="card" style="width: 18rem; margin-left : 14rem; margin-top: 2rem; margin-bottom: 2rem">
        <img class="card-img-top" src="img/product-1.jpg" alt="Card image cap">  
        <div class="card-body">
            <h5 class="card-title">Datos tecnico</h5>
            <p class="card-text">Servicio tecnico a domicilio, limpiamos tu casa y la dejamos desinfectada :v.</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">24-07-2021</li>
            <li class="list-group-item">Juanita Caperucita</li>
            <li class="list-group-item">Limpieza de hogar</li>
        </ul>
    </div>
    </div>

<div class="col-sm-3" style="text-align: center; margin-top: 4rem">
    <h2>Detalles del contrato</h2>
        <p>24-07-2021</p>
        <p>18:30</p>
        <p>Lima-San Juan de Lurigancho</p>
        <label>Estado: </label>
        <label>En proceso</label>
        <br> <br>
        <button type="button" class="btn btn-primary btn-lg">Finalizar contrato</button>
</div>
</div>
@endsection

@section('contenido_abajo_js')
<script>
</script>
    
@endsection