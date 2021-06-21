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
                    <form method="POST">
                <div class="form-row m-b-55">
                   <div class="form-row">
                       <div class="name">Seleccione el tipo de servicio que quiere brindar</div>
                            <div class="p-t-15">
                                <label class="radio-container m-r-55" required>Servicio Técnico
                                    <input type="radio" checked="checked" name="tipo_usuario">
                                    <span class="checkmark"></span>
                                </label>
                             </div>

                            <div class="p-t-15">
                                <label class="radio-container">Servicio Profesional
                                    <input type="radio" name="tipo_usuario">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            <div class="p-t-15">
                                <label class="radio-container">Talento
                                    <input type="radio" name="tipo_usuario" value="" >
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                    </div>    

                 <div>Nombre de Usuario:<input type='text' id="usuario" name="usuario"></div>
        <div>Empleado:<input type='text' id="nombre" name="nombre" ></div>
        

                    <div class="form-row">
                            <div class="name">Seleccione la categoría a la que su servicio pertenece</div>

                            <div class="value">
                                
                                    <div class="rs-select2 js-select-simple select--no-search">
                                       <select name="Categoría" id="categorias" class="form-control" required="">
                                            <option value="">Elegir opcion</option>
                                            <option value="Gráfica y diseño">Gráfica y diseño</option>
                                            <option value="Marketing digital">Marketing digital</option>
                                            <option value="Redacción y traducción">Redacción y traducción</option>
                                            <option value="Video y animación">Video y animación</option>
                                            <option value="Música y audio">Música y audio</option>
                                            <option value="Negocios">Negocios</option>
                                            <option value="otros">otros</option>
                                       </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                
                            </div>
                    </div>
                  
                    
                    


                        <div class="form-row">
                            <div class="name">Ingrese los detalles de su servicio</div>
                            <div class="value">
                                <div class="input-group">
                               <textarea input name="descripcion" id="" class="form-control" cols="30" rows="4" placeholder="Añade una descripción" required>{{ old('descripcion') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row m-b-55">
                            <div class="name">Ingrese una imagen referente a su servicio</div>
                            <div class="value">

                            @error('image_name1')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <small>Solo se acepta imagen con formato JPEG,BMP,JPG o PNG (máx 6MB)</small>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @enderror
                        <div class="form-group">
                        <input type="file" name="image_name1" class="form-control" id="name1" value="" required>
                    </div>


                    
                        
                     
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit">Register</button>
                        </div>
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
