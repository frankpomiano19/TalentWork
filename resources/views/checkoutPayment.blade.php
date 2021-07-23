@extends('layouts.app')

@section('contenido_js')

@endsection

@section('contenido_cSS')
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

@endsection



@section('content')




<div class="row" style="width: 100% !important">
    <div class="col-md-9 col-xs-12 pr-4 pt-1 px-4 rounded" >
        {{-- la tabla en sí  --}}

        <table id="tabla" class="rounded table border border-2 table table-bordered table table-borderless" border="5px" >

                    {{-- primer div grande con 6 partes  --}}

                <tr>

                    <th scope="hola"><h1 class="carrito"> Carrito </h1></th>
                    <td class="rounded align-text-bottom">
                        <div class="rounded align-text-bottom">
                            <h5 class="align-bottom text-right small allign-text-left ">Precio</h5>
                        </div>
                    </td>

                </tr>

            @if (!Cart::session(auth()->user()->id)->isEmpty())
                @foreach (Cart::session(auth()->user()->id)->getContent()->sortByDesc('id') as $item)
                  {{-- segundo div grande de 6 partes --}}
                <tr>



                    <td>
                        <div class="row rounded">
                            <div class="col-md-4 col-xs-4 rounded" >
                                <img src="{{ $item->attributes->img1 }}" class="rounded" style="width: 100% !important;" alt="imagen de servicio">
                            </div>

                            <div class="col-8 pr-4 pt-0 px-0">
                                <div class="col-12">
                                    <div class="col-10">
                                        <a href=""></a>
                                        <h2 class="font-weight-light">Nombre del evento </h2>
                                        <a href="#"><small class="">{{ $item->name }}</small></a>
                                    </div>

                                </div>

                     <br>
                            <div class="col-12 pr-4 pt-1 px-4">
                                    <span class="a-size-medium a-color-base"></span>

                                    <span> <h1 class="fs-6 font-weight-normal">El </span> <span class="text-lowercase fs-6 font-weight-light "> {{ $item->attributes->dateForm }}</span>  <span class="fs-6 font-weight-normal"> a las </span>  <span class="text-lowercase fs-6 font-weight-light"> {{ $item->attributes->hourForm }}</span> <span class="fs-6 font-weight-normal"> en </span> <span class="text-lowercase fs-6 font-weight-light"> {{ $item->attributes->addressForm }} </span>
                                </div>
                        </div>

                    </td>

                    <td>
                        <div class="col-12 pr-4 pt-1 px-4">
                            <h1 class="fs-6">S/{{ $item->price }}</h1>
                        </div>
                        <br>
                        <div class="col-12 pr-4 pt-1 px-4">

                            <form method="POST" action="{{route('cart.destroy',$item->id)}}">
                                @method('DELETE')
                                @csrf

                                    <button class="btn btn-white border-secondary bg-dark btn-md mb-2 d-flex align-items-center" type="submit">
                                        <i class="fa fa-trash">
                                        </i>
                                    </button>
                            </form>
                            </div>
                        </div>
                    </td>

                </tr>



                @endforeach
                <br>
                    </div>

            @else

                <style>
                    #tabla
                    {
                        display: none;
                    }
                    #resumen
                    {
                        display: none;
                    }

                </style>
                <div class="invisible row">
                    <h1>Barra</h1>
                </div>
                <div class="row pr-4 ml-2 py-3 px-1" >
                    <div class="col-4 rounded " >
                        <img src="https://m.media-amazon.com/images/G/01/cart/empty/kettle-desaturated._CB445243794_.svg" class="rounded" style="width: 100% !important;" alt="imagen de servicio">
                    </div>

                    <div class="col-8">
                        <h2 class="fs-4"> Tu Carrito de TalentWork está vacío</h2>

                        <a href="{{url('/talentService') }}" class= "badge badge-light">Vea nuestros servicios aquí</a>
                    </div>

                </div>



            @endif

        </table>

    </div>
<br>

    <div id="resumen" class="col-md-3 col-xs-12 pr-4 pt-4 px-4">
        <div class="card">

            <div class="card-body">
              <h5 class="text-center fs-5 pr-4 pt-1 px-4 ">Resumen</h5>
              <hr>

                  @if (!Cart::session(auth()->user()->id)->isEmpty())
                        <p class="card-text"><h1 class="fs-6 text-center">S/{{ $item->price }}</h1></p>
                        <hr>

                        @foreach (Cart::session(auth()->user()->id)->getContent()->sortByDesc('id') as $item)

                            <form class="" action="{{ route('continuePaymentPaypal') }}" method="POST" enctype="" novalidate>
                                @csrf
                                <input type="hidden" class="set-user-offer-input" name="userOffer" value=" {{ $item->attributes->userOffer }}" required>
                                <input type="hidden" class="set-price-offer-input" name="priceOffer" value="{{ $item->price }}" required>
                                <input type="hidden" class="set-service-offer-input" name="serviceOffer" value="{{ $item->id }}" required>
                                <input type="hidden" class="set-type-offer-input" name="typeOfJob" value="{{ $item->attributes->typeOfJob }}" required>
                                <input type="hidden" class="form-control" value="{{ $item->attributes->hourForm }}" name="hourForm">
                                <input type="hidden" class="form-control" value="{{ $item->attributes->dateForm }}" name="dateForm" min="2020-11-02" id="fechaContrato" required>
                                <input type="hidden" class="form-control" name="addressForm" value="{{ $item->attributes->addressForm }}" placeholder="Lugar">
                                <input type="hidden" class="form-control" name="descriptionForm" value="{{ $item->attributes->descriptionForm }}" placeholder="Descripcion">
                                <input type="submit" class="form-control btn btn-primary" aria-disabled="true"  value="Proceder al pago" >

                            </form>

                        @endforeach

                  @else
                    <h1 class="fs-4"> Necesitas selecionar algun servicio para contratar</h1>
                  @endif
                  {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
            </div>
          </div>
    </div>

    <div class="col-md-12  invisible">
        <h1>Prueba <br> <br> <br>
    </h1>

    </div>






@endsection
<script src="{{ asset('js/app.js') }}" defer></script>

@section('contenido_abajo_js')


@if (session('paymentFailedOrCancel'))
<script>
    Swal.fire({
        title: "No se pudo completar el pago",
        html:  `
        {{session('paymentFailedOrCancel')}}`,
        icon: "error"
    });
</script>
@endif


<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
@endsection
