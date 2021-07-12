@extends('layouts.app')


@section('contenido_js')
    
@endsection

@section('contenido_cSS')

@endsection


@section('content')


<br>
<h1 style="text-align: center">Contrato N° <span>{{$id}} </span></h1>
<div class="row">
    <div class="col-sm-6">
    <div class="card" style="width: 18rem; margin-left : 14rem; margin-top: 2rem; margin-bottom: 2rem">
        <img class="card-img-top" src="{{$dataOcup->imagen}}" alt="Card image cap">  
        <div class="card-body">
            <h5 class="card-title">Datos tecnico</h5>
            <p class="card-text">{{$dataOcup->descripcion}}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">{{$contr->con_initial}}</li>
            <li class="list-group-item">{{$userOff->name, $userOff->lastname}}</li>
            <li class="list-group-item">{{$servOcupp->ser_occ_name}}</li>
        </ul>
    </div>
    </div>

<div class="col-sm-3" style="text-align: center; margin-top: 4rem">
    <h2>Detalles del contrato</h2>
        <p>{{$contr->con_initial}}</p>
        <p>{{$contr->con_initial}}</p>
        <p>{{$contr->con_address}}</p>
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