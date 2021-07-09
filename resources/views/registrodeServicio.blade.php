@extends('layouts.app')

@section('contenido_js')

  <!-- Required meta tags-->
  <meta name="description" content="Colorlib Templates">
  <meta name="author" content="Colorlib">
  <meta name="keywords" content="Colorlib Templates">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

@endsection

@section('contenido_cSS')
    
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">-->
@endsection


@section('content')
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Registre su servicio</h2>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="servicio">Seleccione el tipo de servicio que quiere brindar</label> <br>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="service-tab" data-toggle="tab" href="#service" role="tab" aria-controls="service" aria-selected="true">
                              <button type="button" class="btn btn-primary btn-lg">Servicio Técnico</button>
                            </a>
                          </li>
                          <li class="nav-item" role="presentation">
                            <a class="nav-link" id="talent-tab" data-toggle="tab" href="#talent" role="tab" aria-controls="talent" aria-selected="false">
                              <button type="button" class="btn btn-secondary btn-lg">Talento</button>
                            </a>
                          </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="service" role="tabpanel" aria-labelledby="service-tab">
                        <form action=" {{route('servicio.tecnico')}} " method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">
                            <label for="servicioTecn">Seleccione su servicio técnico perteneciente</label>
                            <select class="form-control" id="servicioTecn" name="servicioTecn" required>
                              @foreach ($serviciosTec as $item)
                                  <option value= {{$item->id}}>{{$item->ser_occ_name}}</option> 
                              @endforeach
                            </select>
                          </div>
                          @error('detallesTecn')
                            <div class="alert alert-danger" role="alert">
                              <strong>Atención.</strong> La descripción del servicio es necesaria.
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                          @enderror
                          <div class="form-group">
                            <label for="detallesTecn">Ingrese los detalles de su servicio</label>
                            <textarea class="form-control" id="detallesTecn" name="detallesTecn" rows="3" required></textarea>
                          </div>
                          @error('costoTecn')
                          <div class="alert alert-danger" role="alert">
                            <strong>Atención.</strong> Por favor ingrese el costo de su servicio.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @enderror
                          <div class="form-group">
                            <label for="costoTecn">Ingrese el costo de su servicio</label>
                            <input type="number" class="form-control" id="costoTecn" name="costoTecn" required>
                          </div>
                          @error('imagenTecn')
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <small>Solo se acepta imagen con formato JPEG,BMP,JPG o PNG (máx 6MB)</small>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          @enderror
                          <div class="form-group">
                              <label for="imagenTecn">Ingrese una imagen referente de su servicio</label>
                              <input type="file" class="form-control-file" id="imagenTecn" name="imagenTecn" required>
                            </div>
                          <button type="submit" class="btn btn-primary">Guardar servicio</button>
                        </form>
                      </div>
                      <div class="tab-pane fade" id="talent" role="tabpanel" aria-labelledby="talent-tab">
                        <form action=" {{route('servicio.talento')}} " method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group">
                            <label for="servicioTalen">Seleccione su talento perteneciente</label>
                            <select class="form-control" id="servicioTalen" name ="servicioTalen" required>
                              @foreach ($serviciosTal as $item)
                                  <option value={{$item->id}}>{{$item->ser_tal_name}}</option>
                              @endforeach
                            </select>
                          </div>
                          @error('detallesTalen')
                          <div class="alert alert-danger" role="alert">
                            <strong>Atención.</strong> La descripción de su talento es necesaria.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @enderror
                          <div class="form-group">
                            <label for="detallesTalen">Ingrese los detalles de su talento</label>
                            <textarea class="form-control" id="detallesTalen" name="detallesTalen" rows="3" required></textarea>
                          </div>
                          @error('costoTalen')
                          <div class="alert alert-danger" role="alert">
                            <strong>Atención.</strong> Por favor ingrese el costo de su servicio.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @enderror
                          <div class="form-group">
                            <label for="costoTalen">Ingrese el costo de su talento</label>
                            <input type="number" class="form-control" id="costoTalen" name="costoTalen" required>
                          </div>
                          @error('imagenTalen')
                          <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <small>Solo se acepta imagen con formato JPEG,BMP,JPG o PNG (máx 6MB)</small>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          @enderror
                          <div class="form-group">
                              <label for="imagenTalen">Ingrese una imagen referente de su talento</label>
                              <input type="file" class="form-control-file" id="imagenTalen" name ="imagenTalen" required>
                            </div>
                          <button type="submit" class="btn btn-primary">Guardar Talento</button>
                        </form>  
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('contenidoJSabajo')
    <!-- Colocar js abajo-->
    <script src="{{ asset('js/producto.js') }}"></script>
    <script src="/js/mapa.js"></script>
    <script>
      $("#updateU").submit(function(e){
        e.preventDefault();
      
        var datos = $(this).serialize();
        $.ajax({
            data: datos,
            url: $(this).attr('action'),
            type: 'POST',
            beforeSend: function(){
                $('#respuestas').html(''); //Reseteamos el contenido de respuestas.
            },
            success: function(res){
                if(res){
                    var resData = JSON.parse(res);
      
                    $('#usuario').val(resData[0]);
                    $('#nombre').val(resData[1]);
                    $("#contactoU").show();
                } 
                else $('#respuestas').html('Usuario no encontrado.');
            }
        });
      });
      
      
      </script>
@endsection
