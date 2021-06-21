@extends('layouts.app')


@section('contenidoCSS')
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
@endsection


@section('content')

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">
    <script type="text/javascript" src="jquery-1.7.1.min.js"></script>

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/registro.css" rel="stylesheet" media="all">

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

</head>



<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Registre su servicio</h2>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="servicio">Seleccione el tipo de servicio que quiere brindar</label> <br>
                        <button type="button" class="btn btn-primary btn-lg">Servicio Técnico</button>
                        <button type="button" class="btn btn-secondary btn-lg">Talento</button>
                    </div>
                    
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
                </div>
            </div>
        </div>
    </div>
</body>

@endsection

@section('contenidoJSabajo')
    <!-- Colocar js abajo-->
    <script src="{{ asset('js/producto.js') }}"></script>
    <script src="/js/mapa.js"></script>
@endsection
