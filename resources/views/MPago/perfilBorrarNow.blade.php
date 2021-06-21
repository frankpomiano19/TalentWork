@extends('layouts.app')
@section('contenido_js')
@endsection
@section('contenido_cSS')
@endsection
@section('content')

    <div class="col-12 col-sm-12 col-md-10 col-lg-10">
        <ul class="text-danger">
            @foreach ($errors->contractProccessForm->all() as $errorRegister)
                <li>{{ $errorRegister }}</li> 
            @endforeach
        </ul>

    </div>


    <form action="{{ route('iPContract') }}" method="POST">
        @csrf
        <input type="hidden" name="userOffer" value="1" required>
        <input type="hidden" name="priceOffer" value="20.00" required>
        <input type="hidden" name="serviceOffer" value="1" required>
        <label for="">Dia</label>
        <select name="dayForm" id="" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
        </select>
        <label for="">Hora</label>
        <input type="time" name="hourForm" value="{{ old('hourForm') }}" required>
        <label for="">Lugar</label>
        <input type="text" name="addressForm" value="{{ old('addressForm') }}" placeholder="Lugar">
        <label for="">Descripcion</label>
        <input type="text" name="descriptionForm" value="{{ old('descriptionForm') }}" placeholder="Descripcion" >


        <button class="btn-info" type="submit">Contratar</button>
    </form>


@endsection

@section('contenido_abajo_js')    


    @if (session('contractFailed'))
        <script>
            Swal.fire({
                title: "Error en el contrato",
                html:  `
                {{session('contractFailed')}}
                <br>
                <ul>
                    @foreach ($errors->contractProccessForm->all() as $errorRegister)
                        <li>{{ $errorRegister }}</li>
                    @endforeach               
                </ul>`,
                icon: "error"
            });
        </script>
    @endif



@endsection