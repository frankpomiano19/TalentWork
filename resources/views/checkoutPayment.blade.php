@extends('layouts.app')

@section('contenido_js')

@endsection

@section('contenido_cSS')

@endsection


@section('content')
<br>
<br>

<h1 class="text-center">Carrito</h1>
<div class="row" style="width: 98% !important">
    <div class="col-md-9 col-xs-12 pr-4" >

        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Imagen</th>
                <th scope="col">Nombre</th>        
                <th scope="col">Detalles</th>        
                <th scope="col">Descripcion</th>
                <th scope="col">Precio</th>
                <th scope="col">Accion</th>
              </tr>
            </thead>
            <tbody>
        
            @if (!Cart::session(auth()->user()->id)->isEmpty())  
                @foreach (Cart::session(auth()->user()->id)->getContent()->sortByDesc('id') as $item)
                  <tr>
                    <th scope="row">#</th>
                    <td style="width: 20% !important;">
                        <img src="{{ $item->attributes->img1 }}" style="width: 100% !important;" alt="imagen de servicio">
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-12">
                                <b>Fecha :</b> 
                                    {{ $item->attributes->dateForm }}
                            </div>
        
                            <div class="col-md-12">
                                <b>Hora :</b> 
                                {{ $item->attributes->hourForm }}            
                            </div>
        
        
                            <div class="col-md-12">
                                <b>Direccion :</b>  
                                {{ $item->attributes->addressForm }}
                            </div>
        
            
                        </div>
                    </td>
                    <td>{{ $item->attributes->descriptionForm }}</td>
                    <td>{{ $item->price }}</td>
                    <td>
                        <form method="POST" action="{{route('cart.destroy',$item->id)}}">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-white border-secondary bg-dark btn-md mb-2 d-flex align-items-center" type="submit">
                                <i class="fa fa-trash">                                                
                                </i>
                            </button>
                        </form>
                    </td>
                  </tr>
                        
                    
                @endforeach
                <br>            
            @else
            
                <tr>
                    <th></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                </tr>
                <h4 class="text-center">No se encontro nada :(</h4>

            @endif
            </tbody>
            </table>



    </div>
    <div class="col-md-3 col-xs-12">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Resumen</h5>
                  @if (!Cart::session(auth()->user()->id)->isEmpty())
                        <p class="card-text">Contrato de servicio</p>  

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
                                <input type="submit" value="Pagar con paypal">
                            </form>

                        @endforeach

                  @else
                    Necesitas selecionar algun servicio para contratar
                  @endif
                  {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
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