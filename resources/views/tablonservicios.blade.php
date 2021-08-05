@extends('layouts.app')


@section('contenido_js')
    
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js" integrity="sha384-zvPTdTn0oNW7YuTZj1NueYOFJSJNDFJGdKwMMlWDtr3b4xarXd2ydDUajHfnszL7" crossorigin="anonymous"></script>
@livewireStyles

@endsection

@section('contenido_cSS')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estiloChat.css') }}" />

@endsection


@section('content')
    <div class="row">
        <div class="col-10 my-2">
            @isset($agregado)
                <div class="alert alert-success alert-dismissible fade show ml-1" role="alert">
                    Tu solicitud ha sido agregada al tablón
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endisset
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show ml-1" role="alert">
                    Ha ocurrido un error, edita nuevamente la solicitud
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            {{-- <livewire:tablon-servicio> --}}
            <div class="row my-2" style="margin:0px;display: flex; align-items: center; justify-content: center;">
                <div class="col-4" style="margin:0px;">
                    <h5 style="margin-bottom: 0px;">Servicios registrados:</h5>
                </div>

                <div class="col-4" style="margin:0px;">
                    Talento:
                    <select>
                        @foreach ($talentos as $talento)
                            <option>
                            {{ $talento->ser_tal_name }} 
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4" style="margin:0px;">
                    Ocupación:
                    <select>
                        @foreach ($ocupaciones as $ocupacion)
                            <option>
                            {{ $ocupacion->ser_occ_name }} 
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                
                @foreach ($servicios as $servicio)
                    <div class="col-3 mt-2 text-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Ver detalles
                        </button>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLongTitle"><p>Servicio: {{ $servicio->servicio }}</p></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <p>Descripcion: {{ $servicio->descripcion }}</p>
                                    <p>Tipo: {{ $servicio->tipo }}</p>
                                    <p>Precio: {{ $servicio->precio }}</p>
                                    <p>Precio: {{ $servicio->id }}</p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                              </div>
                            </div>
                        </div>
                        <p>Descripcion: {{ $servicio->descripcion }}</p>

                    </div>
                    <hr>
                @endforeach
            </div>

        </div>
        <div class="col-2 my-2" style="margin:0px;">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Solicitar servicio nuevo</button>

            <div class="my-2 text-center">
                <p>Mis servicios</p>
            </div>

        </div>
        <form  action=" {{route('tablon.servicio')}} " method="POST" >
            @csrf
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Solicitud de servicio</h5>
                      
                    </div>
                    <div class="modal-body px-4">
                        <div class="my-2">
                            <label for="nombre_servicio" class="form-label">Servicio:</label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control" id="nombre_servicio">
                            @if($errors->has('nombre'))
                                <span class="badge bg-danger text-light">{{ $errors->first('nombre') }}</span>
                            @endif
                        </div>
                        <div class="mb-2">
                            <label for="descripcion_servicio" class="form-label">Descripción:</label>
                            <textarea class="form-control" name="descripcion" id="descripcion_servicio" rows="2">{{ old('descripcion') }}</textarea>
                            @if($errors->has('descripcion'))
                                <span class="badge bg-danger text-light">{{ $errors->first('descripcion') }}</span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="my-2 col-6">
                                <label for="precio_servicio" class="form-label">Precio:</label>
                                <input type="text" name="precio" value="{{ old('precio') }}" class="form-control" id="precio_servicio" placeholder="S/">
                                @if($errors->has('precio'))
                                <span class="badge bg-danger text-light">{{ $errors->first('precio') }}</span>
                            @endif
                            </div>
                            <div class="my-2 col-6">
                                <label for="tipo_servicio" class="form-label">Tipo:</label><br>
                                <select class="form-select form-control form-select-sm"  value="{{ old('tipo') }}"name="tipo" aria-label=".form-select-sm example">
                                    <option value="Talento">Talento</option>
                                    <option value="Ocupacion">Ocupación</option>
                                </select>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                      <button type="submit" class="btn btn-success">Publicar solicitud</button>
                    </div>
                  </div>
                </div>
            </div>
        </form>
    </div>

@livewireScripts


@endsection



@section('contenido_abajo_js')

<script>
    
</script>
@endsection