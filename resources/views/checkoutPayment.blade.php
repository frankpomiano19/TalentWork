@extends('layouts.app')

@section('contenido_js')

@endsection

@section('contenido_cSS')
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200&family=Ubuntu:wght@300&display=swap" rel="stylesheet"><style>
        .summary{
            font-family: 'Source Sans Pro', sans-serif;
            font-family: 'Ubuntu', sans-serif;
        }
        .summary__tittle{
            font-size: 1.25rem !important;
            font-weight: bold !important;
        }
        .summary__tittle--size{
            font-size: 1rem  !important;
            font-weight: bold !important;
        }
        .summary__paragraph--style{
            font-size: 0.75rem !important;
        }
        .cart{
            font-family: 'Source Sans Pro', sans-serif;
            font-family: 'Ubuntu', sans-serif;
        }
        .cart__tittle{
            font-size: 1.5rem !important;
            font-weight: bold !important;
        }

        .cart__paragraph{
            font-size: 1.0rem !important;
        }
        .cart__paragraph--bold{
            font-weight: bold !important;
        }

        
    </style>

@endsection



@section('content')




<div class="row" style="width: 100% !important">
    <div class="col-md-9 col-xs-12 pr-4 pt-1 px-4 rounded" >
        {{-- la tabla en sí  --}}
        <table id="tabla" aria-describedby="descriptionNow" class="rounded table border border-2 table table-bordered table table-borderless" border="5px" >
                    {{-- primer div grande con 6 partes  --}}

                <tr>

                    <th scope="hola"><h1 id="descriptionNow" class="carrito summary text-center"> Carrito </h1></th>
                    <td class="rounded align-text-bottom">
                        <div class="rounded align-text-bottom">
                            {{-- <h5 class="align-bottom text-right small allign-text-left ">Precio</h5> --}}
                        </div>
                    </td>

                </tr>

            @if (!Cart::session(auth()->user()->id)->isEmpty())
                @foreach (Cart::session(auth()->user()->id)->getContent()->sortByDesc('id') as $item)
                  {{-- segundo div grande de 6 partes --}}
                <tr>



                    <td class="cart">
                        <div class="row rounded">
                            <div class="col-md-4 col-xs-4 rounded" >
                                <img src="{{ $item->attributes->img1 }}" class="rounded" style="width: 100% !important;" alt="imagen de servicio">
                            </div>

                            <div class="col-8 pr-4 pt-0 px-0">
                                <div class="col-12">
                                    <div class="col-10 ">
                                        <a href=""></a>
                                        <h2 class="font-weight-light cart__tittle">{{ $item->name }} </h2>
                                        <a href="{{ route('perfil',$item->attributes->userOffer) }}"><small class="">{{ $item->attributes->userNameProvider }}</small></a>
                                    </div>

                                </div>

                     <br>
                            <div class="col-12 pr-4 pt-1 px-4 cart">
                                    <span class="a-size-medium a-color-base"></span>

                                    <span> <h1 class="fs-6 font-weight-normal cart__paragraph">El </span> <span class="text-lowercase fs-6 font-weight-bold "> {{ $item->attributes->dateForm }}</span>  <span class="fs-6 font-weight-normal"> a las </span>  <span class="text-lowercase fs-6 font-weight-bold"> {{ $item->attributes->hourForm }}</span> <span class="fs-6 font-weight-normal"> en </span> <span class="text-lowercase fs-6 font-weight-bold"> {{ $item->attributes->addressForm }} </span>
                                </div>
                        </div>

                    </td>

                    <td>
                        <div class="col-12 pr-4 pt-1 px-4 cart">
                            <h1 class="fs-5 font-italic cart__paragraph cart__paragraph--bold">$ {{ $item->price }}</h1>
                        </div>
                        <br>
                        <div class="col-12 pr-4 pt-1 px-4">

                            <form method="POST" action="{{route('cart.destroy',$item->id)}}">
                                @method('DELETE')
                                @csrf

                                    <button class="btn btn-white border-secondary bg-dark btn-md mb-2 d-flex align-items-center" type="submit">
                                        <em class="fa fa-trash">
                                        </em>
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

                        <a href="{{url('/talentService') }}" class= "badge badge-light text-dark">Vea nuestros servicios aquí</a>
                    </div>

                </div>



            @endif

        </table>

    </div>
<br>



    <div id="resumen" class="col-md-3 col-xs-12 pr-4 pt-4 px-4">
        <div class="card">

            <div class="card-body summary">
              <h5 class="text-center fs-5 pr-4 pt-1 px-4 summary__tittle">Resumen</h5>
              <hr>

                  @if (!Cart::session(auth()->user()->id)->isEmpty())
                        <p class="card-text"><div class="fs-6 text-center"> <label class="summary__tittle--size">Total :</label>  S/{{ $item->price }}</div></p>
                        <blockquote class="blockquote">
                            <p class="font-weight-light text-muted summary__paragraph--style">* La unica forma habilitada es atravez de la plataforma paypal</p> 
                          </blockquote>              
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
            </div>
          </div>
    </div>

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



@endsection
