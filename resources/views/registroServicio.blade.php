@extends('layouts.app')


@section('contenido_js')

@endsection

@section('contenido_cSS')

@endsection


@section('content')
<br>
<br>
<div class="form-group">
  <label for="servicio">Seleccione el tipo de servicio que quiere brindar</label>
  <button type="button" class="btn btn-primary btn-lg">Servicio Técnico</button>
  <button type="button" class="btn btn-secondary btn-lg">Talento</button>
</div>
<br>
<br>
  <form action=" {{route('servicio.tecnico')}} " method="POST">
    @csrf
    <div class="form-group">
      <label for="servicioTecn">Seleccione su servicio técnico perteneciente</label>
      <select class="form-control" id="servicioTecn" name="servicioTecn">
        @foreach ($serviciosTec as $item)
          <option value= {{$item->id}}>{{$item->ser_occ_name}}</option> 
        @endforeach
        
      </select>
    </div>

    <div class="form-group">
      <label for="detallesTecn">Ingrese los detalles de su servicio</label>
      <textarea class="form-control" id="detallesTecn" name="detallesTecn" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label for="costoTecn">Ingrese el costo de su servicio</label>
      <input type="number" class="form-control" id="costoTecn" name="costoTecn">
    </div>
    <div class="form-group">
        <label for="imagenTecn">Ingrese una imagen referente de su servicio</label>
        <input type="file" class="form-control-file" id="imagenTecn" name="imagenTecn">
      </div>
    <button type="submit" class="btn btn-primary">Guardar servicio</button>
  </form>

  <form action=" {{route('servicio.talento')}} " method="POST">
    @csrf
    <div class="form-group">
      <label for="servicioTalen">Seleccione su talento perteneciente</label>
      <select class="form-control" id="servicioTalen" name ="servicioTalen">
        @foreach ($serviciosTal as $item)
            <option value={{$item->id}}>{{$item->ser_tal_name}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="detallesTalen">Ingrese los detalles de su talento</label>
      <textarea class="form-control" id="detallesTalen" name="detallesTalen" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label for="costoTalen">Ingrese el costo de su talento</label>
      <input type="number" class="form-control" id="costoTalen" name="costoTalen">
    </div>
    <div class="form-group">
        <label for="imagenTalen">Ingrese una imagen referente de su talento</label>
        <input type="file" class="form-control-file" id="imagenTalen" name ="imagenTalen">
      </div>
    <button type="submit" class="btn btn-primary">Guardar Talento</button>
  </form>
@endsection
<script src="{{ asset('js/app.js') }}" defer></script>

@section('contenido_abajo_js')
<script>
</script>

@endsection