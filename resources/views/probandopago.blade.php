@extends('layouts.app')


@section('contenido_js')

@endsection

@section('contenido_cSS')

@endsection




@section('content')

<div class="content">

    <h1>hola mundo</h1>

    <h1>Compra de Prueba</h1>
    <h3>US$ 19.99</h3>
    <form action="{{ route('stripeProcessNow') }}" method="POST">
        @csrf
        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ config('services.stripe.key') }}"
            data-amount="1990"
            data-name="Compra"
            data-description="Prueba compra"
            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
            data-locale="auto">
        </script>
    </form>
</div>
@endsection
<script src="{{ asset('js/app.js') }}" defer></script>

@section('contenido_abajo_js')
<script>
</script>

@endsection
